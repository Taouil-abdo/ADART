<?php
namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        // Category::factory()->count(10)->create();

        $categories = [
            'Food',
            'Clothing',
            'Hygiene Products',
            'Books',
            'School Supplies',
            'Cleaning Materials',
            'Electronics',
            'Medical Supplies',
        ];

        foreach ($categories as $category) {
            Category::create(['name' => $category]);
        }
    }
}


