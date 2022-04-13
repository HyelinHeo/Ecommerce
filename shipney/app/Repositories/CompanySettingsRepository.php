<?php

namespace App\Repositories;

use App\Models\CompanySettings;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CompanySettingsRepository
 * @package App\Repositories
 * @version September 4, 2019, 10:30 am UTC
 *
 */
class CompanySettingsRepository extends BaseRepository
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
        return CompanySettings::class;
    }
}
