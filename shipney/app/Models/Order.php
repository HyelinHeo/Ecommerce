<?php
/**
 * File name: Order.php
 * Last modified: 2020.04.30 at 08:21:08
 * Author: SmarterVision - https://codecanyon.net/user/smartervision
 * Copyright (c) 2020
 *
 */

namespace App\Models;

use Eloquent as Model;

/**
 * Class Order
 * @package App\Models
 * @version August 31, 2019, 11:11 am UTC
 *
 * @property \App\Models\User user
 * @property \App\Models\DeliveryAddress deliveryAddress
 * @property \App\Models\Payment payment
 * @property \App\Models\OrderStatus orderStatus
 * @property \App\Models\ProductOrder[] productOrders
 * @property integer user_id
 * @property integer order_status_id
 * @property integer payment_id
 * @property double tax
 * @property double delivery_fee
 * @property string id
 * @property int delivery_address_id
 * @property string hint
 */
class Order extends Model
{

    public $table = 'orders';
    


    public $fillable = [
        'active',
        'user_id',
        'order_status_id',
        'order_status_updated_at',
        'hint',

        'user_alert',

        'payment_id',
        'photo1',
        'photo1_uuid',
        'photo2',
        'photo2_uuid',
        'photo3',
        'photo3_uuid',
        'item_count',
        'item_total_price',
        'item_main_name',
        'item_main_category',
        'weight',
        'weightunit',
        'size_width',
        'size_length',
        'size_height',
        'sizeunit',
        'boxtype',

        'nation_code',
        'post_num',
        'address1',
        'address2',
        'address3',
        'address4',
        'address_photo1',
        'address_photo1_uuid',
        'address_photo2',
        'address_photo2_uuid',
        'address_trans_done',
        'receiver_name',
        'receiver_name_photo1',
        'receiver_name_photo1_uuid',
        'receiver_name_photo2',
        'receiver_name_photo2_uuid',
        'receiver_name_trans_done',
        'receiver_eng_name',
        'receiver_phone_digit',
        'receiver_phone',
        'sender_name',
        'sender_phone',
        'shipping_msg',

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
        'orderno',

        'payment_amount',

        'regno',
        'pickup_fee',
        'pickup_base_fee',
        'pickup_add_fee',
        'shipping_price_final',
        'shipping_price_type',
        'shipping_price_base',
        'shipping_price',
        'currency',

        'pickupOrderNo',

        'accident_code',
        'accident_desc',
        'accident_result',

        'cancel_code',
        'cancel_desc',
        'cancel_result',

        'my_event_id',
        'event_id',
        'discount_price'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'user_id' => 'integer',
        'order_status_id' => 'integer',
        'hint' => 'string',
        
        'user_alert' => 'string',

        'status' => 'string',
        'payment_id' => 'integer',
        'active'=>'boolean',

        'photo1' => 'string',
        'photo1_uuid' => 'string',
        'photo2' => 'string',
        'photo2_uuid' => 'string',
        'photo3' => 'string',
        'photo3_uuid' => 'string',
        'item_count' => 'integer',
        'item_total_price' => 'string',
        'item_main_name' => 'string',
        'item_main_category' => 'string',
        'weight' => 'string',
        'weightunit' => 'string',
        'size_width' => 'string',
        'size_length' => 'string',
        'size_height' => 'string',
        'sizeunit' => 'string',
        'boxtype' => 'string',

        'nation_code' => 'string',
        'post_num' => 'string',
        'address1' => 'string',
        'address2' => 'string',
        'address3' => 'string',
        'address4' => 'string',
        'address_photo1' => 'string',
        'address_photo1_uuid' => 'string',
        'address_photo2' => 'string',
        'address_photo2_uuid' => 'string',
        'receiver_name' => 'string',
        'receiver_name_photo1' => 'string',
        'receiver_name_photo1_uuid' => 'string',
        'receiver_name_photo2' => 'string',
        'receiver_name_photo2_uuid' => 'string',
        'receiver_eng_name' => 'string',
        'receiver_phone_digit' => 'string',
        'receiver_phone' => 'string',
        
        'sender_name' => 'string',
        'sender_phone' => 'string',
        'shipping_msg' => 'string',

        'pickup_mode' => 'integer',
        'pickup_request' => 'string',
        'pickup_nation_code' => 'string',
        'pickup_post_num' => 'string',
        'pickup_address_01' => 'string',
        'pickup_address_02' => 'string',
        'pickup_reserve' => 'string',

        'orderno' => 'string',

        'payment_amount' => 'string',

        'regno' => 'string',
        'pickup_fee' => 'string',
        'shipping_price_final' => 'string',
        'shipping_price_type' => 'integer',
        'shipping_price_base' => 'string',
        'shipping_price_normal' => 'string',
        'shipping_price_premium' => 'string',
        'currency' => 'string',

        'pickupOrderNo' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id' => 'required|exists:users,id',
        'order_status_id' => 'required|exists:order_statuses,id',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function items()
    {
        return $this->belongsTo(\App\Models\product::class, 'orderno', 'orderno');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function orderStatus()
    {
        return $this->belongsTo(\App\Models\OrderStatus::class, 'order_status_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function payment()
    {
        return $this->belongsTo(\App\Models\Payment::class, 'orderno', 'orderno');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function payments()
    {
        return $this->hasMany(\App\Models\Payment::class, 'orderno', 'orderno');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function pickupInformations()
    {
        return $this->hasMany(\App\Models\DeliveryAddress::class, 'orderno', 'orderno');
    }
}
