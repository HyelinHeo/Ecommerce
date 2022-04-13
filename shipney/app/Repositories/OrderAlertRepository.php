<?php

namespace App\Repositories;

use App\Models\OrderAlert;
use InfyOm\Generator\Common\BaseRepository;

if (!defined('ALERT_TYPE_NONE')) define('ALERT_TYPE_NONE', 0);
if (!defined('ALERT_TYPE_OVER_WEIGHT')) define('ALERT_TYPE_OVER_WEIGHT', 1);
if (!defined('ALERT_TYPE_OVER_MAX_WEIGHT')) define('ALERT_TYPE_OVER_MAX_WEIGHT', 2);
if (!defined('ALERT_TYPE_ITEM')) define('ALERT_TYPE_ITEM', 3);
if (!defined('ALERT_TYPE_PACKING')) define('ALERT_TYPE_PACKING', 4);
if (!defined('ALERT_TYPE_PICKUP')) define('ALERT_TYPE_PICKUP', 5);
if (!defined('ALERT_TYPE_CUSTOMS')) define('ALERT_TYPE_CUSTOMS', 6);
if (!defined('ALERT_TYPE_DELIVERY')) define('ALERT_TYPE_DELIVERY', 7);
if (!defined('ALERT_TYPE_ETC')) define('ALERT_TYPE_ETC', 8);

if (!defined('ALERT_ACTION_NONE')) define('ALERT_ACTION_NONE', 0);
if (!defined('ALERT_ACTION_PAY_MORE')) define('ALERT_ACTION_PAY_MORE', 1);
if (!defined('ALERT_ACTION_AUTO_CANCEL')) define('ALERT_ACTION_AUTO_CANCEL', 2);
if (!defined('ALERT_ACTION_REBOOK_PICKUP')) define('ALERT_ACTION_REBOOK_PICKUP', 3);
if (!defined('ALERT_ACTION_CANCEL_REORDER')) define('ALERT_ACTION_CANCEL_REORDER', 4);
if (!defined('ALERT_ACTION_CONTACT_US')) define('ALERT_ACTION_CONTACT_US', 5);

if (!defined('ALERT_RESULT_NONE')) define('ALERT_RESULT_NONE', 0);
if (!defined('ALERT_RESULT_PAYED')) define('ALERT_RESULT_PAYED', 1);
if (!defined('ALERT_RESULT_CANCEL')) define('ALERT_RESULT_CANCEL', 2);
if (!defined('ALERT_RESULT_REBOOK_PICKUP')) define('ALERT_RESULT_REBOOK_PICKUP', 3);
if (!defined('ALERT_RESULT_ELSE')) define('ALERT_RESULT_ELSE', 4);

/**
 * Class OrderAlertRepository
 * @package App\Repositories
 * @version September 4, 2019, 10:30 am UTC
 *
 * @method Notice findWithoutFail($id, $columns = ['*'])
 * @method Notice find($id, $columns = ['*'])
 * @method Notice first($columns = ['*'])
 */
class OrderAlertRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id',
        'type',
        'orderno',
        'occure_date',
        'limit_date',
        'need_action',
        'result',
        'active',
        'updated_at'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return OrderAlert::class;
    }
}
