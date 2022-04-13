<?php

namespace App\Repositories;

use App\Models\PickupPriceSettings;
use InfyOm\Generator\Common\BaseRepository;
use Prettus\Repository\Contracts\CacheableInterface;
use Prettus\Repository\Traits\CacheableRepository;

/**
 * Class PickupPriceSettingsRepository
 * @package App\Repositories
 * @version August 29, 2019, 9:38 pm UTC
 *
 * @method Market findWithoutFail($id, $columns = ['*'])
 * @method Market find($id, $columns = ['*'])
 * @method Market first($columns = ['*'])
 */
class PickupPriceSettingsRepository extends BaseRepository implements CacheableInterface
{

    use CacheableRepository;
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'type',
        'nation',
        'active',
        'updated_at',
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PickupPriceSettings::class;
    }
}
