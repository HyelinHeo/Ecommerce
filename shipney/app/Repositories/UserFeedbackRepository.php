<?php

namespace App\Repositories;

use App\Models\UserFeedback;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserFeedbackRepository
 * @package App\Repositories
 * @version September 4, 2019, 10:30 am UTC
 *
 * @method UserFeedback findWithoutFail($id, $columns = ['*'])
 * @method UserFeedback find($id, $columns = ['*'])
 * @method UserFeedback first($columns = ['*'])
 */
class UserFeedbackRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'type',
        'user_id',
        'done',
        'comment',
        'updated_at',
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserFeedback::class;
    }
}
