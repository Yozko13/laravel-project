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
     * @return belongsToMany
     */
    public function colors()
    {
        return $this->belongsToMany(Color::class);
    }
}
