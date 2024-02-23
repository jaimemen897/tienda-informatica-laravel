<?php

namespace Tests\Feature;

use App\Models\Client;
use App\Models\Product;
use Illuminate\Support\Str;
use Tests\TestCase;

class CartControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('migrate:fresh');
        $this->artisan('db:seed');
    }

    public function test_add_to_cart_unauthorized()
    {
        $response = $this->post(route('cart.add'));
        $response->assertStatus(302);
        $response->assertRedirect(route('login.client'));
    }

    public function test_add_to_cart_no_product_id()
    {
        $user = Client::first();
        $response = $this->actingAs($user, 'web')->post(route('cart.add'));
        $response->assertStatus(302);
        $response->assertSessionHas('flash_notification');
    }

    public function test_add_to_cart_product_not_found()
    {
        $user = Client::first();
        $response = $this->actingAs($user, 'web')->post(route('cart.add'), ['product_id' => Str::uuid()]);
        $response->assertStatus(302);
        $response->assertSessionHas('flash_notification');
    }

    public function test_add_to_cart_no_stock()
    {
        $user = Client::first();
        $product = Product::first();
        $product->stock = 0;
        $product->save();

        $response = $this->actingAs($user, 'web')->post(route('cart.add'), ['product_id' => $product->id]);
        $response->assertStatus(302);
        $response->assertSessionHas('flash_notification');
    }

    public function test_add_to_cart_success()
    {
        $user = Client::first();
        $product = Product::first();
        $product->stock = 10;
        $product->save();

        $response = $this->actingAs($user, 'web')->post(route('cart.add'), ['product_id' => $product->id]);
        $response->assertStatus(302);
        $response->assertSessionHas('flash_notification');
    }

    public function test_increase_quantity_unauthorized()
    {
        $response = $this->post(route('cart.increase'));
        $response->assertStatus(302);
        $response->assertRedirect(route('login.client'));
    }

    public function test_increase_quantity_no_product_id()
    {
        $user = Client::first();
        $response = $this->actingAs($user, 'web')->post(route('cart.increase'));
        $response->assertStatus(302);
        $response->assertSessionHas('flash_notification');
    }

    public function test_increase_quantity_product_not_found()
    {
        $user = Client::first();
        $response = $this->actingAs($user, 'web')->post(route('cart.increase'), ['product_id' => Str::uuid()]);
        $response->assertStatus(302);
        $response->assertSessionHas('flash_notification');
    }

    public function test_increase_quantity_no_stock()
    {
        $user = Client::first();
        $product = Product::first();
        $product->stock = 0;
        $product->save();

        $response = $this->actingAs($user, 'web')->post(route('cart.increase'), ['product_id' => $product->id]);
        $response->assertStatus(302);
        $response->assertSessionHas('flash_notification');
    }

    public function test_increase_quantity_success()
    {
        $user = Client::first();
        $product = Product::first();
        $product->stock = 10;
        $product->save();

        $response = $this->actingAs($user, 'web')->post(route('cart.increase'), ['product_id' => $product->id]);
        $response->assertStatus(302);
        $response->assertSessionHas('flash_notification');
    }

    public function test_decrease_quantity_unauthorized()
    {
        $response = $this->post(route('cart.decrease'));
        $response->assertStatus(302);
        $response->assertRedirect(route('login.client'));
    }

    public function test_decrease_quantity_no_product_id()
    {
        $user = Client::first();
        $response = $this->actingAs($user, 'web')->post(route('cart.decrease'));
        $response->assertStatus(302);
        $response->assertSessionHas('flash_notification');
    }

    public function test_decrease_quantity_product_not_found()
    {
        $user = Client::first();
        $response = $this->actingAs($user, 'web')->post(route('cart.decrease'), ['product_id' => Str::uuid()]);
        $response->assertStatus(302);
        $response->assertSessionHas('flash_notification');
    }

    public function test_decrease_quantity_success()
    {
        $user = Client::first();
        $product = Product::first();
        $product->stock = 10;
        $product->save();

        $response = $this->actingAs($user, 'web')->post(route('cart.decrease'), ['product_id' => $product->id]);
        $response->assertStatus(302);
        $response->assertSessionHas('flash_notification');
    }

    public function test_remove_from_cart_unauthorized()
    {
        $response = $this->delete(route('cart.remove'));
        $response->assertStatus(302);
        $response->assertRedirect(route('login.client'));
    }

    public function test_remove_from_cart_no_product_id()
    {
        $user = Client::first();
        $response = $this->actingAs($user, 'web')->delete(route('cart.remove'));
        $response->assertStatus(302);
        $response->assertSessionHas('flash_notification');
    }

    public function test_remove_from_cart_product_not_found()
    {
        $user = Client::first();
        $response = $this->actingAs($user, 'web')->delete(route('cart.remove'), ['product_id' => Str::uuid()]);
        $response->assertStatus(302);
        $response->assertSessionHas('flash_notification');
    }

    public function test_remove_from_cart_success()
    {
        $user = Client::first();
        $product = Product::first();
        $product->stock = 10;
        $product->save();

        $response = $this->actingAs($user, 'web')->delete(route('cart.remove'), ['product_id' => $product->id]);
        $response->assertStatus(302);
        $response->assertSessionHas('flash_notification');
    }
}
