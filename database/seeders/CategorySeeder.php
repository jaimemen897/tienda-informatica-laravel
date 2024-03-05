<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::factory()->count(10)->create();
        Category::create([
            'name' => 'PC'
        ]);

        Category::create([
            'name' => 'GAMER'
        ]);

        Category::create([
            'name' => 'OFICINA'
        ]);
    }
}
