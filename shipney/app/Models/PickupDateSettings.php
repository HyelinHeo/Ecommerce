<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class PickupDateSettings
 * @package App\Models
 * @version August 29, 2019, 9:39 pm UTC
 *
 * @property \App\Models\PickupDateSettings
 */
class PickupDateSettings extends Model
{

    public $table = 'pickup_date_settings';
    
    public $fillable = [
        'nation',
        'duration',
        'invalidday',
        'saturday',
        'sunday',
        'active'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'nation' => 'string',
        'duration' => 'integer',
        'invalidday' => 'string',
        'saturday' => "string",
        'sunday' => "string",
        'active' => "boolean"
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nation' => 'required'
    ];
   
}
