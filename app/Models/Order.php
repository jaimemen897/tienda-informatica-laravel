<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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


}
