<?php

namespace Tests\Feature;

use App\Models\Employee;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
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
        $this->actingAs($this->employee, 'employee');
    }

    public function test_index_should_return_paginated_employees()
    {
        $response = $this->get(route('employee.index'));
        $response->assertStatus(200);
        $response->assertViewIs('employees.index');
        $response->assertViewHas('employees');
    }

    public function test_show_should_return_employee()
    {
        $response = $this->get(route('employee.show', $this->employee->id));
        $response->assertStatus(200);
        $response->assertViewIs('employees.show');
        $response->assertViewHas('employee');
    }

    public function test_store_should_return_form()
    {
        $response = $this->get(route('employee.create'));
        $response->assertStatus(200);
        $response->assertViewIs('employees.create');
    }

    public function test_create_should_insert_in_database()
    {
        $response = $this->post(route('employee.create'), [
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
            'image' => 'https://icon-library.com/images/anonymous-icon/anonymous-icon-0.jpg'
        ]);
    }

    public function test_create_with_invalid_data_should_return_error()
    {
        $response = $this->post(route('employee.create'), [
            'name' => '',
            'surname' => '',
            'phone' => '',
            'salary' => '',
            'position' => '',
            'email' => '',
            'image' => '',
            'password' => '',
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['name', 'surname', 'phone', 'salary', 'position', 'email', 'password']);
    }

    public function test_edit_should_return_employee()
    {
        $employee = Employee::first();
        $response = $this->get(route('employee.edit', $this->employee->id));
        $response->assertStatus(200);
        $response->assertViewIs('employees.edit');
        $response->assertViewHas('employee', $employee);
    }

    public function test_update_should_modify_database()
    {
        $user = Employee::first();
        $employee = Employee::first();

        $response = $this->put(route('employee.update', $employee->id), [
            'name' => 'Test Employee',
            'surname' => 'Test Employee',
            'phone' => '123456789',
            'salary' => 1000,
            'position' => 'Manager',
            'email' => 'employee@example.com',
            'image' => 'https://icon-library.com/images/anonymous-icon/anonymous-icon-0.jpg',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('employee.index'));
        $this->assertDatabaseHas('employees', [
            'name' => 'Test Employee',
            'surname' => 'Test Employee',
            'phone' => '123456789',
            'salary' => 1000,
            'position' => 'Manager',
            'email' => 'employee@example.com',
            'image' => 'https://icon-library.com/images/anonymous-icon/anonymous-icon-0.jpg',
        ]);
    }

    public function test_update_with_invalid_data_should_return_error()
    {
        $employee = Employee::first();
        $response = $this->put(route('employee.update', $employee->id), [
            'name' => '',
            'surname' => '',
            'phone' => '',
            'salary' => '',
            'position' => '',
            'email' => '',
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['name', 'surname', 'phone', 'salary', 'position', 'email']);
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

    public function test_update_image_should_modify_in_database()
    {
        $user = Employee::first();

        $employee = Employee::first();
        $fakeStorage = Storage::fake('public');
        $file = UploadedFile::fake()->image('product.jpg');
        $response = $this->actingAs($user, 'employee')->patch(route('employee.updateImage', $employee->id), [
            'image' => $file,
        ]);

        $response->assertStatus(302);

        $response->assertRedirect(route('employee.index'));
        $this->assertDatabaseHas('employees', [
            'id' => $employee->id,
            'image' => 'employees/' . $employee->id . '.jpg',
        ]);

        $fakeStorage->assertExists('employees/' . $employee->id . '.jpg');
    }

    public function test_update_image_with_invalid_id_should_return_error()
    {
        $fakeStorage = Storage::fake('public');
        $file = UploadedFile::fake()->image('product.jpg');

        $user = Employee::first();
        $uuid = Str::uuid();

        $response = $this->actingAs($user, 'employee')->patch(route('employee.updateImage', $uuid), [
            'image' => $file,
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('employee.index'));
    }


    public function test_destroy_should_delete_from_database()
    {
        $employee = Employee::first();
        $response = $this->delete(route('employee.destroy', $employee->id));
        $response->assertStatus(302);
        $response->assertRedirect(route('employee.index'));
        $this->assertDatabaseMissing('employees', [
            'id' => $employee->id,
        ]);
    }

}
