<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class EmployeeFactory extends Factory
{
    protected $model = Employee::class;

    public function definition(): array
    {
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'id' => $this->faker->uuid(),
            'name' => $this->faker->name(),
            'surname' => $this->faker->name(),
            'phone' => $this->faker->phoneNumber(),
            'salary' => $this->faker->randomNumber(5),
            'position' => $this->faker->randomElement(Employee::POSITIONS),
            'email' => $this->faker->email(),
            'image' => Employee::IMAGE_DEFAULT,
            'password' => bcrypt('password')
        ];
    }
}
