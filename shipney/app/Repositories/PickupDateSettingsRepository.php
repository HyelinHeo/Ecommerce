<?php

namespace App\Repositories;

use App\Models\PickupDateSettings;
use InfyOm\Generator\Common\BaseRepository;
use Prettus\Repository\Contracts\CacheableInterface;
use Prettus\Repository\Traits\CacheableRepository;

/**
 * Class PickupDateSettingsRepository
 * @package App\Repositories
 * @version August 29, 2019, 9:38 pm UTC
 *
 * @method Market findWithoutFail($id, $columns = ['*'])
 * @method Market find($id, $columns = ['*'])
 * @method Market first($columns = ['*'])
 */
class PickupDateSettingsRepository extends BaseRepository implements CacheableInterface
{

    use CacheableRepository;
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nation',
        'active',
        'updated_at',
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PickupDateSettings::class;
    }
}
