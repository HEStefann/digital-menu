<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Breakfast', 'type' => 'Breakfast'],
            ['name' => 'Salads', 'type' => 'Salads'],
            ['name' => 'Pizzas', 'type' => 'Pizzas'],
            ['name' => 'Mains', 'type' => 'Mains'],
            ['name' => 'Desserts', 'type' => 'Desserts'],
            ['name' => 'Drinks', 'type' => 'Drinks'],
            ['name' => 'Pasta', 'type' => 'Pasta'],
            ['name' => 'Seafood', 'type' => 'Seafood'],
            ['name' => 'Fishes', 'type' => 'Fishes'],
            ['name' => 'Burgers', 'type' => 'Burgers'],
            ['name' => 'Cakes', 'type' => 'Cakes'],
            ['name' => 'Appetizers', 'type' => 'Appetizers'],
            ['name' => 'Ice Creams', 'type' => 'Ice_Creams'],
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category['name'],
                'type' => $category['type']
            ]);
        }
    }
}
