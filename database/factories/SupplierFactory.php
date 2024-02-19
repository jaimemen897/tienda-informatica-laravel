<?php

namespace Database\Factories;

use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class SupplierFactory extends Factory
{
    protected $model = Supplier::class;

    public function definition(): array
    {
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'id' => $this->faker->uuid(),
            'name' => $this->faker->name(),
            'contact' => $this->faker->randomNumber(),
            'address' => $this->faker->address(),
        ];
    }
}
