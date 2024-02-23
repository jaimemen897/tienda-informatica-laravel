<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Employee;
use App\Models\Product;
use Tests\TestCase;

class CategoryControllerTest extends TestCase
{
    protected $employee;

    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('migrate:fresh');
        $this->artisan('db:seed');
        $this->employee = Employee::first();
    }

    public function test_index_should_return_paginated_categories()
    {
        $response = $this->actingAs($this->employee, 'employee')->get(route('category.index'));
        $response->assertStatus(200);
        $response->assertViewIs('category.index');
        $response->assertViewHas('categories');
    }

    public function test_create_should_return_form()
    {
        $response = $this->actingAs($this->employee, 'employee')->get(route('category.create'));
        $response->assertStatus(200);
        $response->assertViewIs('category.create');
    }

    public function test_store_should_insert_in_database()
    {
        $response = $this->actingAs($this->employee, 'employee')->post(route('category.store'), [
            'name' => 'Test Category',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('category.index'));

        $this->assertDatabaseHas('categories', [
            'name' => 'Test Category',
        ]);
    }

    public function test_store_with_invalid_data_should_return_error()
    {
        $response = $this->actingAs($this->employee, 'employee')->post(route('category.store'), [
            'name' => '',
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['name']);
    }

    public function test_show_should_return_category()
    {
        $category = Category::first();

        $response = $this->actingAs($this->employee, 'employee')->get(route('category.show', $category->id));

        $response->assertStatus(200);
        $response->assertViewIs('category.show');
        $response->assertViewHas('category', $category);
    }

    public function test_update_should_modify_in_database()
    {
        $category = Category::first();

        $response = $this->actingAs($this->employee, 'employee')->put(route('category.update', $category->id), [
            'name' => 'Updated Category',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('category.index'));

        $this->assertDatabaseHas('categories', [
            'name' => 'Updated Category',
        ]);
    }

    public function test_update_with_invalid_data_should_return_error()
    {
        $category = Category::first();

        $response = $this->actingAs($this->employee, 'employee')->put(route('category.update', $category->id), [
            'name' => '',
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['name']);
    }

    public function test_edit_should_show_form()
    {
        $category = Category::first();

        $response = $this->actingAs($this->employee, 'employee')->get(route('category.edit', $category->id));

        $response->assertStatus(200);
        $response->assertViewIs('category.edit');
        $response->assertViewHas('category', $category);
    }

    public function test_deactivate_should_deactivate_category()
    {
        $category = Category::first();

        $response = $this->actingAs($this->employee, 'employee')->get(route('category.deactivate', $category->id));

        $response->assertStatus(302);
        $response->assertRedirect(route('category.index'));

        $this->assertSoftDeleted('categories', [
            'id' => $category->id,
        ]);
    }

    public function test_activate_should_activate_category()
    {
        $category = Category::first();
        $category->delete(); // Deactivate the category first

        $response = $this->actingAs($this->employee, 'employee')->get(route('category.activate', $category->id));

        $response->assertStatus(302);
        $response->assertRedirect(route('category.index'));

        $this->assertDatabaseHas('categories', [
            'id' => $category->id,
        ]);
    }

    public function test_destroy_should_delete_from_database()
    {
        $category = Category::factory()->create();
        $category->save();

        $response = $this->actingAs($this->employee, 'employee')->delete(route('category.destroy', $category->id));

        $response->assertStatus(302);
        $response->assertRedirect(route('category.index'));

        $this->assertDatabaseMissing('categories', [
            'id' => $category->id,
        ]);
    }

    public function test_destroy_with_products_should_return_error()
    {
        $category = Category::first();
        $product = Product::factory()->create(['category_id' => $category->id]);

        $response = $this->actingAs($this->employee, 'employee')->delete(route('category.destroy', $category->id));

        $response->assertStatus(302);
        $response->assertRedirect(route('category.index'));
    }

    public function test_create_with_unauthorized_user_should_redirect()
    {
        $response = $this->get(route('category.create'));
        $response->assertStatus(302);
        $response->assertRedirect(route('login.client'));
    }

    public function test_store_with_unauthorized_user_should_redirect()
    {
        $response = $this->post(route('category.store'), [
            'name' => 'Test Category',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('login.client'));
    }

    public function test_show_with_unauthorized_user_should_redirect()
    {
        $category = Category::first();

        $response = $this->get(route('category.show', $category->id));

        $response->assertStatus(302);
        $response->assertRedirect(route('login.client'));
    }

    public function test_update_with_unauthorized_user_should_redirect()
    {
        $category = Category::first();

        $response = $this->put(route('category.update', $category->id), [
            'name' => 'Updated Category',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('login.client'));
    }

    public function test_edit_with_unauthorized_user_should_redirect()
    {
        $category = Category::first();

        $response = $this->get(route('category.edit', $category->id));

        $response->assertStatus(302);
        $response->assertRedirect(route('login.client'));
    }

    public function test_deactivate_with_unauthorized_user_should_redirect()
    {
        $category = Category::first();

        $response = $this->get(route('category.deactivate', $category->id));

        $response->assertStatus(302);
        $response->assertRedirect(route('login.client'));
    }

    public function test_activate_with_unauthorized_user_should_redirect()
    {
        $category = Category::first();
        $category->delete(); // Deactivate the category first

        $response = $this->get(route('category.activate', $category->id));

        $response->assertStatus(302);
        $response->assertRedirect(route('login.client'));
    }

    public function test_destroy_with_unauthorized_user_should_redirect()
    {
        $category = Category::first();

        $response = $this->delete(route('category.destroy', $category->id));

        $response->assertStatus(302);
        $response->assertRedirect(route('login.client'));
    }
}
