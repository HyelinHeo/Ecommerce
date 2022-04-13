<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class PickupPriceSettings
 * @package App\Models
 * @version August 29, 2019, 9:39 pm UTC
 *
 * @property \App\Models\PickupPriceSettings pickupPriceSettings
 * @property string question
 * @property string answer
 * @property integer faq_category_id
 */
class PickupPriceSettings extends Model
{

    public $table = 'pickup_price_settings';
    
    public $fillable = [
        'type',
        'nation',
        'box_type',
        'name',
        'desc',
        'weight',
        'size',
        'price',
        'active'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'type' => 'integer',
        'nation' => 'string',
        'box_type' => 'string',
        'name' => "string",
        'desc' => "string",
        'weight' => "string",
        'size' => "string",
        'price' => "string",
        'active' => "boolean"
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'type' => 'required',
        'nation' => 'required'
    ];
   
}
