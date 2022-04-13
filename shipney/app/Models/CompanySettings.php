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
class CompanySettings extends Model
{
    public $table = 'company_settings';
    
    public $fillable = [
        'nation',
        'language',
        'data1',
        'data2',
        'active'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'nation' => 'string',
        'language' => 'string',
        'data1' => 'string',
        'data2' => 'string',
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
