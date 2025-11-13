<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()
            ->admin()
            ->create([
                'name' => 'Administrator',
                'email' => 'admin@hc.test',
                'password' => '12345',
            ]);

        User::factory()
            ->create([
                'name' => 'User Biasa',
                'email' => 'user@hc.test',
                'password' => '12345',
            ]);

        User::factory(5)->create();
    }
}
