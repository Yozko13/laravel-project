<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderStatus extends Model
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
    const REFUSAL_STATUS    = 9;

    protected $fillable = [
        'order_id',
        'status',
    ];

    /**
     * @return array
     */
    public static function getStatusList(): array
    {
        return [
            self::PENDING_STATUS    => __('Pending'),
            self::IN_PROGRES_STATUS => __('In progres'),
            self::SUBMITED_STATUS   => __('Submited'),
            self::RECEIVED_STATUS   => __('Received'),
            self::REJECTED_STATUS   => __('Rejected'),
            self::REPIRED_STATUS    => __('Repired'),
            self::RESUBMITED_STATUS => __('Re submited'),
            self::COMPLETED_STATUS  => __('Completed'),
            self::REFUSAL_STATUS    => __('Refusal'),
        ];
    }

    /**
     * @param integer $key
     * @return string
     */
    public static function getReadableStatusByKey(int $key): string
    {
        return self::getStatusList()[$key] ?? '';
    }
}
