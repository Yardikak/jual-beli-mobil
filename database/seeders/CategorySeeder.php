<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = [
            'Toyota',
            'Honda',
            'Suzuki',
            'Mitsubishi',
            'Nissan',
        ];

        foreach ($brands as $brand) {
            Category::firstOrCreate(['name' => $brand]);
        }
    }
}
