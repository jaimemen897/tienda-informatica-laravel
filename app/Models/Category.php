<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes, HasUuids, HasFactory;

    protected $fillable = [
        'name',
    ];

    protected $casts = [
        'id' => 'string',
    ];


    public function products()
    {
        return $this->hasMany(Product::class);
    }


    public function scopeSearch($query, $search)
    {
        if ($search) {
            return $query->where('name', 'like', "%$search%");
        }
        return $query;
    }
}
