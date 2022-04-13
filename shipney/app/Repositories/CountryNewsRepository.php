<?php

namespace App\Repositories;

use App\Models\CountryNews;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CountryNewsRepository
 * @package App\Repositories
 * @version September 4, 2019, 10:30 am UTC
 *
 * @method Notice findWithoutFail($id, $columns = ['*'])
 * @method Notice find($id, $columns = ['*'])
 * @method Notice first($columns = ['*'])
 */
class CountryNewsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nation',
        'language',
        'title',
        'active',
        'created_at',
        'updated_at'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CountryNews::class;
    }
}
