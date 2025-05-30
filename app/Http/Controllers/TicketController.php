<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Category;
use App\Models\Label;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TicketController extends Controller
{
    use AuthorizesRequests;  
    // Tampilkan daftar tiket sesuai role
    public function index()
    {
        $user = Auth::user();
        $query = Ticket::query();

        if ($user->role === 'user') {
            $query->where('user_id', $user->id);
        } elseif ($user->role === 'agent') {
            $query->where('agent_id', $user->id);
        }

        $tickets = $query->with('categories', 'labels')->paginate(10);
        return view('tickets.index', compact('tickets'));
    }

    // Form untuk membuat tiket
    public function create()
    {
        $categories = Category::all();
        $labels = Label::all();
        return view('tickets.create', compact('categories', 'labels'));
    }

    // Simpan tiket baru
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'priority' => 'required',
            'categories' => 'array',
            'labels' => 'array',
            'attachments.*' => 'file|max:2048',
        ]);

        $ticket = Ticket::create([
            'title' => $request->title,
            'description' => $request->description,
            'priority' => $request->priority,
            'status' => 'open',
            'user_id' => Auth::id(),
        ]);

        $ticket->categories()->attach($request->categories);
        $ticket->labels()->attach($request->labels);

        // Simpan lampiran
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $path = $file->store('attachments', 'public');
                $ticket->attachments()->create([
                    'file_path' => $path,
                ]);
            }
        }

        return redirect()->route('tickets.index')->with('success', 'Tiket berhasil dibuat.');
    }

    // Tampilkan detail tiket
    public function show(Ticket $ticket)
    {
        $ticket->load('comments.user', 'categories', 'labels', 'attachments');
        return view('tickets.show', compact('ticket'));
    }

    // Form edit (hanya agent/admin)
    public function edit(Ticket $ticket)
    {
        $this->authorize('update', $ticket); // Policy nanti
        $categories = Category::all();
        $labels = Label::all();
        return view('tickets.edit', compact('ticket', 'categories', 'labels'));
    }

    // Update tiket
    public function update(Request $request, Ticket $ticket)
    {
        $this->authorize('update', $ticket);

        $ticket->update([
            'title' => $request->title,
            'description' => $request->description,
            'priority' => $request->priority,
            'status' => $request->status,
        ]);

        $ticket->categories()->sync($request->categories);
        $ticket->labels()->sync($request->labels);

        return redirect()->route('tickets.index')->with('success', 'Tiket berhasil diperbarui.');
    }

    // Tidak ada delete untuk user/agent, hanya admin (opsional)
    public function destroy(Ticket $ticket)
    {
        $this->authorize('delete', $ticket);
        $ticket->delete();
        return redirect()->route('tickets.index')->with('success', 'Tiket dihapus.');
    }

        public function dashboard()
    {
        $user = Auth::user();
        $query = Ticket::query();

        if ($user->role === 'user') {
            $query->where('user_id', $user->id);
        } elseif ($user->role === 'agent') {
            $query->where('agent_id', $user->id);
        }

        $tickets = $query->latest()->take(5)->get(); // Ambil 5 tiket terbaru

        return view('dashboard', compact('tickets'));
    }
}
