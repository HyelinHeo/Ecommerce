<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Tracking
 * @package App\Models
 * @version August 29, 2019, 9:39 pm UTC
 *
 * @property \App\Models\UserFeedback UserFeedback
 */
class Tracking extends Model
{
    public $table = 'tracking';
    
    public $fillable = [
        'orderno',
        'REG',
        'PICKUP_DONE',
        'WAREHOUSE_WAIT',
        'WAREHOUSE_IN',
        'WAREHOUSE_OUT',
        'SHIPPING_DEPATURE',
        'SHIPPING_ARRIVAL',
        'SHIPPING_CUSTOMS',
        'SHIPPING_CUSTOMS_CLEAR',
        'SHIPPING_DELIVERY_START',
        'SHIPPING_DELIVERY_DONE',
        'cancel'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'orderno' => 'string',
        'REG' => "integer",
        'PICKUP_DONE' => 'string',
        'WAREHOUSE_WAIT' => 'string',
        'WAREHOUSE_IN' => "string",
        'WAREHOUSE_OUT' => "string",
        'SHIPPING_DEPATURE' => "string",
        'SHIPPING_ARRIVAL' => "string",
        'SHIPPING_CUSTOMS' => "string",
        'SHIPPING_CUSTOMS_CLEAR' => "string",
        'SHIPPING_DELIVERY_START' => "string",
        'SHIPPING_DELIVERY_DONE' => "string",
        'cancel' => "boolean",
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'orderno' => 'required'
    ];
}
