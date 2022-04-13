<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class CountryNews
 * @package App\Models
 * @version August 29, 2019, 9:39 pm UTC
 *
 * @property \App\Models\CountryNews
 */
class CountryNews extends Model
{

    public $table = 'country_news';
    
    public $fillable = [
        'nation',
        'language',
        'title',
        'sub_title',
        'content',
        'writer',
        'active'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'title' => 'string',
        'content' => 'string',
        'writer' => 'string',
        'active' => "boolean"
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nation' => 'required',
        'language' => 'required',
        'title' => 'required',
        'sub_title' => 'required',
        'content' => 'required'
    ];
   
}
