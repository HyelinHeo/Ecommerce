<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class OrderPickup
 * @package App\Models
 * @version August 29, 2019, 9:39 pm UTC
 *
 */
class OrderPickup extends Model
{

    public $table = 'orders_pickup';
    
    public $fillable = [
        'orderno',
        'pickup_mode',
        'pickup_request',
        'pickup_nation_code',
        'pickup_post_num',
        'pickup_address_01',
        'pickup_address_02',
        'pickup_reserve',
        'pickup_type',
        'pickup_jeju',
        'pickup_island',
        'boxtype',
        'pickup_fee',
        'pickup_base_fee',
        'pickup_add_fee',
        'boxtype_real',
        'pickup_fee_real',
        'pickup_base_fee_real',
        'pickup_add_fee_real',
        'pickup_currency',
        'pickupOrderNo',
        'pickupStatus',
        'approvalDt',
        'assignDt',
        'pickUpDt',
        'warehousingDt',
        'gatheredDt',
        'cancelRequestDt',
        'cancelDt',
        'invoiceNumber',
        'deliveryCode',
        'deliveryStatus',
        'shipRegisterDt',
        'shipStartingDt',
        'shipCompleteDt',
        'pickerName',
        'pickerMobile',
        'pickerPictureURI',
        'orderMemo',
        'cancelRequestCode',
        'cancelReason',
        'errorCode',
        'errorMessage',
        'active'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'active' => "boolean"
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'orderno' => 'required',
    ];
   
}
