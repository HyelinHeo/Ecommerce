<?php

namespace App\Repositories;

use App\Models\Order;
use InfyOm\Generator\Common\BaseRepository;

if (!defined('SPN_STATE_NONE')) define('SPN_STATE_NONE', -1);
if (!defined('SPN_STATE_REG_DONE')) define('SPN_STATE_REG_DONE', 0);
if (!defined('SPN_STATE_PICKUP_REG_DONE')) define('SPN_STATE_PICKUP_REG_DONE', 1);
if (!defined('SPN_STATE_PICKUP_DONE')) define('SPN_STATE_PICKUP_DONE', 2);
if (!defined('SPN_STATE_PICKUP_DELIVERY')) define('SPN_STATE_PICKUP_DELIVERY', 3);
if (!defined('SPN_STATE_WAREHOUSE_WAIT')) define('SPN_STATE_WAREHOUSE_WAIT', 4);
if (!defined('SPN_STATE_WAREHOUSE_USER_CONFIRM')) define('SPN_STATE_WAREHOUSE_USER_CONFIRM', 5);
if (!defined('SPN_STATE_WAREHOUSE_IN')) define('SPN_STATE_WAREHOUSE_IN', 6);
if (!defined('SPN_STATE_WAREHOUSE_OUT')) define('SPN_STATE_WAREHOUSE_OUT', 7);
if (!defined('SPN_STATE_SHIPPING_DEPATURE')) define('SPN_STATE_SHIPPING_DEPATURE', 8);
if (!defined('SPN_STATE_SHIPPING_ARRIVAL')) define('SPN_STATE_SHIPPING_ARRIVAL', 9);
if (!defined('SPN_STATE_SHIPPING_CUSTOMS')) define('SPN_STATE_SHIPPING_CUSTOMS', 10);
if (!defined('SPN_STATE_SHIPPING_CUSTOMS_CLEAR')) define('SPN_STATE_SHIPPING_CUSTOMS_CLEAR', 11);
if (!defined('SPN_STATE_SHIPPING_DELIVERY_START')) define('SPN_STATE_SHIPPING_DELIVERY_START', 12);
if (!defined('SPN_STATE_SHIPPING_DELIVERY')) define('SPN_STATE_SHIPPING_DELIVERY', 13);
if (!defined('SPN_STATE_SHIPPING_DELIVERY_DONE')) define('SPN_STATE_SHIPPING_DELIVERY_DONE', 14);
if (!defined('SPN_STATE_RETURN_REQUEST')) define('SPN_STATE_RETURN_REQUEST', 15);
if (!defined('SPN_STATE_RETURN')) define('SPN_STATE_RETURN', 16);
if (!defined('SPN_STATE_RETURN_DONE')) define('SPN_STATE_RETURN_DONE', 17);
if (!defined('SPN_STATE_CANCEL')) define('SPN_STATE_CANCEL', 18);
//if (!defined('SPN_STATE_ERROR')) define('SPN_STATE_ERROR', 20); // error state 삭제

if (!defined('SPN_ACCIDENT_CANCLE_BY_PICKUP')) define('SPN_ACCIDENT_CANCLE_BY_PICKUP', 1);  // 픽업시스템에서 강제로 취소처리
if (!defined('SPN_ACCIDENT_PICKUP_ORDERNO')) define('SPN_ACCIDENT_PICKUP_ORDERNO', 2);  // 픽업 주문번호를 찾을 수 없음.
if (!defined('SPN_ACCIDENT_SHIPPING_ORDERNO')) define('SPN_ACCIDENT_SHIPPING_ORDERNO', 2);  // 배송 주문번호가 없음.

if (!defined('SPN_CANCEL_BY_USER')) define('SPN_CANCEL_BY_USER', 1);  // 사용자 요청 취소
if (!defined('SPN_CANCEL_BY_PICKUP')) define('SPN_CANCEL_BY_PICKUP', 2);  // 픽업서비스에서 취소(주소, 사용자 변심, 부재등).
if (!defined('SPN_CANCEL_BY_SYSTEM')) define('SPN_CANCEL_BY_SYSTEM', 3);  // 이외 이유로 취소

/**
 * Class OrderRepository
 * @package App\Repositories
 * @version August 31, 2019, 11:11 am UTC
 *
 * @method Order findWithoutFail($id, $columns = ['*'])
 * @method Order find($id, $columns = ['*'])
 * @method Order first($columns = ['*'])
*/
class OrderRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'order_status_id',
        'hint',
        'payment_id',
        'order_status_updated_at',
        'active',
        'created_at',
        'updated_at'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Order::class;
    }

    public function updateOrderAccident($id, $accCode_original, $accDesc_original, $accCode_new) 
    {
        try {
            if($accCode_original == null) {
                $accCode_original = "";
            }

            if($accDesc_original == null) {
                $accDesc_original = "";
            }

            if (strcmp($accCode_original, "/".$accCode_new) !== 0) {
                $input['accident_code'] = $accCode_original."/".$accCode_new;
                $input['accident_desc'] = $accDesc_original."/".(String)date("Y-m-d H:i:s");
            
                $order = $this->update($input, $id);
            }
        } catch (ValidatorException $e) {
            Flash::error($e->getMessage());
        }        
    }

    public function updateOrderCancel($id, $cancelType, $cancelCode_original, $cancelDesc_original, $cancelCode_new, $userAlert) 
    {
        if($cancelCode_new != null && strlen($cancelCode_new) > 0) {
            try {
                if($cancelDesc_original == null) {
                    $cancelDesc_original = "";
                }

                if($cancelType == "all") {
                    $input['order_status_id'] = SPN_STATE_CANCEL;
                } else {
                    $input['order_status_id'] = SPN_STATE_RETURN_REQUEST;
                }

                $input['cancel_code'] = $cancelCode_original."/".$cancelCode_new;
                $input['cancel_desc'] = $cancelDesc_original."/".(String)date("Y-m-d H:i:s");
                $input['user_alert'] = $userAlert;

                $order = $this->update($input, $id);
                return $order;

            } catch (ValidatorException $e) {
                Flash::error($e->getMessage());
            }        
        }

        return null;
    }
}
