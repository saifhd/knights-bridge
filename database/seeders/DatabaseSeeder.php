<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Product;
use App\Models\Seller;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $products = Product::factory(10)
            ->hasImages(3)
            ->create();

        Seller::factory(10)->create()->each(function ($seller) use ($products) {
            $seller->products()->attach($products->random(3), ['stock' => rand(10,1000), 'price' => rand(1,100)]);
        });
    }
}
