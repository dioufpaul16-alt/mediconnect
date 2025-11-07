<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        // Get credentials from .env or use defaults
        $email = env('ADMIN_EMAIL', 'admin@admin.com');
        $password = env('ADMIN_PASSWORD', 'admin123');
        $name = env('ADMIN_NAME', 'Administrator');

        // Create admin if doesn't exist
        if (!User::where('email', $email)->exists()) {
            User::create([
                'name' => $name,
                'email' => $email,
                'password' => Hash::make($password),
                'email_verified_at' => now(),
            ]);

            $this->command->info("Admin user created: $email");
        } else {
            $this->command->info("Admin user already exists: $email");
        }
    }
}
