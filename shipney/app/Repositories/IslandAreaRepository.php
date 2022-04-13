<?php

namespace App\Repositories;

use App\Models\IslandArea;
use InfyOm\Generator\Common\BaseRepository;
use Prettus\Repository\Contracts\CacheableInterface;
use Prettus\Repository\Traits\CacheableRepository;

/**
 * Class IslandAreaRepository
 * @package App\Repositories
 * @version August 29, 2019, 9:38 pm UTC
 *
 * @method Market findWithoutFail($id, $columns = ['*'])
 * @method Market find($id, $columns = ['*'])
 * @method Market first($columns = ['*'])
 */
class IslandAreaRepository extends BaseRepository implements CacheableInterface
{

    use CacheableRepository;
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nation',
        'name',
        'start_code',
        'end_code',
        'jeju',
        'island',
        'created_at',
        'updated_at',
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return IslandArea::class;
    }
}
