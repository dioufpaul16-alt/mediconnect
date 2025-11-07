<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $password = 'admin123';

        // Create or update admin user so seeding is idempotent
        $admin = User::updateOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make($password),
                'email_verified_at' => now(),
            ]
        );

        Log::info('Admin user seeded/updated', ['email' => $admin->email]);
        dump('Admin user created or updated with password: ' . $password);

        $this->call([
            // ...other seeders...
            \Database\Seeders\AdminUserSeeder::class,
        ]);
    }
}