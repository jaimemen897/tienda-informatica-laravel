<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordNotification;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;


class Client extends Model implements AuthenticatableContract
{
    use HasFactory;
    use Authenticatable;
    use HasUUids;
    public static $IMAGE_DEFAULT = 'https://icon-library.com/images/anonymous-icon/anonymous-icon-0.jpg';
    protected $fillable = [
        'id',
        'name',
        'surname',
        'phone',
        'email',
        'image',
        'username',
        'password',
    ];
    protected $keyType = 'string';
    public $incrementing = false;



    public function getEmailForPasswordReset()
    {
        return $this->email;
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    public function scopeSearch($query, $search)
    {
        return $query->where('name', 'LIKE', "%$search%")
            ->orWhere('surname', 'LIKE', "%$search%")
            ->orWhere('phone', 'LIKE', "%$search%")
            ->orWhere('username', 'LIKE', "%$search%")
            ->orWhere('email', 'LIKE', "%$search%");
    }

    public static function boot()
    {
        parent::boot();
        static::creating(function ($client) {
            $client->id = Str::uuid();
        });
    }
}
