<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class NationInfo
 * @package App\Models
 * @version August 29, 2019, 9:39 pm UTC
 *
 * @property \App\Models\NationInfo nation_info
 */
class NationInfo extends Model
{

    public $table = 'nation_info';
    
    public $fillable = [
        'nation',
        'image',
        'language',
        'keep_days',
        'delivery_retry',
        'comment',
        'guide',
        'caution',
        'active'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'nation' => 'string',
        'image' => 'string',
        'language' => 'string',
        'keep_days' => 'integer',
        'delivery_retry' => 'integer',
        'comment' => 'string',
        'guide' => 'string',
        'caution' => 'string',
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
