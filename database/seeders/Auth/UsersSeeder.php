<?php

namespace Database\Seeders\Auth;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{

    public function run()
    {
        $user = User::create([
            'name' => 'Tata',
            'email' => 'tata@local',
            'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'password' => Hash::make('zaq1@WSX'),
        ]);

        $user->markEmailAsVerified();

        $user = User::create([
            'name' => 'Wojtek',
            'email' => 'wojtek@local',
            'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'password' => Hash::make('zaq1@WSX'),
        ]);

        $user->markEmailAsVerified();
    }
}
