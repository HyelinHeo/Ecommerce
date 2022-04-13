<?php

namespace App\Repositories;

use App\Models\NationInfo;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class NationInfoRepository
 * @package App\Repositories
 * @version September 4, 2019, 10:30 am UTC
 *
 * @method Notice findWithoutFail($id, $columns = ['*'])
 * @method Notice find($id, $columns = ['*'])
 * @method Notice first($columns = ['*'])
 */
class NationInfoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nation',
        'language',
        'active',
        'updated_at',
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return NationInfo::class;
    }
}
