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

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'userId',
        'client',
        'lineOrders',
        'totalItems',
        'total',
    ];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($order) {
            $order->id = Str::uuid();
        });
    }

}
