<?php

namespace Database\Seeders;

use App\Enums\RoleEnums;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'role' => RoleEnums::ADMIN,
                'name' => 'Admin',
                'email' => 'admin@turkticaret.net',
                'password' => Hash::make(12345678),
            ],
            [
                'role' => RoleEnums::USER,
                'name' => 'User',
                'email' => 'user@turkticaret.net',
                'password' => Hash::make(12345678),
            ],
        ];

        User::query()->truncate();

        foreach ($users as $user) {
            User::query()->create($user);
        }
    }
}
