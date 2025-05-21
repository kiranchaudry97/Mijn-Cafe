<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Coffee;

class CoffeeSeeder extends Seeder
{
    public function run(): void
    {
        $coffees = [
            [
                'name' => 'Espresso',
                'description' => 'Sterk & puur.',
                'price' => 2.50,
                'image_path' => 'coffees/espresso.jpg',
            ],
            [
                'name' => 'Cappuccino',
                'description' => 'Met melk en schuim.',
                'price' => 3.00,
                'image_path' => 'coffees/cappuccino.jpg',
            ],
            [
                'name' => 'Latte',
                'description' => 'Zacht en romig.',
                'price' => 3.20,
                'image_path' => 'coffees/latte.jpg',
            ],
            [
                'name' => 'Flat White',
                'description' => 'Romige kracht.',
                'price' => 3.30,
                'image_path' => 'coffees/flat_white.jpg',
            ],
            [
                'name' => 'Americano',
                'description' => 'Met heet water.',
                'price' => 2.80,
                'image_path' => 'coffees/americano.jpg',
            ],
            [
                'name' => 'Iced Coffee',
                'description' => 'Verfrissend koud.',
                'price' => 3.50,
                'image_path' => 'coffees/iced_coffee.jpg',
            ],
        ];

        foreach ($coffees as $coffee) {
            Coffee::updateOrCreate(
                ['name' => $coffee['name']],
                $coffee
            );
        }
    }
}