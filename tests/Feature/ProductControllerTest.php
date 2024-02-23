<?php

namespace Tests\Feature;

use App\Models\Employee;
use App\Models\Product;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{

    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('migrate:fresh');
        $this->artisan('db:seed');
    }

    public function test_index_should_return_paginated_products()
    {
        $response = $this->get(route('product.index'));
        $response->assertStatus(200);
        $response->assertViewIs('products.index');
        $response->assertViewHas('products');
    }

    public function test_index_with_search_should_return_paginated_products()
    {
        $product = Product::factory()->create();

        $product->name = 'Test Product';

        $product->save();

        $response = $this->get(route('product.index', ['search' => 'Test Product']));

        $response->assertStatus(200);

        $response->assertViewIs('products.index');
        $response->assertViewHas('products', function ($products) use ($product) {
            return $products->contains($product);
        });
    }


    public function test_create_should_return_form()
    {
        $user = Employee::first();

        $response = $this->actingAs($user, 'employee')->get(route('product.create'));

        $response->assertStatus(200);

        $response->assertViewIs('products.create');

        $response->assertViewHas('categories', function ($categories) {
            return $categories->every(function ($category) {
                return !$category->trashed();
            });
        });

    }
}
