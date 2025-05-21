<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FaqCategory;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        $bestellen = FaqCategory::create(['name' => 'Bestellen']);
        $bestellen->faqs()->createMany([
            [
                'question' => 'Hoe plaats ik een bestelling?',
                'answer' => 'Klik op "Bestellen" in de menubalk en volg de stappen.',
            ],
            [
                'question' => 'Kan ik mijn bestelling annuleren?',
                'answer' => 'Ja, neem binnen 10 minuten contact op via het contactformulier.',
            ],
        ]);

        $koffie = FaqCategory::create(['name' => 'Koffiesoorten']);
        $koffie->faqs()->createMany([
            [
                'question' => 'Wat is het verschil tussen een cappuccino en latte?',
                'answer' => 'Een cappuccino heeft meer schuim, een latte meer melk.',
            ],
            [
                'question' => 'Welke bonen gebruiken jullie?',
                'answer' => 'Wij gebruiken 100% arabica van lokale branderijen.',
            ],
        ]);
    }
}
