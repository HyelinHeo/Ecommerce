<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Payment
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
class Payment extends Model
{

    public $table = 'payments';
    
    public $fillable = [
        'user_id',
        'orderno',
        'description',
        'resultCode',
        'resultMsg',
        'tid',
        'payType',
        'authDate',
        'authNum',
        'price',
        'userName',
        'cardCode1',
        'cardCode2',
        'cardCompName',
        'cardNum',
        'cardPrtc',
        'cardCorpFlag',
        'cardCheckFlag',
        'extraData',
        'method_token',
        'cancelResultCode',
        'cancelResultMsg',
        'cancelDate',
        'cancelTime',
        'cancelNum',
        'prtcResultCode',
        'prtcResultMsg',
        'prtcTid',
        'prtcPrice',
        'prtcRemains',
        'prtcCnt',
        'prtcType',
        'prtcDate',
        'prtcTime'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'price' => 'string',
        'description' => 'string',
        'user_id' => 'integer',
        'orderno' => 'string',
        'method_token' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'orderno' => 'required',
        'user_id' => 'required|exists:users,id',
    ];

    /**
     * New Attributes
     *
     * @var array
     */
    /*
    protected $appends = [
        'custom_fields',
        
    ];

    public function customFieldsValues()
    {
        return $this->morphMany('App\Models\CustomFieldValue', 'customizable');
    }

    public function getCustomFieldsAttribute()
    {
        $hasCustomField = in_array(static::class,setting('custom_field_models',[]));
        if (!$hasCustomField){
            return [];
        }
        $array = $this->customFieldsValues()
            ->join('custom_fields','custom_fields.id','=','custom_field_values.custom_field_id')
            ->where('custom_fields.in_table','=',true)
            ->get()->toArray();

        return convertToAssoc($array,'name');
    }
    */

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id', 'id');
    }
    
}
