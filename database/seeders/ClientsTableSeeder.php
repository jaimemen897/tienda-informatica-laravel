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
            'name' => 'Juan',
            'surname' => 'Perez Delgado',
            'phone' => '678364965',
            'email' => 'juanperezdelgado@clowns.com',
            'password' => bcrypt('juanperezdelgado')
        ]);
        Client::create([
            'name' => 'María',
            'surname' => 'Gómez López',
            'phone' => '645782319',
            'email' => 'mariagomezlopez@clowns.com',
            'password' => bcrypt('mariagomezlopez')
        ]);

        Client::create([
            'name' => 'Pedro',
            'surname' => 'Martínez García',
            'phone' => '632548971',
            'email' => 'pedromartinezgarcia@clowns.com',
            'password' => bcrypt('pedromartinezgarcia')
        ]);

        Client::create([
            'name' => 'Ana',
            'surname' => 'Fernández Rodríguez',
            'phone' => '654987321',
            'email' => 'anafernandezrodriguez@clowns.com',
            'password' => bcrypt('anafernandezrodriguez')
        ]);

        Client::create([
            'name' => 'David',
            'surname' => 'Sánchez Pérez',
            'phone' => '687452136',
            'email' => 'davidsanchezperez@clowns.com',
            'password' => bcrypt('davidsanchezperez')
        ]);

        Client::create([
            'name' => 'Laura',
            'surname' => 'García Martínez',
            'phone' => '698745123',
            'email' => 'lauragarciama@clowns.com',
            'password' => bcrypt('lauragarciama')
        ]);

        Client::create([
            'name' => 'Carlos',
            'surname' => 'Fernández López',
            'phone' => '675849621',
            'email' => 'carlosfernandezlopez@clowns.com',
            'password' => bcrypt('carlosfernandezlopez')
        ]);

        Client::create([
            'name' => 'Sofía',
            'surname' => 'Martín Sánchez',
            'phone' => '654789632',
            'email' => 'sofiamartinsanchez@clowns.com',
            'password' => bcrypt('sofiamartinsanchez')
        ]);

        Client::create([
            'name' => 'Pablo',
            'surname' => 'Hernández Gómez',
            'phone' => '687954123',
            'email' => 'pablohernandezgomez@clowns.com',
            'password' => bcrypt('pablohernandezgomez')
        ]);

        Client::create([
            'name' => 'Lucía',
            'surname' => 'González Martínez',
            'phone' => '698742136',
            'email' => 'luciagonzalezm@clowns.com',
            'password' => bcrypt('luciagonzalezm')
        ]);


    }
}
