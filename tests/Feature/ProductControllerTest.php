<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Employee;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
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

        $response->assertViewHas('suppliers');
    }

    public function test_create_with_unauthorized_user_should_redirect()
    {
        $response = $this->get(route('product.create'));
        $response->assertStatus(302);
        $response->assertRedirect(route('login.client'));
    }

    public function test_create_product_should_insert_in_database()
    {
        $user = Employee::first();

        $categoryId = Category::first()->id;
        $supplierId = Supplier::first()->id;
        $response = $this->actingAs($user, 'employee')->post(route('product.create'), [
            'name' => 'Test Product',
            'price' => 100,
            'stock' => 10,
            'description' => 'Test Description',
            'category_id' => $categoryId,
            'supplier_id' => $supplierId,
        ]);

        $response->assertStatus(302);

        $response->assertRedirect(route('product.index'));

        $this->assertDatabaseHas('products', [
            'name' => 'Test Product',
            'price' => 100,
            'stock' => 10,
            'description' => 'Test Description',
            'category_id' => $categoryId,
            'supplier_id' => $supplierId,
        ]);
    }

    public function test_create_invalid_product_should_return_error()
    {
        $user = Employee::first();

        $response = $this->actingAs($user, 'employee')->post(route('product.create'), [
            'price' => 'invalid',
        ]);

        $response->assertStatus(302);

        $response->assertSessionHasErrors(['name', 'price', 'stock', 'description', 'category_id', 'supplier_id']);
    }

    public function test_create_product_as_unauthorized_should_redirect()
    {
        $response = $this->post(route('product.create'), [
            'name' => 'Test Product',
            'price' => 100,
            'stock' => 10,
            'description' => 'Test Description',
            'category_id' => Category::first()->id,
            'supplier_id' => Supplier::first()->id,
        ]);

        $response->assertStatus(302);

        $response->assertRedirect(route('login.client'));
    }

    public function test_show_should_return_product()
    {
        $product = Product::first();

        $response = $this->get(route('product.show', $product->id));

        $response->assertStatus(200);

        $response->assertViewIs('products.show');

        $response->assertViewHas('product', $product);
    }

    public function test_show_with_invalid_id_should_return_error()
    {
        $uuid = Str::uuid();
        $response = $this->get(route('product.show', $uuid));

        $response->assertStatus(302);

        $response->assertRedirect(route('product.index'));
    }

    public function test_edit_should_show_form()
    {
        $user = Employee::first();

        $product = Product::first();

        $response = $this->actingAs($user, 'employee')->get(route('product.edit', $product->id));

        $response->assertStatus(200);

        $response->assertViewIs('products.edit');

        $response->assertViewHas('product', $product);

        $response->assertViewHas('categories', function ($categories) {
            return $categories->every(function ($category) {
                return !$category->trashed();
            });
        });

        $response->assertViewHas('suppliers');
    }

    public function test_edit_with_invalid_id_should_return_error()
    {
        $uuid = Str::uuid();
        $user = Employee::first();
        $response = $this->actingAs($user, 'employee')->get(route('product.edit', $uuid));

        $response->assertStatus(302);

        $response->assertRedirect(route('product.index'));
    }

    public function test_edit_with_unauthorized_user_should_redirect()
    {
        $user = Employee::first();
        $response = $this->get(route('product.edit', Product::first()->id));
        $response->assertStatus(302);
        $response->assertRedirect(route('login.client'));
    }

    public function test_update_should_modify_in_database()
    {
        $user = Employee::first();

        $product = Product::first();

        $categoryId = Category::first()->id;
        $supplierId = Supplier::first()->id;

        $response = $this->actingAs($user, 'employee')->put(route('product.update', $product->id), [
            'name' => 'Test Product',
            'price' => 100,
            'stock' => 10,
            'description' => 'Test Description',
            'category_id' => $categoryId,
            'supplier_id' => $supplierId,
        ]);

        $response->assertStatus(302);

        $response->assertRedirect(route('product.index'));

        $this->assertDatabaseHas('products', [
            'name' => 'Test Product',
            'price' => 100,
            'stock' => 10,
            'description' => 'Test Description',
            'category_id' => $categoryId,
            'supplier_id' => $supplierId,
        ]);
    }

    public function test_update_with_invalid_id_should_return_error()
    {
        $uuid = Str::uuid();
        $user = Employee::first();
        $response = $this->actingAs($user, 'employee')->put(route('product.update', $uuid), [
            'name' => 'Test Product',
            'price' => 100,
            'stock' => 10,
            'description' => 'Test Description',
            'category_id' => Category::first()->id,
            'supplier_id' => Supplier::first()->id,
        ]);

        $response->assertStatus(302);

        $response->assertRedirect(route('product.index'));
    }

    public function test_update_with_unauthorized_user_should_redirect()
    {
        $response = $this->put(route('product.update', Product::first()->id), [
            'name' => 'Test Product',
            'price' => 100,
            'stock' => 10,
            'description' => 'Test Description',
            'category_id' => Category::first()->id,
            'supplier_id' => Supplier::first()->id,
        ]);
        $response->assertStatus(302);
        $response->assertRedirect(route('login.client'));
    }

    public function test_destroy_should_delete_from_database()
    {
        $user = Employee::first();

        $product = Product::first();

        $response = $this->actingAs($user, 'employee')->delete(route('product.destroy', $product->id));

        $response->assertStatus(302);

        $response->assertRedirect(route('product.index'));

        $this->assertSoftDeleted('products', [
            'id' => $product->id,
        ]);
    }

    public function test_destroy_with_invalid_id_should_return_error()
    {
        $uuid = Str::uuid();
        $user = Employee::first();
        $response = $this
            ->actingAs($user, 'employee')
            ->delete(route('product.destroy', $uuid));

        $response->assertStatus(302);

        $response->assertRedirect(route('product.index'));
    }

    public function test_destroy_with_unauthorized_user_should_redirect()
    {
        $response = $this->delete(route('product.destroy', Product::first()->id));
        $response->assertStatus(302);
        $response->assertRedirect(route('login.client'));
    }

    public function test_edit_image_should_show_form()
    {
        $user = Employee::first();

        $product = Product::first();

        $response = $this->actingAs($user, 'employee')->get(route('product.editImage', $product->id));

        $response->assertStatus(200);

        $response->assertViewIs('products.image');

        $response->assertViewHas('product', $product);
    }

    public function test_edit_image_with_invalid_id_should_return_error()
    {
        $uuid = Str::uuid();
        $user = Employee::first();
        $response = $this->actingAs($user, 'employee')
            ->get(route('product.editImage', $uuid));

        $response->assertStatus(302);

        $response->assertRedirect(route('product.index'));
    }

    public function test_edit_image_with_unauthorized_user_should_redirect()
    {
        $response = $this->get(route('product.editImage', Product::first()->id));
        $response->assertStatus(302);
        $response->assertRedirect(route('login.client'));
    }

    public function test_update_image_should_modify_in_database()
    {
        $user = Employee::first();

        $product = Product::first();
        $fakeStorage = Storage::fake('public');
        $file = UploadedFile::fake()->image('product.jpg');
        $response = $this->actingAs($user, 'employee')->patch(route('product.updateImage', $product->id), [
            'image' => $file,
        ]);

        $response->assertStatus(302);

        $response->assertRedirect(route('product.index'));
        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'image' => 'products/' . $product->id . '.jpg',
        ]);

        $fakeStorage->assertExists('products/' . $product->id . '.jpg');
    }

    public function test_update_image_with_invalid_id_should_return_error()
    {
        $fakeStorage = Storage::fake('public');
        $file = UploadedFile::fake()->image('product.jpg');

        $user = Employee::first();
        $uuid = Str::uuid();

        $response = $this->actingAs($user, 'employee')->patch(route('product.updateImage', $uuid), [
            'image' => $file,
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('product.index'));
    }

    public function test_update_image_with_unauthorized_user_should_redirect()
    {
        $response = $this->patch(route('product.updateImage', Product::first()->id), [
            'image' => 'test.jpg',
        ]);
        $response->assertStatus(302);
        $response->assertRedirect(route('login.client'));
    }
}
