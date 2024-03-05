<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Seeder;

class SupplierTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Supplier::factory()->count(10)->create();

        Supplier::create([
            'name' => 'Proveedor 1',
            'contact' => '123456789',
            'address' => 'Jl. Raya No. 1',
        ]);

        Supplier::create([
            'name' => 'Proveedor 2',
            'contact' => '23456789',
            'address' => 'Jl. Raya No. 2',
        ]);

        Supplier::create([
            'name' => 'Proveedor 3',
            'contact' => '3456789',
            'address' => 'Jl. Raya No. 3',
        ]);
    }
}
