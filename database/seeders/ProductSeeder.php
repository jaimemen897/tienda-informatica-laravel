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
        Product::create([
            'name' => 'Laptop Lenovo Ideapad 15.6"',
            'price' => 699.99,
            'stock' => 15,
            'description' => 'Portátil para uso diario',
            'category_id' => Category::where('name', 'PORTÁTIL')->first()->id,
            'supplier_id' => Supplier::where('name', 'Proveedor 1')->first()->id,
        ]);

        Product::create([
            'name' => 'PC Gaming HP Pavilion',
            'price' => 1199.99,
            'stock' => 10,
            'description' => 'Ordenador de escritorio para gaming',
            'category_id' => Category::where('name', 'ESCRITORIO')->first()->id,
            'supplier_id' => Supplier::where('name', 'Proveedor 2')->first()->id,
        ]);

        Product::create([
            'name' => 'Memoria RAM Corsair Vengeance 16GB',
            'price' => 89.99,
            'stock' => 20,
            'description' => 'Componente para mejorar el rendimiento del PC',
            'category_id' => Category::where('name', 'COMPONENTES')->first()->id,
            'supplier_id' => Supplier::where('name', 'Proveedor 3')->first()->id,
        ]);

        Product::create([
            'name' => 'Router TP-Link Archer C7',
            'price' => 79.99,
            'stock' => 15,
            'description' => 'Router de alta velocidad para redes domésticas',
            'category_id' => Category::where('name', 'REDES')->first()->id,
            'supplier_id' => Supplier::where('name', 'Proveedor 1')->first()->id,
        ]);

        Product::create([
            'name' => 'Disco Duro Externo WD Elements 2TB',
            'price' => 69.99,
            'stock' => 12,
            'description' => 'Almacenamiento externo para respaldo de datos',
            'category_id' => Category::where('name', 'ALMACENAMIENTO')->first()->id,
            'supplier_id' => Supplier::where('name', 'Proveedor 2')->first()->id,
        ]);

        Product::create([
            'name' => 'Altavoces Logitech Z623',
            'price' => 119.99,
            'stock' => 10,
            'description' => 'Altavoces potentes para multimedia',
            'category_id' => Category::where('name', 'MULTIMEDIA')->first()->id,
            'supplier_id' => Supplier::where('name', 'Proveedor 3')->first()->id,
        ]);

        Product::create([
            'name' => 'Antivirus McAfee Total Protection 1 año',
            'price' => 39.99,
            'stock' => 20,
            'description' => 'Software de seguridad para PC',
            'category_id' => Category::where('name', 'SOFTWARE')->first()->id,
            'supplier_id' => Supplier::where('name', 'Proveedor 1')->first()->id,
        ]);

        Product::create([
            'name' => 'Impresora Canon PIXMA TS5320',
            'price' => 79.99,
            'stock' => 10,
            'description' => 'Impresora multifuncional para oficina',
            'category_id' => Category::where('name', 'IMPRESIÓN')->first()->id,
            'supplier_id' => Supplier::where('name', 'Proveedor 2')->first()->id,
        ]);

        Product::create([
            'name' => 'Adobe Photoshop Elements 2022',
            'price' => 99.99,
            'stock' => 10,
            'description' => 'Software de edición de fotos para diseño gráfico',
            'category_id' => Category::where('name', 'DISEÑO GRÁFICO')->first()->id,
            'supplier_id' => Supplier::where('name', 'Proveedor 3')->first()->id,
        ]);

        Product::create([
            'name' => 'Monitor LG 27" 4K Ultra HD',
            'price' => 299.99,
            'stock' => 10,
            'description' => 'Monitor de alta resolución para entretenimiento',
            'category_id' => Category::where('name', 'ENTRETENIMIENTO')->first()->id,
            'supplier_id' => Supplier::where('name', 'Proveedor 1')->first()->id,
        ]);

        Product::create([
            'name' => 'Microsoft Office 365 Personal',
            'price' => 69.99,
            'stock' => 15,
            'description' => 'Suite de productividad para uso personal',
            'category_id' => Category::where('name', 'OFICINA')->first()->id,
            'supplier_id' => Supplier::where('name', 'Proveedor 2')->first()->id,
        ]);

        Product::create([
            'name' => 'Tarjeta gráfica NVIDIA GeForce RTX 3060',
            'price' => 399.99,
            'stock' => 10,
            'description' => 'Tarjeta gráfica de última generación para gaming',
            'category_id' => Category::where('name', 'COMPONENTES')->first()->id,
            'supplier_id' => Supplier::where('name', 'Proveedor 3')->first()->id,
        ]);

        Product::create([
            'name' => 'Router WiFi Mesh Google Nest Wifi',
            'price' => 149.99,
            'stock' => 8,
            'description' => 'Sistema de red WiFi para toda la casa',
            'category_id' => Category::where('name', 'REDES')->first()->id,
            'supplier_id' => Supplier::where('name', 'Proveedor 1')->first()->id,
        ]);

        Product::create([
            'name' => 'Disco Duro SSD Samsung 1TB',
            'price' => 129.99,
            'stock' => 12,
            'description' => 'Almacenamiento de estado sólido de alta velocidad',
            'category_id' => Category::where('name', 'ALMACENAMIENTO')->first()->id,
            'supplier_id' => Supplier::where('name', 'Proveedor 2')->first()->id,
        ]);

        Product::create([
            'name' => 'Cámara web Logitech C922 Pro Stream',
            'price' => 99.99,
            'stock' => 10,
            'description' => 'Cámara web de alta calidad para streaming',
            'category_id' => Category::where('name', 'MULTIMEDIA')->first()->id,
            'supplier_id' => Supplier::where('name', 'Proveedor 3')->first()->id,
        ]);

        Product::create([
            'name' => 'Teclado Mecánico Razer BlackWidow',
            'price' => 149.99,
            'stock' => 10,
            'description' => 'Teclado mecánico para gamers',
            'category_id' => Category::where('name', 'PERIFÉRICOS')->first()->id,
            'supplier_id' => Supplier::where('name', 'Proveedor 3')->first()->id,
        ]);

        Product::create([
            'name' => 'Monitor Curvo Samsung Odyssey G7 27"',
            'price' => 699.99,
            'stock' => 8,
            'description' => 'Monitor curvo para experiencia de gaming inmersiva',
            'category_id' => Category::where('name', 'GAMER')->first()->id,
            'supplier_id' => Supplier::where('name', 'Proveedor 1')->first()->id,
        ]);

        Product::create([
            'name' => 'Impresora Multifunción HP OfficeJet Pro 9015',
            'price' => 229.99,
            'stock' => 10,
            'description' => 'Impresora multifunción para oficina doméstica',
            'category_id' => Category::where('name', 'IMPRESIÓN')->first()->id,
            'supplier_id' => Supplier::where('name', 'Proveedor 2')->first()->id,
        ]);

        Product::create([
            'name' => 'Memoria RAM Corsair Vengeance LPX 16GB',
            'price' => 89.99,
            'stock' => 15,
            'description' => 'Memoria RAM de alto rendimiento para PC',
            'category_id' => Category::where('name', 'COMPONENTES')->first()->id,
            'supplier_id' => Supplier::where('name', 'Proveedor 3')->first()->id,
        ]);

        Product::create([
            'name' => 'Router WiFi Mesh Google Nest Wifi',
            'price' => 149.99,
            'stock' => 8,
            'description' => 'Sistema de red WiFi para toda la casa',
            'category_id' => Category::where('name', 'REDES')->first()->id,
            'supplier_id' => Supplier::where('name', 'Proveedor 1')->first()->id,
        ]);

        Product::create([
            'name' => 'Disco Duro SSD Samsung 1TB',
            'price' => 129.99,
            'stock' => 12,
            'description' => 'Almacenamiento de estado sólido de alta velocidad',
            'category_id' => Category::where('name', 'ALMACENAMIENTO')->first()->id,
            'supplier_id' => Supplier::where('name', 'Proveedor 2')->first()->id,
        ]);

        Product::create([
            'name' => 'Software Microsoft Office 365 Business',
            'price' => 199.99,
            'stock' => 10,
            'description' => 'Suite de productividad para empresas',
            'category_id' => Category::where('name', 'SOFTWARE')->first()->id,
            'supplier_id' => Supplier::where('name', 'Proveedor 3')->first()->id,
        ]);

        Product::create([
            'name' => 'Cámara Web Logitech C920 HD Pro',
            'price' => 79.99,
            'stock' => 10,
            'description' => 'Cámara web de alta definición para videoconferencias',
            'category_id' => Category::where('name', 'MULTIMEDIA')->first()->id,
            'supplier_id' => Supplier::where('name', 'Proveedor 1')->first()->id,
        ]);

        Product::create([
            'name' => 'Antivirus Norton 360 Deluxe 5 Dispositivos',
            'price' => 59.99,
            'stock' => 10,
            'description' => 'Protección completa para tus dispositivos',
            'category_id' => Category::where('name', 'SEGURIDAD')->first()->id,
            'supplier_id' => Supplier::where('name', 'Proveedor 2')->first()->id,
        ]);

        Product::create([
            'name' => 'Silla de Oficina Ergonómica',
            'price' => 199.99,
            'stock' => 10,
            'description' => 'Silla ajustable para largas horas de trabajo',
            'category_id' => Category::where('name', 'OFICINA')->first()->id,
            'supplier_id' => Supplier::where('name', 'Proveedor 3')->first()->id,
        ]);

    }
}
