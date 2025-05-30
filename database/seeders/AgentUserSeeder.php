<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AgentUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'agent@agent.com'],
            [
                'name' => 'Agent User',
                'password' => Hash::make('password'),
                'role' => 'agent',
            ]
        );
    }
}
