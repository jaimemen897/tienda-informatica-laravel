<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;
use Illuminate\Support\Str;
use MongoDB\Laravel\Eloquent\SoftDeletes;

class Order extends Model
{

    use SoftDeletes;
    use HasFactory;

    protected $connection = 'mongodb';

    protected $collection = 'orders';



    protected $fillable = [
        'userId',
        'client',
        'lineOrders',
        'totalItems',
        'total',
    ];


    public function update(array $attributes = [], array $options = [])
    {
        flash($attributes);
//        $this->lineOrders = $attributes['lineOrders'];
//        $this->totalItems = $attributes['totalItems'];
//        $this->total = $attributes['total'];
//        $this->save();
    }

    public static function boot()
    {
        parent::boot();
        static::creating(function ($order) {
            $order->id = Str::uuid();
        });
    }

}
