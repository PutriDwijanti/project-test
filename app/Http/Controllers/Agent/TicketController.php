<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
public function dashboard()
{
    $tickets = Ticket::where('agent_id', Auth::id())
                     ->where('status', 'open') 
                     ->with('createdBy')       
                     ->paginate(10);         

    return view('agent.dashboard', compact('tickets'));
}

    public function index()
    {
        $tickets = Ticket::where('agent_id', Auth::id())->paginate(10);
        return view('agent.tickets.index', compact('tickets'));
    }

    public function show(Ticket $ticket)
    {
        $this->authorizeTicket($ticket);
        $ticket->load('comments.user'); // untuk komentar
        return view('agent.tickets.show', compact('ticket'));
    }

    public function edit(Ticket $ticket)
    {
        $this->authorizeTicket($ticket);
        return view('agent.tickets.edit', compact('ticket'));
    }

    public function update(Request $request, Ticket $ticket)
    {
        $this->authorizeTicket($ticket);

        $request->validate([
            'status' => 'required|in:open,closed,in_progress',
            'priority' => 'required|in:low,medium,high',
            'description' => 'required',
            'attachments.*' => 'file|max:2048',
        ]);

        $ticket->update($request->only('status', 'priority', 'description'));

        // Simpan lampiran jika ada
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $path = $file->store('attachments', 'public');

                $ticket->attachments()->create([
                    'filename' => $file->getClientOriginalName(),
                    'filepath' => $path,
                ]);
            }
        }

        return redirect()->route('agent.tickets.index')->with('success', 'Tiket diperbarui.');
    }

    public function addComment(Request $request, Ticket $ticket)
    {
        $this->authorizeTicket($ticket);

        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $ticket->comments()->create([
            'user_id' => Auth::id(),
            'content' => $request->input('content'),
        ]);

        return back()->with('success', 'Komentar ditambahkan.');
    }

    private function authorizeTicket(Ticket $ticket)
    {
        if ($ticket->agent_id !== Auth::id()) {
            abort(403);
        }
    }
}
