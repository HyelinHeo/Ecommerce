<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class DeliveryAddress
 * @package App\Models
 * @version December 6, 2019, 1:57 pm UTC
 *
 * @property \App\Models\User user
 * @property string description
 * @property string address
 * @property string latitude
 * @property string longitude
 * @property boolean is_default
 * @property integer user_id
 */
class DeliveryAddress extends Model
{

    public $table = 'orders_pickup';
    


    public $fillable = [
        'id',
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
        'active',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'pickup_address_01' => 'string',
        'active' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'id' => 'required',
        'pickup_address_01' => 'required',
        'orderno' => 'required|exists:orders,orderno'
    ];

    /**
     * New Attributes
     *
     * @var array
     */
    protected $appends = [
        'custom_fields',
        
    ];

    public function customFieldsValues()
    {
        return $this->morphMany('App\Models\CustomFieldValue', 'customizable');
    }

    public function getCustomFieldsAttribute()
    {
        $hasCustomField = in_array(static::class,setting('custom_field_models',[]));
        if (!$hasCustomField){
            return [];
        }
        $array = $this->customFieldsValues()
            ->join('custom_fields','custom_fields.id','=','custom_field_values.custom_field_id')
            ->where('custom_fields.in_table','=',true)
            ->get()->toArray();

        return convertToAssoc($array,'name');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    // public function user()
    // {
    //     return $this->belongsTo(\App\Models\User::class, $order->user_id, 'id');
    // }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function order()
    {
        return $this->belongsTo(\App\Models\Order::class, 'orderno', 'orderno');
    }
    
}
