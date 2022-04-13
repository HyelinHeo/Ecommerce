<?php
/**
 * File name: WatchdogOrder.php
 * Last modified: 2020.04.30 at 08:21:08
 * Author: SmarterVision - https://codecanyon.net/user/smartervision
 * Copyright (c) 2020
 *
 */

namespace App\Models;

use Eloquent as Model;

/**
 * Class WatchdogOrder
 * @package App\Models
 * @version August 31, 2019, 11:11 am UTC
 *
 * @property \App\Models\User user
 * @property \App\Models\DeliveryAddress deliveryAddress
 * @property \App\Models\Payment payment
 * @property integer user_id
 * @property integer order_status_id
 * @property integer payment_id
 * @property double tax
 * @property double delivery_fee
 * @property string id
 * @property int delivery_address_id
 * @property string hint
 */
class WatchdogOrder extends Model
{

    public $table = 'orders';
    


    public $fillable = [
        'active',
        'user_id',

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
        'order_status_id',
        'order_status_updated_at',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'user_id' => 'integer',

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
    public function orderStatus()
    {
        return $this->belongsTo(\App\Models\OrderStatus::class, 'order_status_id', 'id');
    }
}
