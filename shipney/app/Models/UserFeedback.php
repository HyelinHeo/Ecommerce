<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class UserFeedback
 * @package App\Models
 * @version August 29, 2019, 9:39 pm UTC
 *
 * @property \App\Models\UserFeedback UserFeedback
 */
class UserFeedback extends Model
{

    public $table = 'user_feedback';
    
    public $fillable = [
        'type',
        'user_id',
        'email',
        'phone',
        'data',
        'content',
        'done',
        'comment'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'type' => 'string',
        'user_id' => "integer",
        'email' => 'string',
        'phone' => 'string',
        'data' => "string",
        'content' => "string",
        'done' => "boolean", 
        'comment' => "string"
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'type' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id', 'id');
    }
   
}
