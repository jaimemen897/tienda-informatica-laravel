<?php

namespace Tests\Feature;

use App\Models\Employee;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use App\Models\Client;
use Illuminate\Http\UploadedFile;

class ClientControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('migrate:refresh');
        $this->artisan('db:seed');
    }

    public function testIndex()
    {
        $user = Employee::first();
        $this->actingAs($user, 'employee');
        $response = $this->get(route('client.index'))->assertStatus(200);
        $response->assertViewIs('clients.index');
        $response->assertViewHas('clients');
    }

    public function testIndexUnauthenticated()
    {
        $response = $this->get(route('client.index'))->assertStatus(302);
        $response->assertRedirect(route('login.client'));
    }

    public function testShow()
    {
        $user = Employee::first();
        $this->actingAs($user, 'employee');
        $client = Client::first();
        $response = $this->get(route('client.show', $client->id))->assertStatus(200);
        $response->assertViewIs('clients.show');
        $response->assertViewHas('client');
    }

    public function testShowUnauthenticated()
    {
        $client = Client::first();
        $response = $this->get(route('client.show', $client->id))->assertStatus(302);
        $response->assertRedirect(route('login.client'));
    }

    public function testCreate()
    {
        $user = Employee::first();
        $this->actingAs($user, 'employee');
        $response = $this->get(route('client.create'))->assertStatus(200);
        $response->assertViewIs('clients.create');
    }

    public function testCreateUnauthenticated()
    {
        $response = $this->get(route('client.create'))->assertStatus(302);
        $response->assertRedirect(route('login.client'));
    }

    public function testStoreUnauthenticated()
    {
        $response = $this->post(route('client.store'), [
            'name' => 'invalid',
    ]);
        $response->assertStatus(302);
        $response->assertRedirect(route('login.client'));
    }

    public function testStore()
    {
        $user = Employee::first();
        $this->actingAs($user, 'employee');
        $response = $this->post(route('client.store'), [
            'name' => 'Test Name',
            'surname' => 'Test Surname',
            'phone' => '123456789',
            'email' => 'test@test.com',
            'image' => 'https://icon-library.com/images/anonymous-icon/anonymous-icon-0.jpg',
            'password' => '123456789',
        ])->assertStatus(302);

        $response->assertRedirect(route('client.index'));

        $this->assertDatabaseHas('clients', [
            'name' => 'Test Name',
            'surname' => 'Test Surname',
            'phone' => '123456789',
            'email' => 'test@test.com',
            'image' => 'https://icon-library.com/images/anonymous-icon/anonymous-icon-0.jpg',
        ]);
    }

    public function testEdit()
    {
        $user = Employee::first();
        $this->actingAs($user, 'employee');
        $client = Client::first();
        $response = $this->get(route('client.edit', $client->id))->assertStatus(200);
        $response->assertViewIs('clients.edit');
        $response->assertViewHas('client');
    }

    public function testEditUnauthenticated()
    {
        $client = Client::first();
        $response = $this->get(route('client.edit', $client->id))->assertStatus(302);
        $response->assertRedirect(route('login.client'));
    }

    public function testUpdate()
    {
        $user = Employee::first();
        $this->actingAs($user, 'employee');
        $client = Client::first();
        $response = $this->put(route('client.update', $client->id), [
            'name' => 'Test Name',
            'surname' => 'Test Surname',
            'phone' => '123456789',
            'email' => 'test@test.com',
            'image' => 'https://icon-library.com/images/anonymous-icon/anonymous-icon-0.jpg',
            'password' => '123456789',
        ])->assertStatus(302);

        $response->assertRedirect(route('client.index'));

        $this->assertDatabaseHas('clients', [
            'name' => 'Test Name',
            'surname' => 'Test Surname',
            'phone' => '123456789',
            'email' => 'test@test.com',
            'image' => 'https://icon-library.com/images/anonymous-icon/anonymous-icon-0.jpg',
        ]);
    }

    public function testProfile()
    {
        $user = Employee::first();
        $this->actingAs($user, 'employee');
        $client = Client::first();
        $response = $this->get(route('profile.index', $client->id))->assertStatus(200);
        $response->assertViewIs('users.profile');
        $response->assertViewHas('user');
    }

    public function testProfileUnauthenticated()
    {
        $client = Client::first();
        $response = $this->get(route('profile.index', $client->id))->assertStatus(302);
        $response->assertRedirect(route('login.client'));
    }

    public function testEditImage()
    {
        $user = Employee::first();
        $this->actingAs($user, 'employee');
        $client = Client::first();
        $response = $this->get(route('client.editImage', $client->id))->assertStatus(200);
        $response->assertViewIs('clients.image');
        $response->assertViewHas('client');
    }

    public function testEditImageUnauthenticated()
    {
        $client = Client::first();
        $response = $this->get(route('client.editImage', $client->id))->assertStatus(302);
        $response->assertRedirect(route('login.client'));
    }

    public function testUpdateImage()
    {
        $user = Employee::first();
        $this->actingAs($user, 'employee');
        $client = Client::first();
        $fakeStorage = Storage::fake('public');
        $file = UploadedFile::fake()->image('client.jpg');
        $response = $this->patch(route('client.updateImage', $client->id), [
            'image' => $file,
        ]);

        $response->assertStatus(302);

        $response->assertRedirect(route('client.index'));
        $this->assertDatabaseHas('clients', [
            'id' => $client->id,
            'image' => 'clients/' . $client->id . '.jpg',
        ]);

        $fakeStorage->assertExists('clients/' . $client->id . '.jpg');
    }

    public function testDestroy()
    {
        $user = Employee::first();
        $this->actingAs($user, 'employee');
        $client = Client::first();
        $response = $this->delete(route('client.destroy', $client->id))->assertStatus(302);
        $response->assertRedirect(route('client.index'));
        $this->assertDatabaseMissing('clients', [
            'id' => $client->id,
        ]);
    }

    public function testDestroyUnauthenticated()
    {
        $client = Client::first();
        $response = $this->delete(route('client.destroy', $client->id))->assertStatus(302);
        $response->assertRedirect(route('login.client'));
    }
}
