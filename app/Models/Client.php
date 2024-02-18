<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Client extends Model
{
    use HasFactory;
    use HasUUids;

    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
    ];
    protected $keyType = 'string';
    public $incrementing = false;

    public function scopeSearch($query, $search)
    {
        return $query->where('name', 'like', '%' . $search . '%')
            ->orWhere('email', 'like', '%' . $search . '%');
    }

    public static function boot()
    {
        parent::boot();
        static::creating(function ($category) {
            $category->id = Str::uuid();
        });
    }
}
