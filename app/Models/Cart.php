<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'session_id',
        'quantity',
        'sum_price',
        'ordered',
    ];

    /**
     * @return hasMany
     */
    public function products()
    {
        return $this->hasMany(CartProduct::class);
    }
}
