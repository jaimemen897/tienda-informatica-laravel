<?php

namespace Tests\Feature;

use App\Http\Controllers\SupplierController;
use App\Models\Employee;
use App\Models\Supplier;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SupplierControllerTest extends TestCase
{

    use RefreshDatabase;

    protected $employee;

    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('migrate:fresh');
        $this->artisan('db:seed');
        $this->employee = Employee::first();
        $this->actingAs($this->employee, 'employee');
    }

    public function test_index_should_return_paginated_suppliers()
    {
        $response = $this->get(route('supplier.index'));
        $response->assertStatus(200);
        $response->assertViewIs('suppliers.index');
        $response->assertViewHas('suppliers');
    }


    public function test_create_should_return_form()
    {
        $response = $this->get(route('supplier.create'));
        $response->assertStatus(200);
        $response->assertViewIs('suppliers.create');
    }

    public function test_create_supplier_should_insert_in_database()
    {
        $supplier = [
            'name' => 'Test Supplier',
            'contact' => 9,
            'address' => 'Test Address',
        ];
        $response = $this->post(route('supplier.store'), $supplier);
        $response->assertRedirect(route('supplier.index'));
        $this->assertDatabaseHas('suppliers', $supplier);
    }

    public function test_create_invalid_supplier_should_return_errors()
    {
        $supplier = [
            'name' => '',
            'contact' => '',
            'address' => '',
        ];
        $response = $this->post(route('supplier.store'), $supplier);
        $response->assertSessionHasErrors(['name', 'contact', 'address']);
    }

    public function test_edit_should_return_form()
    {
        $supplier = Supplier::factory()->create();
        $response = $this->get(route('supplier.edit', $supplier));
        $response->assertStatus(200);
        $response->assertViewIs('suppliers.edit');
    }

    public function test_update_should_modify_supplier_in_database()
    {
        $supplier = Supplier::factory()->create();
        $newSupplier = [
            'name' => 'New Supplier',
            'contact' => 9,
            'address' => 'New Address',
        ];
        $response = $this->put(route('supplier.update', $supplier), $newSupplier);
        $response->assertRedirect(route('supplier.index'));
        $this->assertDatabaseHas('suppliers', $newSupplier);
    }

    public function test_update_invalid_supplier_should_return_errors()
    {
        $supplier = Supplier::factory()->create();
        $newSupplier = [
            'name' => '',
            'contact' => '',
            'address' => '',
        ];
        $response = $this->put(route('supplier.update', $supplier), $newSupplier);
        $response->assertSessionHasErrors(['name', 'contact', 'address']);
    }

    public function test_destroy_should_delete_supplier_from_database()
    {
        $supplier = Supplier::factory()->create();
        $response = $this->delete(route('supplier.destroy', $supplier));
        $response->assertRedirect(route('supplier.index'));
        $this->assertDatabaseMissing('suppliers', $supplier->toArray());
    }

    public function test_show_should_return_supplier()
    {
        $supplier = Supplier::factory()->create();
        $response = $this->get(route('supplier.show', $supplier));
        $response->assertStatus(200);
        $response->assertViewIs('suppliers.show');
        $response->assertViewHas('supplier');
    }
}
