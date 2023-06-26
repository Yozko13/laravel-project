<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory;
    use SoftDeletes;

    const PENDING_STATUS    = 1;
    const IN_PROGRES_STATUS = 2;
    const SUBMITED_STATUS   = 3;
    const RECEIVED_STATUS   = 4;
    const REJECTED_STATUS   = 5;
    const REPIRED_STATUS    = 6;
    const RESUBMITED_STATUS = 7;
    const COMPLETED_STATUS  = 8;

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
}
