<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::factory()->count(50)->create();
        Product::create([
            'name' => 'Ratón',
            'price' => 1000,
            'stock' => 10,
            'description' => 'Ratón inalámbrico',
            'category_id' => Category::where('name', 'PC')->first()->id,
            'supplier_id' => Supplier::where('name', 'Proveedor 1')->first()->id,
        ]);

        Product::create([
            'name' => 'Teclado',
            'price' => 2000,
            'stock' => 10,
            'description' => 'Teclado inalámbrico',
            'category_id' => Category::where('name', 'GAMER')->first()->id,
            'supplier_id' => Supplier::where('name', 'Proveedor 2')->first()->id,
        ]);

        Product::create([
            'name' => 'Monitor',
            'price' => 3000,
            'stock' => 10,
            'description' => 'Monitor 24"',
            'category_id' => Category::where('name', 'OFICINA')->first()->id,
            'supplier_id' => Supplier::where('name', 'Proveedor 3')->first()->id,
        ]);

    }
}
