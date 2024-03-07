<?php

namespace Tests\Feature;

use App\Models\Employee;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CheckoutControllerTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('migrate:fresh');
        $this->artisan('db:seed');


        $this->employee = Employee::first();
        $this->actingAs($this->employee, 'employee');

        $this->order = [
            'id' => '60b3e3e3e4b0e3e3e4b0e3e3',
            'userId' => $this->employee->id,
            'client' => json_encode(['name' => 'Test Client', 'phone' => '123456789']),
            'lineOrders' => json_encode([['productId' => 1, 'quantity' => 1, 'price' => 10]]),
            'totalItems' => 1,
            'total' => 10,
        ];

    }

    public function test_index_should_return_paginated_orders()
    {
        $this->session(['cart' => [['productId' => 1, 'quantity' => 1, 'price' => 10]]]);

        $response = $this->get(route('checkout.index'));
        $response->assertStatus(200);
        $response->assertViewIs('checkout.index');
    }

    public function test_index_should_return_redirect_to_cart_if_cart_is_empty()
    {
        $response = $this->get(route('checkout.index'));
        $response->assertStatus(302);
        $response->assertRedirect(route('product.index'));
    }
}
