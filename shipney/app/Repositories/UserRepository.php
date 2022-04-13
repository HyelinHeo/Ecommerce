<?php

namespace App\Repositories;

use App\Models\User;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserRepository
 * @package App\Repositories
 * @version July 10, 2018, 11:44 am UTC
 *
 * @method User findWithoutFail($id, $columns = ['*'])
 * @method User find($id, $columns = ['*'])
 * @method User first($columns = ['*'])
*/
class UserRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id',
        'role_id',
        'remember_token',
        'name',
        'reg_type',
        'email',
        'password',
        'device_token',
        'api_token',
        'sns_token',
        'phone',
        'country_code',
        'country_digit',
        'language_code',
        'friend_auto_add',
        'friend_allow_add_me',
        'allow_notify',
        'allow_notify_shipping',
        'allow_notify_event',
        'allow_notify_notice',
        'allow_notify_lockscreen',
        'agree_privacy',
        'agree_terms',
        'agree_mobile',
        'photo',
        'extra_info',
        'created_at',
        'updated_at'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return User::class;
    }
}
