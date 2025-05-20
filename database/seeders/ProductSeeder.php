<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $allCategories = Category::all();

        $products = [
            [
                'id' => 1,
                'name' => 'Toyota Avanza',
                'description' => 'Mobil keluarga dengan kapasitas 7 penumpang',
                'price' => 200000000,
                'category' => 'Toyota',
            ],
            [
                'id' => 2,
                'name' => 'Honda Civic',
                'description' => 'Sedan sporty dengan desain elegan',
                'price' => 350000000,
                'category' => 'Honda',
            ],
            [
                'id' => 3,
                'name' => 'Suzuki Ertiga',
                'description' => 'MPV dengan fitur modern dan irit bahan bakar',
                'price' => 220000000,
                'category' => 'Suzuki',
            ],
            [
                'id' => 4,
                'name' => 'Mitsubishi Pajero',
                'description' => 'SUV tangguh untuk segala medan',
                'price' => 500000000,
                'category' => 'Mitsubishi',
            ],
            [
                'id' => 5,
                'name' => 'Nissan X-Trail',
                'description' => 'SUV dengan kenyamanan premium',
                'price' => 400000000,
                'category' => 'Nissan',
            ],
        ];

        foreach ($products as $data) {
            $category = $allCategories->firstWhere('name', $data['category']);

            Product::create([
                'name' => $data['name'],
                'description' => $data['description'],
                'price' => $data['price'],
                'category_id' => $category->id,
            ]);
        }
    }
}
