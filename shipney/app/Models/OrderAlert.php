<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class OrderAlert
 * @package App\Models
 * @version August 29, 2019, 9:39 pm UTC
 *
 * @property \App\Models\OrderAlert OrderAlert
 */
class OrderAlert extends Model
{
    public $table = 'orders_alert';
    
    public $fillable = [
        'type',
        'orderno',
        'weight',
        'size_width',
        'size_length',
        'size_height',
        'price',
        'comment',
        'occure_date',
        'limit_date',
        'need_action',
        'result',
        'result_comment',
        'active'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'type' => "integer",
        'orderno' => 'string',
        'weight' => 'string',
        'size_width' => 'string',
        'size_length' => 'string',
        'size_height' => 'string',
        'price' => 'string',
        'comment' => 'string',
        'need_action' => "integer",
        'result' => 'integer',
        'result_comment' => 'string',
        'active' => "boolean",
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'type' => 'required',
        'orderno' => 'required'
    ];
   
}
