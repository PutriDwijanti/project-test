<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user(); 

        if ($user->role === 'admin') {
            $total = Ticket::count();
            $open = Ticket::where('status', 'open')->count();
            $closed = Ticket::where('status', 'closed')->count();
            $tickets = Ticket::latest()->paginate(10);
        } else {
            $total = $open = $closed = null;
           $tickets = Ticket::where('user_id', auth()->id())->paginate(10);

        }

        // PASS semua variabel ke view, termasuk $user
        return view('dashboard', compact('user', 'total', 'open', 'closed', 'tickets'));
    }
}
