<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin-gebruiker
        User::create([
            'name' => 'Admin',
            'email' => 'admin@ehb.be',
            'password' => bcrypt('Password!321'),
            'is_admin' => true,
        ]);

        // Gewone gebruiker
        User::create([
            'name' => 'Gebruiker',
            'email' => 'login@ehb.be',
            'password' => bcrypt('Password!321'),
        ]);

        $this->call([
            FaqSeeder::class,
            CoffeeSeeder::class, // CoffeeSeeder moet ook bestaan!
        ]);
    }
}
