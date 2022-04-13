<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class IslandArea
 * @package App\Models
 * @version August 29, 2019, 9:39 pm UTC
 *
 * @property \App\Models\IslandArea IslandArea
 */
class IslandArea extends Model
{

    public $table = 'island_area';
    
    public $fillable = [
        'nation',
        'name',
        'start_code',
        'end_code',
        'jeju',
        'island',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'nation' => 'string',
        'name' => 'string',
        'start_code' => 'integer',
        'end_code' => 'integer',
        'jeju' => "string",
        'island' => "string",
        'active' => "boolean"
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nation' => 'required',
        'name' => 'required',
        'start_code' => 'required',
        'end_code' => 'required'
    ];
   
}
