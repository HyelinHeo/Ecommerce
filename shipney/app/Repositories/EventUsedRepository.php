<?php

namespace App\Repositories;

use App\Models\EventUsed;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class EventRepository
 * @package App\Repositories
 * @version April 11, 2020, 1:57 pm UTC
 *
 * @method Event findWithoutFail($id, $columns = ['*'])
 * @method Event find($id, $columns = ['*'])
 * @method Event first($columns = ['*'])
*/
class EventUsedRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'orderno',
        'event_id',
        'canceled'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return EventUsed::class;
    }
}
