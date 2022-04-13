<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class NationShipping
 * @package App\Models
 * @version August 29, 2019, 9:39 pm UTC
 *
 * @property \App\Models\NationShipping nation_shipping
 */
class NationShipping extends Model
{

    public $table = 'nation_shipping';
    
    public $fillable = [
        'departure',
        'destination',
        'shipping_duration',
        'delivery_duration',
        'active'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'departure' => 'string',
        'destination' => 'string',
        'shipping_duration' => 'integer',
        'delivery_duration' => 'integer',
        'active' => "boolean"
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'departure' => 'required',
        'destination' => 'required'
    ];
   
}
