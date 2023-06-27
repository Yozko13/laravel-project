<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'cart_id',
        'session_id',
        'first_name',
        'last_name',
        'company_name',
        'email',
        'country',
        'address',
        'city',
        'zip_code',
        'phone_number',
        'comment',
        'payment_type',
        'quantity',
        'sum_price',
        'status',
    ];

    /**
     * @return hasMany
     */
    public function products()
    {
        return $this->hasMany(OrderProduct::class);
    }

    /**
     * @return hasMany
     */
    public function statuses()
    {
        return $this->hasMany(OrderStatus::class);
    }
}
