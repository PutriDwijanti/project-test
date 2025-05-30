<?php


namespace App\Policies;

use App\Models\Ticket;
use App\Models\User;

class TicketPolicy
{
    /**
     * Cek apakah user bisa melihat tiket ini.
     */
    public function view(User $user, Ticket $ticket)
    {
        return $user->id === $ticket->user_id || $user->role === 'admin' || $user->role === 'agent';
    }

    /**
     * Cek apakah user bisa update tiket ini.
     */
    public function update(User $user, Ticket $ticket)
    {
        return $user->id === $ticket->user_id || $user->role === 'admin';
    }

    /**
     * Cek apakah user bisa hapus tiket ini.
     */
    public function delete(User $user, Ticket $ticket)
    {
        return $user->role === 'admin';
    }
}
