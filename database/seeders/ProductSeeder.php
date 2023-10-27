<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create 40 products with complete information and picture.
        $products = [];
        for ($i = 0; $i < 40; $i++) {
            $products[] = [
                'category_id' => random_int(1, 10),
                'shop_id' => random_int(1, 10),
                'name' => 'Product ' . ($i + 1),
                'picture' => 'image' . ($i + 1) . '.jpg',
                'detail' => 'This is the detail of Product ' . ($i + 1),
                'price' => random_int(100, 1000),
                'favorite' => 0,
                'duration' => random_int(1, 10),
                'tag' => 'product',
                'from' => '09:00:00',
                'to' => '18:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Insert the products into the database.
        DB::table('products')->insert($products);
    }
}
