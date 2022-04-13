<?php
/**
 * File name: Coupon.php
 * Last modified: 2020.08.23 at 19:56:12
 * Author: SmarterVision - https://codecanyon.net/user/smartervision
 * Copyright (c) 2020
 */

namespace App\Models;

use Eloquent as Model;

/**
 * Class Coupon
 * @package App\Models
 * @version August 23, 2020, 6:10 pm UTC
 *
 * @property string code
 * @property double discount
 * @property string discount_type
 * @property string description
 * @property dateTime expires_at
 * @property boolean enabled
 */
class Coupon extends Model
{

    public $table = 'events';
    
    public $fillable = [
        'image_thumb',
        'image',
        'type',
        'url',
        'title',
        'summary',
        'content',
        'language',
        'nation',
        'target_nation',
        'discount',
        'discount_type',
        'max_price',
        'limit_use',
        'start_date',
        'end_date',
        'dispHomeMode',
        'active'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'active' => "boolean",
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    public function discountables()
    {
        return $this->hasMany(\App\Models\Discountable::class, 'coupon_id');
    }
    
}
