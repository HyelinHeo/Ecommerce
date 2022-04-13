<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Notice
 * @package App\Models
 * @version August 29, 2019, 9:39 pm UTC
 *
 * @property \App\Models\Notice notice
 */
class Notice extends Model
{

    public $table = 'notice';
    
    public $fillable = [
        'nation',
        'language',
        'title',
        'content',
        'writer',
        'active',
        'disptop',
        'disptop_order',
        'dispHomeMode'
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
        'active' => "boolean",
        'disptop' => "boolean", 
        'disptop_order' => "integer",
        'dispHomeMode' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required',
        'content' => 'required'
    ];
   
}
