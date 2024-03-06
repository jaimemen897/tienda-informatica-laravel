<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = ['PC', 'GAMER', 'OFICINA', 'PORTÁTIL', 'ESCRITORIO', 'COMPONENTES', 'PERIFÉRICOS', 'ACCESORIOS', 'SOFTWARE', 'REDES', 'ALMACENAMIENTO', 'MULTIMEDIA', 'SEGURIDAD', 'ENTRETENIMIENTO', 'IMPRESIÓN', 'DISEÑO GRÁFICO', 'DESARROLLO', 'EDUCACIÓN'];

        foreach ($categories as $category) {
            Category::create(['name' => $category]);
        }
    }
}
