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
        Client::factory()->count(20)->create();

        Client::create([
            'name' => 'Juan',
            'surname' => 'Pérez',
            'phone' => '123456789',
            'email' => 'cliente@cliente.es',
            'image' => Client::IMAGE_DEFAULT,
            'password' => bcrypt('cliente'),
        ]);
    }
}
