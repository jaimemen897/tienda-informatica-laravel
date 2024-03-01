<?php

namespace Tests\Feature;

use App\Models\Employee;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class OrderControllerTest extends TestCase
{

    use RefreshDatabase;

    protected $order;


    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('migrate:fresh');
        $this->artisan('db:seed');

        $this->downOrdersCollection();
        $this->addOrders();

        $this->employee = Employee::first();
        $this->actingAs($this->employee, 'employee');

        $this->order = [
            '_id' => '60b3e3e3e4b0e3e3e4b0e3e3',
            'userId' => 1,
            'client' => json_encode(['name' => 'Test Client', 'phone' => '123456789']),
            'lineOrders' => json_encode([['funkoId' => 1, 'quantity' => 1, 'price' => 10]]),
            'totalItems' => 1,
            'total' => 10,
        ];


    }

    protected function downOrdersCollection()
    {
        $mongoConnection = DB::connection('mongodb')->getMongoDB();
        $collectionName = 'orders';
        $mongoConnection->$collectionName->drop();
    }

    protected function addOrders()
    {
        $mongoConnection = DB::connection('mongodb')->getMongoDB();

        $collectionName = 'orders';

        $orderData = [
            '_id' => '60b3e3e3e4b0e3e3e4b0e3e3',
            'userId' => 1,
            'client' => ['name' => 'Test Client', 'phone' => '123456789'],
            'lineOrders' => [['funkoId' => 1, 'quantity' => 1, 'price' => 10]],
            'totalItems' => 1,
            'total' => 10,
        ];

        $mongoConnection->$collectionName->insertOne($orderData);
    }

    public function test_index_should_return_orders()
    {
        $response = $this->get(route('orders.index'));
        $response->assertStatus(200);
        $response->assertViewIs('orders.index');
        $response->assertViewHas('orders');
    }

    public function test_show_should_return_order()
    {
        $response = $this->get(route('orders.show', $this->order['_id']));
        $response->assertStatus(200);
        $response->assertViewIs('orders.show');
        $response->assertViewHas('orders');
    }

    public function test_destroy_should_delete_order()
    {
        $response = $this->delete(route('orders.destroy', $this->order['_id']));
        $response->assertStatus(302);
        $response->assertRedirect(route('orders.index'));
        $this->assertDatabaseMissing('orders', [
            '_id' => $this->order['_id'],
        ]);
    }

    public function test_destroy_should_return_error()
    {
        $response = $this->delete(route('orders.destroy', '60b3e3e3e4b0e3e3e4b0e3e4'));
        $response->assertStatus(400);
    }








}
