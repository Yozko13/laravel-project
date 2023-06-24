<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'image',
        'icon',
        'active',
    ];

    /**
     * @return hasMany
     */
    public function products()
    {
        return $this->hasMany(Product::class)->whereActive(true)->where('in_stock', true)->orderBy('price');
    }

    /**
     * @return string
     */
    public function getImageUrl(): string
    {
        return asset('storage/uploads/categories/' . $this->image);
    }
}
