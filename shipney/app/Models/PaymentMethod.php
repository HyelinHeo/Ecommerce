<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class PaymentMethod
 * @package App\Models
 * @version August 29, 2019, 9:39 pm UTC
 *
 * @property \App\Models\User user
 * @property double price
 * @property string description
 * @property string status
 * @property string method
 * @property integer user_id
 */
class PaymentMethod extends Model
{

    public $table = 'payment_method';
    


    public $fillable = [
        'user_id',
        'pg',
        'method_token',
        'name',
        'billkey',
        'authkey',
        'card_code',
        'card_num',
        'card_kind',
        'check_flag'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'card_kind' => 'integer',
        'check_flag' => 'integer',
        'user_id' => 'integer',
        'active'=>'boolean',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'billkey' => 'required',
        'user_id' => 'required|exists:users,id',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id', 'id');
    }
    
}
