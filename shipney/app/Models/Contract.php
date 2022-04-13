<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Faq
 * @package App\Models
 * @version August 29, 2019, 9:39 pm UTC
 *
 * @property \App\Models\FaqCategory faqCategory
 * @property string question
 * @property string answer
 * @property integer faq_category_id
 */
class Contract extends Model
{

    public $table = 'contract';
    
    public $fillable = [
        'type',
        'nation',
        'url'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'type' => 'string',
        'nation' => 'string',
        'url' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'type' => 'required',
        'nation' => 'required',
        'url' => 'required'
    ];
   
}
