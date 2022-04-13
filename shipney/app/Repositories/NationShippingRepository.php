<?php

namespace App\Repositories;

use App\Models\NationShipping;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class NationShippingRepository
 * @package App\Repositories
 * @version September 4, 2019, 10:30 am UTC
 *
 * @method Notice findWithoutFail($id, $columns = ['*'])
 * @method Notice find($id, $columns = ['*'])
 * @method Notice first($columns = ['*'])
 */
class NationShippingRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'departure',
        'destination',
        'shipping_duration',
        'delivery_duration',
        'active',
        'updated_at',
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return NationShipping::class;
    }
}
