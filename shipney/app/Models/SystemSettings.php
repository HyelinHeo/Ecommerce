<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class SystemSettings
 * @package App\Models
 * @version August 29, 2019, 9:39 pm UTC
 *
 * @property \App\Models\SystemSettings SystemSettings
 */
class SystemSettings extends Model
{

    public $table = 'system_settings';
    
    public $fillable = [
        'key',
        'type',
        'nation',
        'value',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'key' => 'string',
        'type' => 'string',
        'nation' => 'string',
        'value' => 'string',
        'active' => "boolean"
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'key' => 'required',
        'type' => 'required',
        'nation' => 'required'
    ];
   
}
