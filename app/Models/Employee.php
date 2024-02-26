<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordNotification;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class Employee extends Model implements AuthenticatableContract
{
    use Authenticatable;
    use HasFactory;
    use HasUUids;

    const IMAGE_DEFAULT = 'https://icon-library.com/images/anonymous-icon/anonymous-icon-0.jpg';
    public const POSITIONS = ['Manager', 'Developer', 'Designer', 'Tester', 'Sales'];

    protected $fillable = [
        'id',
        'name',
        'surname',
        'phone',
        'salary',
        'position',
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
            ->orWhere('email', 'LIKE', "%$search%")
            ->orWhere('position', 'LIKE', "%$search%");
    }

    public static function boot()
    {
        parent::boot();
        static::creating(function ($employee) {
            $employee->id = Str::uuid();
        });
    }

    public function getImageUrl()
    {

        if ($this->image === self::IMAGE_DEFAULT) {
            return $this->image;
        }

        $diskStorage = Storage::disk('public');
        if ($diskStorage->exists($this->image)) {
            return $diskStorage->url($this->image);
        }
        return self::IMAGE_DEFAULT;
    }
}
