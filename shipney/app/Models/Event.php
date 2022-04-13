<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Event
 * @package App\Models
 * @version August 23, 2021, 12:28 pm UTC
 *
 * @property string image
 * @property string type
 * @property string url
 * @property string language
 * @property string title
 * @property string content
 * @property dateTime start_date
 * @property dateTime end_date
 */
class Event extends Model
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function market()
    {
        return $this->belongsTo(\App\Models\Market::class, 'market_id', 'id');
    }
    
}
