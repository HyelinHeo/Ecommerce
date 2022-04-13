<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class EventUsed
 * @package App\Models
 * @version August 23, 2021, 12:28 pm UTC
 *
 */
class EventUsed extends Model
{
   public $table = 'events_used';
    
    public $fillable = [
        'user_id',
        'orderno',
        'event_id',
        'canceled',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [

    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
    ];
   
}
