<?php

namespace App\Repositories;

use App\Models\Notice;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class NotificationRepository
 * @package App\Repositories
 * @version September 4, 2019, 10:30 am UTC
 *
 * @method Notice findWithoutFail($id, $columns = ['*'])
 * @method Notice find($id, $columns = ['*'])
 * @method Notice first($columns = ['*'])
 */
class NoticeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id',
        'nation',
        'language',
        'title',
        'active',
        'disptop',
        'disptop_order',
        'dispHomeMode',
        'updated_at',
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Notice::class;
    }
}
