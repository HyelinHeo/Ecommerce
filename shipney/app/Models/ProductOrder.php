<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class ProductOrder
 * @package App\Models
 * @version August 31, 2019, 11:18 am UTC
 *
 * @property \App\Models\Product product
 * @property \App\Models\Option[] options
 * @property \App\Models\Order order
 * @property double price
 * @property integer quantity
 * @property integer product_id
 * @property integer order_id
 */
class ProductOrder extends Model
{

    public $table = 'products';
    


    public $fillable = [
        'id',
        'name',
        'price',
        'orderno',
        'category_code',
        'goodsname',
        'goodsname_eng',
        'count'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'price' => 'double'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'price' => 'required',
        'orderno' => 'required|exists:orders,orderno'
    ];

    /**
     * New Attributes
     *
     * @var array
     */
    protected $appends = [
        'custom_fields',
//        'options'
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function order()
    {
        return $this->belongsTo(\App\Models\Order::class, 'orderno', 'orderno');
    }
//        /**
//    * @return \Illuminate\Database\Eloquent\Collection
//    */
//    public function getOptionsAttribute()
//    {
//        return $this->options()->get(['options.id', 'options.name']);
//    }
}
