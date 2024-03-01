<?php
//
//namespace Database\Factories;
//
//use App\Models\Order;
//use Illuminate\Database\Eloquent\Factories\Factory;
//use Illuminate\Support\Carbon;
//
///**
// * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
// */
//class OrderFactory extends Factory
//{
//
//    protected $model = Order::class;
//
//    /**
//     * Define the model's default state.
//     *
//     * @return array<string, mixed>
//     */
//    public function definition(): array
//    {
//
//        $faker = Factory::create();
//
//        return [
//
//            'userId' => $this->faker->numberBetween(1, 10),
//            'client' => [
//                'name' => $this->faker->name(),
//                'email' => $this->faker->email(),
//                'phone' => $this->faker->phoneNumber(),
//                'address' => $this->faker->address()
//            ],
//            'lineOrders' => $this->faker->words(3, true),
//            'totalItems' => $this->faker->numberBetween(1, 10),
//            'total' => $this->faker->randomFloat(2, 1, 1000),
//            'createdAt' => Carbon::now(),
//            'updatedAt' => Carbon::now(),
//            'isDeleted' => false,
//
//        ];
//    }
//}
