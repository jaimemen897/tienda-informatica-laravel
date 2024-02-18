<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Client::create([
            'name' => 'Juan Perez Delgado',
            'email' => 'juanperezdelgado@clowns.com',
            'password' => bcrypt('juanperezdelgado')
        ]);
        Client::create([
            'name' => 'Maria Lopez',
            'email' => 'marialopez@clowns.com',
            'password' => bcrypt('marialopez')
        ]);
        Client::create([
            'name' => 'Pedro Ramirez',
            'email' => 'pedroramirez@clowns.com',
            'password' => bcrypt('pedroramirez')
        ]);

        Client::create([
            'name' => 'Laura Sanchez',
            'email' => 'laurasanchez@clowns.com',
            'password' => bcrypt('laurasanchez')
        ]);

        Client::create([
            'name' => 'Carlos Gomez',
            'email' => 'carlosgomez@clowns.com',
            'password' => bcrypt('carlosgomez')
        ]);

        Client::create([
            'name' => 'Ana Martinez',
            'email' => 'anamartinez@clowns.com',
            'password' => bcrypt('anamartinez')
        ]);

        Client::create([
            'name' => 'Javier Fernandez',
            'email' => 'javierfernandez@clowns.com',
            'password' => bcrypt('javierfernandez')
        ]);
    }
}
