<?php

namespace Database\Seeders;

use App\Models\Ingredient;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product = Product::create([
            'name' => 'Burger',
            'description' => 'Very delicious beef burger with cheese and onion ',
            'image' => 'product1.jpg',
            'price' => 1000
        ]);

        Ingredient::create([
            'name' => 'Beef',
            'inserted_amount' => 20000,
            'current_amount' => 20000,
        ])->products()->attach($product, ['needed_amount' => 150]);

        Ingredient::create([
            'name' => 'Cheese',
            'inserted_amount' => 5000,
            'current_amount' => 5000,
        ])->products()->attach($product, ['needed_amount' => 30]);

        Ingredient::create([
            'name' => 'Onion',
            'inserted_amount' => 1000,
            'current_amount' => 1000,
        ])->products()->attach($product, ['needed_amount' => 20]);
    }
}
