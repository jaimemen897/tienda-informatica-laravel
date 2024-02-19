<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class EmployeeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Employee::create([
            'id' => (string) Str::uuid(),
            'name' => 'Juan',
            'surname' => 'Pérez',
            'phone' => '1234567890',
            'salary' => 5000.00,
            'position' => 'Manager',
            'email' => 'juan.perez@example.com',
            'password' => bcrypt('juanperez'),
        ]);

        Employee::create([
            'id' => (string) Str::uuid(),
            'name' => 'Carlos',
            'surname' => 'García',
            'phone' => '1234567891',
            'salary' => 4500.00,
            'position' => 'Developer',
            'email' => 'carlos.garcia@example.com',
            'password' => bcrypt('carlosgarcia'),
        ]);

        Employee::create([
            'id' => (string) Str::uuid(),
            'name' => 'María',
            'surname' => 'López',
            'phone' => '1234567892',
            'salary' => 4000.00,
            'position' => 'Designer',
            'email' => 'maria.lopez@example.com',
            'password' => bcrypt('marialopez'),
        ]);

        Employee::create([
            'id' => (string) Str::uuid(),
            'name' => 'Ana',
            'surname' => 'Martínez',
            'phone' => '1234567893',
            'salary' => 3500.00,
            'position' => 'Developer',
            'email' => 'ana.martinez@example.com',
            'password' => bcrypt('anamartinez'),
        ]);

        Employee::create([
            'id' => (string) Str::uuid(),
            'name' => 'David',
            'surname' => 'Sánchez',
            'phone' => '1234567894',
            'salary' => 3000.00,
            'position' => 'Designer',
            'email' => 'david.sanchez@example.com',
            'password' => bcrypt('davidsanchez'),
        ]);
    }
}
