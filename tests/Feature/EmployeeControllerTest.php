<?php

namespace Tests\Feature;

use App\Http\Controllers\EmployeeController;
use App\Models\Employee;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EmployeeControllerTest extends TestCase
{
    use RefreshDatabase;
    protected $employee;

    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('migrate:fresh');
        $this->artisan('db:seed');
        $this->employee = Employee::first();
    }

public function test_index_should_return_paginated_employees()
    {
        $response = $this->actingAs($this->employee, 'employee')->get(route('employee.index'));
        $response = $this->get(route('employee.index'));
        $response->assertStatus(200);
        $response->assertViewIs('employees.index');
        $response->assertViewHas('employees');
    }

    public function test_show_should_return_employee()
    {
        $response = $this->actingAs($this->employee, 'employee')->get(route('employee.show', $this->employee->id));
        $response->assertStatus(200);
        $response->assertViewIs('employees.show');
        $response->assertViewHas('employee');
    }

    public function test_show_should_return_error()
    {
        $response = $this->actingAs($this->employee, 'employee')->get(route('employee.show', 100));
        $response->assertStatus(302);
        $response->assertRedirect(route('employee.index'));
        $response->assertSessionHas('flash_notification.0.level', 'error');
        $response->assertSessionHas('flash_notification.0.message', 'Empleado no encontrado');
    }

    public function test_store_should_return_form()
    {
        $response = $this->actingAs($this->employee, 'employee')->get(route('employee.create'));
        $response->assertStatus(200);
        $response->assertViewIs('employees.create');
    }

    public function test_create_should_insert_in_database()
    {
        $response = $this->actingAs($this->employee, 'employee')->post(route('employee.create'), [
            'name' => 'Test Employee',
            'surname' => 'Test Employee',
            'phone' => '123456789',
            'salary' => 1000,
            'position' => 'Manager',
            'email' => 'employee@example.es',
            'password' => '123456',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('employee.index'));
        $this->assertDatabaseHas('employees', [
            'name' => 'Test Employee',
            'surname' => 'Test Employee',
            'phone' => '123456789',
            'salary' => 1000,
            'position' => 'Manager',
            'email' => 'employee@example.es',
            'password' => '123456',
        ]);
    }

    public function test_create_with_invalid_data_should_return_error()
    {
        $response = $this->actingAs($this->employee, 'employee')->post(route('employee.create'), [
            'name' => '',
            'surname' => '',
            'phone' => '',
            'salary' => '',
            'position' => '',
            'email' => '',
            'password' => '',
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['name', 'surname', 'phone', 'salary', 'position', 'email', 'password']);
    }

    public function test_edit_should_return_employee()
    {
        $employee = Employee::first();
        $response = $this->actingAs($this->employee, 'employee')->get(route('employee.edit', $this->employee->id));
        $response->assertStatus(200);
        $response->assertViewIs('employees.show');
        $response->assertViewHas('employee', $employee);
    }


}
