<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use SoftDeletes, HasUuids, HasFactory;

    const DEFAULT_IMAGE = 'https://cdn-icons-png.flaticon.com/512/679/679821.png';

    protected $fillable = [
        'name',
        'price',
        'stock',
        'description',
        'category_id',
        'supplier_id',
    ];

    protected $attributes = [
        'image' => self::DEFAULT_IMAGE,
    ];

    protected function category(): BelongsTo
    {
        return $this->belongsTo(Category::class)->withTrashed();
    }

    protected function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    public function scopeSearch($query, $search)
    {
        if ($search) {
            return $query->where('name', 'LIKE', "%$search%");
        }
        return $query;
    }


    public function getImageUrl()
    {

        if ($this->image === self::DEFAULT_IMAGE) {
            return $this->image;
        }

        $diskStorage = Storage::disk('public');
        if ($diskStorage->exists($this->image)) {
            return $diskStorage->url($this->image);
        }
        return self::DEFAULT_IMAGE;
    }
}
