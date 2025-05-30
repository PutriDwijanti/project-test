<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    // Daftar tiket milik user ini dengan filter dropdown
    public function index(Request $request)
    {
        $query = Ticket::where('user_id', Auth::id());

        // Filter status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        // Filter priority
        if ($request->filled('priority')) {
            $query->where('priority', $request->priority);
        }
        // Filter category_id
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        $tickets = $query->paginate(10)->withQueryString();

        // Ambil list kategori untuk dropdown filter
        $categories = \App\Models\Category::all();

        return view('user.tickets.index', compact('tickets', 'categories'));
    }

    // Form tambah tiket baru
    public function create()
    {
        $categories = \App\Models\Category::all();
        return view('user.tickets.create', compact('categories'));
    }

    // Simpan tiket baru
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'priority' => 'required|in:low,medium,high',
        ]);

        Ticket::create([
            'title' => $request->title,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'priority' => $request->priority,
            'status' => 'open',
            'user_id' => Auth::id(),
            'agent_id' => null,
        ]);

        return redirect()->route('user.tickets.index')->with('success', 'Tiket berhasil dibuat.');
    }

    // Lihat detail tiket
    public function show(Ticket $ticket)
    {
        $this->authorizeTicket($ticket);
        $ticket->load('comments.user', 'category', 'agent');

        return view('user.tickets.show', compact('ticket'));
    }

    // Tambah komentar di tiket
    public function addComment(Request $request, Ticket $ticket)
    {
        $this->authorizeTicket($ticket);

        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $ticket->comments()->create([
            'user_id' => Auth::id(),
            'content' => $request->content,
        ]);

        return back()->with('success', 'Komentar berhasil ditambahkan.');
    }

    private function authorizeTicket(Ticket $ticket)
    {
        if ($ticket->user_id !== Auth::id()) {
            abort(403);
        }
    }
}
