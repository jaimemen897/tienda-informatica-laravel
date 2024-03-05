<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Seeder;

class EmployeeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Employee::factory()->count(10)->create();

        Employee::create([
            'name' => 'Juan',
            'surname' => 'Pérez',
            'phone' => '123456789',
            'salary' => 1000,
            'position' => 'Manager',
            'email' => 'empleado@empleado.es',
            'image' => Employee::IMAGE_DEFAULT,
            'password' => bcrypt('empleado'),
        ]);
    }
}
