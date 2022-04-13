<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class ShippingPricePremium
 * @package App\Models
 * @version August 29, 2019, 9:39 pm UTC
 *
 * @property \App\Models\ShippingPricePremium ShippingPricePremium
 */
class ShippingPricePremium extends Model
{

    public $table = 'shipping_price_premium';
    
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
