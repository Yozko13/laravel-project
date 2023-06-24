<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'category_id',
        'name',
        'description',
        'price',
        'in_stock',
        'active',
    ];

    /**
     * @return belongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @return belongsToMany
     */
    public function colors()
    {
        return $this->belongsToMany(Color::class);
    }

    /**
     * @return hasMany
     */
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    /**
     * @return string
     */
    public function getImageUrl(): string
    {
        $main_image = $this->images->where('is_main', true)->first();

        return asset('storage/uploads/product-images/' . $main_image->image);
    }
}
