<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class AgentController extends Controller
{
public function index()
{
    $user = auth()->user();
    $tickets = Ticket::where('assigned_to', $user->id)->latest()->paginate(10);

    return view('dashboards.agent', compact('tickets', 'user'));
}

}
