<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordNotification;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Model;
use Illuminate\Support\Str;
use Illuminate\Notifications\Notifiable;


class Client extends Model implements AuthenticatableContract
{
    use HasFactory;
    use Authenticatable;
    use HasUUids;
    use Notifiable;

    public static $IMAGE_DEFAULT = 'https://icon-library.com/images/anonymous-icon/anonymous-icon-0.jpg';
    protected $fillable = [
        'id',
        'name',
        'surname',
        'phone',
        'email',
        'image',
        'password',
    ];
    protected $keyType = 'string';
    public $incrementing = false;


    public function getAuthPassword()
    {
        return $this->password;
    }


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
