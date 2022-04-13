<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class ShippingPriceNormal
 * @package App\Models
 * @version August 29, 2019, 9:39 pm UTC
 *
 * @property \App\Models\ShippingPriceNormal ShippingPriceNormal
 */
class ShippingPriceNormal extends Model
{

    public $table = 'shipping_price_normal';
    
    public $fillable = [
        'nation',
        'weight',
        'nation',
        'price_base',
        'price',
        'profit_rate',
        'profit',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'nation' => 'string',
        'weight' => 'string',
        'price' => 'integer',
    ];
}
