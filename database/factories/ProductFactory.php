<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'name' => $this->faker->name(),
            'price' => $this->faker->randomFloat(),
            'stock' => $this->faker->numberBetween(1, 1000),
            'image' => 'https://cdn-icons-png.flaticon.com/512/679/679821.png',
            'description' => $this->faker->text(),
        ];
    }
}
