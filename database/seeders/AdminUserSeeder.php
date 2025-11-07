<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        $email = 'admin@admin.com';
        $password = env('ADMIN_PASSWORD', 'secret');

        if (! User::where('email', $email)->exists()) {
            User::create([
                'name' => 'Administrator',
                'email' => $email,
                'email_verified_at' => now(),
                'password' => $password, // User model mutator will hash this
            ]);
            $this->command->info("Admin user created: {$email} (password from ADMIN_PASSWORD or 'secret')");
        } else {
            $this->command->info("Admin user already exists: {$email}");
        }
    }
}
