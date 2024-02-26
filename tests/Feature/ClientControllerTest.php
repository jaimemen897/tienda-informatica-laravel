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
        $user = Employee::first();
        $this->actingAs($user, 'employee');
    }

    public function testIndex()
    {
        $response = $this->get(route('client.index'))->assertStatus(200);
        $response->assertViewIs('clients.index');
        $response->assertViewHas('clients');
    }

    public function testShow()
    {
        $client = Client::first();
        $response = $this->get(route('client.show', $client->id))->assertStatus(200);
        $response->assertViewIs('clients.show');
        $response->assertViewHas('client');
    }

    public function testCreate()
    {
        $response = $this->get(route('client.create'))->assertStatus(200);
        $response->assertViewIs('clients.create');
    }

    public function testStore()
    {
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
        $client = Client::first();
        $response = $this->get(route('client.edit', $client->id))->assertStatus(200);
        $response->assertViewIs('clients.edit');
        $response->assertViewHas('client');
    }

    public function testUpdate()
    {
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
        $client = Client::first();
        $response = $this->get(route('profile.index', $client->id))->assertStatus(200);
        $response->assertViewIs('users.profile');
        $response->assertViewHas('user');
    }

    public function testEditImage()
    {
        $client = Client::first();
        $response = $this->get(route('client.editImage', $client->id))->assertStatus(200);
        $response->assertViewIs('clients.image');
        $response->assertViewHas('client');
    }

    public function testUpdateImage()
    {
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
        $client = Client::first();
        $response = $this->delete(route('client.destroy', $client->id))->assertStatus(302);
        $response->assertRedirect(route('client.index'));
        $this->assertDatabaseMissing('clients', [
            'id' => $client->id,
        ]);
    }
}
