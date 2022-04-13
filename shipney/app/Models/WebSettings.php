<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class WebSettings
 * @package App\Models
 * @version August 29, 2019, 9:39 pm UTC
 *
 * @property \App\Models\WebSettings WebSettings
 */
class WebSettings extends Model
{

    public $table = 'web_settings';
    
    public $fillable = [
        'type',
        'nation',
        'language',
        'title',
        'sub_title',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'type' => 'string',
        'nation' => 'string',
        'language' => 'string',
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
