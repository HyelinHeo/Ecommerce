<?php

namespace App\Repositories;

use App\Models\Media;
use App\Models\Tracking;
use Illuminate\Support\Facades\Log;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class TrackingRepository
 * @package App\Repositories
 * @version June 12, 2018, 11:30 am UTC
 *
 * @method Upload findWithoutFail($id, $columns = ['*'])
 * @method Upload find($id, $columns = ['*'])
 * @method Upload first($columns = ['*'])
 */
class TrackingRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'orderno',
        'updated_at',
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Tracking::class;
    }
}
