<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'image',
        'is_main',
    ];

    /**
     * @return string
     */
    public function getImageUrl(): string
    {
        return asset('storage/uploads/product-images/' . $this->image);
    }
}
