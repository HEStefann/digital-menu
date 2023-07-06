<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AllergenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('allergens')->insert([
            ["name" => "Moluscs"],
            ["name" => "Eggs"],
            ["name" => "Fish"],
            ["name" => "Lupin"],
            ["name" => "Crustaceans"],
            ["name" => "Soya"],
            ["name" => "Dairy"],
            ["name" => "Mushrooms"],
            ["name" => "Corn"],
            ["name" => "Peanuts"],
            ["name" => "Gluten"],
            ["name" => "Mustard"],
            ["name" => "Nuts"],
            ["name" => "Sesame"],
            ["name" => "Celery"],
            ["name" => "Sulphites"]
        ]);
    }
}
