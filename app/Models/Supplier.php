<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Supplier extends Model
{
    use HasFactory;
    use HasUUids;

    protected $fillable = [
        'id',
        'name',
        'contact',
        'address',
    ];

    protected $keyType = 'string';
    public $incrementing = false;

    public function scopeSearch($query, $search)
    {
        return $query->where('name', 'LIKE', "%$search%")
            ->orWhere('contact', 'LIKE', "%$search%")
            ->orWhere('address', 'LIKE', "%$search%");
    }

    protected function products()
    {
        return $this->hasMany(Product::class);
    }

    public static function boot()
    {
        parent::boot();
        static::creating(function ($employee) {
            $employee->id = Str::uuid();
        });
    }
}
