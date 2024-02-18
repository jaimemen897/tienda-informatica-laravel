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
    public static $IMAGE_DEFAULT = 'https://icon-library.com/images/anonymous-icon/anonymous-icon-0.jpg';
    protected $fillable = [
        'id',
        'name',
        'email',
        'image',
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
