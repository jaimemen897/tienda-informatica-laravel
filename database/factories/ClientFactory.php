<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ClientFactory extends Factory
{
    protected $model = Client::class;

    public function definition(): array
    {
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'id' => $this->faker->uuid(),
            'name' => $this->faker->name(),
            'surname' => $this->faker->name(),
            'phone' => $this->faker->phoneNumber(),
            'email' => $this->faker->email(),
            'image' => 'https://icon-library.com/images/anonymous-icon/anonymous-icon-0.jpg',
            'password' => $this->faker->password(),
        ];
    }
}
