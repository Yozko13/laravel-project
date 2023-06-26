<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderProduct extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'order_id',
        'product_id',
        'color_id',
        'name',
        'price',
        'custom_text',
    ];

    /**
     * @return belongsTo
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * @return belongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * @return belongsTo
     */
    public function color()
    {
        return $this->belongsTo(Color::class);
    }
}
