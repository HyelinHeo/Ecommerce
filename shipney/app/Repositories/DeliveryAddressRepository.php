<?php

namespace App\Repositories;

use App\Models\DeliveryAddress;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class DeliveryAddressRepository
 * @package App\Repositories
 * @version December 6, 2019, 1:57 pm UTC
 *
 * @method DeliveryAddress findWithoutFail($id, $columns = ['*'])
 * @method DeliveryAddress find($id, $columns = ['*'])
 * @method DeliveryAddress first($columns = ['*'])
*/
class DeliveryAddressRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id',
        'orderno',
        'pickup_mode',
        'pickup_request',
        'pickup_nation_code',
        'pickup_post_num',
        'pickup_address_01',
        'pickup_address_02',
        'pickup_reserve',
        'pickup_type',
        'pickup_jeju',
        'pickup_island',
        'boxtype',
        'pickup_fee',
        'pickup_base_fee',
        'pickup_add_fee',
        'boxtype_real',
        'pickup_fee_real',
        'pickup_base_fee_real',
        'pickup_add_fee_real',
        'pickup_currency',
        'pickupOrderNo',
        'pickupStatus',
        'approvalDt',
        'assignDt',
        'pickUpDt',
        'warehousingDt',
        'gatheredDt',
        'cancelRequestDt',
        'cancelDt',
        'invoiceNumber',
        'deliveryCode',
        'deliveryStatus',
        'shipRegisterDt',
        'shipStartingDt',
        'shipCompleteDt',
        'pickerName',
        'pickerMobile',
        'pickerPictureURI',
        'orderMemo',
        'cancelRequestCode',
        'cancelReason',
        'errorCode',
        'errorMessage',
        'active',
        'created_at',
        'updated_at'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return DeliveryAddress::class;
    }
}
