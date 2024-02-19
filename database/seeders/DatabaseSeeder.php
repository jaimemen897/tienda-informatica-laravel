<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(ClientsTableSeeder::class);
        $this->call(EmployeeTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(SupplierTableSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(ProductSeeder::class);
    }
}
