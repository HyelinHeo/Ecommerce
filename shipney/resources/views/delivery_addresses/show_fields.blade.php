<!-- Id Field -->
<div class="form-group row col-6">
  {!! Form::label('id', 'Id:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $deliveryAddress->id !!}</p>
  </div>
</div>

<!-- orderno Field -->
<div class="form-group row col-6">
  {!! Form::label('orderno', trans('lang.delivery_address_orderno'), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $deliveryAddress->orderno !!}</p>
  </div>
</div>

<!-- pickup_mode Field -->
<div class="form-group row col-6">
  {!! Form::label('pickup_mode', trans('lang.delivery_address_pickup_mode'), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $deliveryAddress->pickup_mode !!}</p>
  </div>
</div>

<!-- pickup_request Field -->
<div class="form-group row col-6">
  {!! Form::label('pickup_request', trans('lang.delivery_address_pickup_request'), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $deliveryAddress->pickup_request !!}</p>
  </div>
</div>

<!-- pickup_nation_code Field -->
<div class="form-group row col-6">
  {!! Form::label('pickup_nation_code', trans('lang.delivery_address_pickup_nation_code'), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $deliveryAddress->pickup_nation_code !!}</p>
  </div>
</div>

<!-- pickup_post_num Field -->
<div class="form-group row col-6">
  {!! Form::label('pickup_post_num', trans('lang.delivery_address_pickup_post_num'), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $deliveryAddress->pickup_post_num !!}</p>
  </div>
</div>

<!-- pickup_address_01 Field -->
<div class="form-group row col-6">
  {!! Form::label('pickup_address_01', trans('lang.delivery_address_pickup_address_01'), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $deliveryAddress->pickup_address_01 !!}</p>
  </div>
</div>

<!-- pickup_address_02 Field -->
<div class="form-group row col-6">
  {!! Form::label('pickup_address_02', trans('lang.delivery_address_pickup_address_02'), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $deliveryAddress->pickup_address_02 !!}</p>
  </div>
</div>

<!-- pickup_reserve Field -->
<div class="form-group row col-6">
  {!! Form::label('pickup_reserve', trans('lang.delivery_address_pickup_reserve'), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $deliveryAddress->pickup_reserve !!}</p>
  </div>
</div>

<!-- pickup_type Field -->
<div class="form-group row col-6">
  {!! Form::label('pickup_type', trans('lang.delivery_address_pickup_type'), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $deliveryAddress->pickup_type !!}</p>
  </div>
</div>

<!-- pickup_jeju Field -->
<div class="form-group row col-6">
  {!! Form::label('pickup_jeju', trans('lang.delivery_address_pickup_jeju'), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $deliveryAddress->pickup_jeju !!}</p>
  </div>
</div>

<!-- pickup_island Field -->
<div class="form-group row col-6">
  {!! Form::label('pickup_island', trans('lang.delivery_address_pickup_island'), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $deliveryAddress->pickup_island !!}</p>
  </div>
</div>

<!-- boxtype Field -->
<div class="form-group row col-6">
  {!! Form::label('boxtype', trans('lang.delivery_address_boxtype'), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $deliveryAddress->boxtype !!}</p>
  </div>
</div>

<!-- pickup_fee Field -->
<div class="form-group row col-6">
  {!! Form::label('pickup_fee', trans('lang.delivery_address_pickup_fee'), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $deliveryAddress->pickup_fee !!}</p>
  </div>
</div>

<!-- pickup_base_fee Field -->
<div class="form-group row col-6">
  {!! Form::label('pickup_base_fee', trans('lang.delivery_address_pickup_base_fee'), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $deliveryAddress->pickup_base_fee !!}</p>
  </div>
</div>

<!-- pickup_add_fee Field -->
<div class="form-group row col-6">
  {!! Form::label('pickup_add_fee', trans('lang.delivery_address_pickup_add_fee'), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $deliveryAddress->pickup_add_fee !!}</p>
  </div>
</div>

<!-- boxtype_real Field -->
<div class="form-group row col-6">
  {!! Form::label('boxtype_real', trans('lang.delivery_address_boxtype_real'), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $deliveryAddress->boxtype_real !!}</p>
  </div>
</div>

<!-- pickup_fee_real Field -->
<div class="form-group row col-6">
  {!! Form::label('pickup_fee_real', trans('lang.delivery_address_pickup_fee_real'), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $deliveryAddress->pickup_fee_real !!}</p>
  </div>
</div>

<!-- pickup_base_fee_real Field -->
<div class="form-group row col-6">
  {!! Form::label('pickup_base_fee_real', trans('lang.delivery_address_pickup_base_fee_real'), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $deliveryAddress->pickup_base_fee_real !!}</p>
  </div>
</div>

<!-- pickup_add_fee_real Field -->
<div class="form-group row col-6">
  {!! Form::label('pickup_add_fee_real', trans('lang.delivery_address_pickup_add_fee_real'), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $deliveryAddress->pickup_add_fee_real !!}</p>
  </div>
</div>

<!-- pickup_currency Field -->
<div class="form-group row col-6">
  {!! Form::label('pickup_currency', trans('lang.delivery_address_pickup_currency'), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $deliveryAddress->pickup_currency !!}</p>
  </div>
</div>

<!-- pickupOrderNo Field -->
<div class="form-group row col-6">
  {!! Form::label('pickupOrderNo', trans('lang.delivery_address_pickupOrderNo'), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $deliveryAddress->pickupOrderNo !!}</p>
  </div>
</div>

<!-- pickupStatus Field -->
<div class="form-group row col-6">
  {!! Form::label('pickupStatus', trans('lang.delivery_address_pickupStatus'), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $deliveryAddress->pickupStatus !!}</p>
  </div>
</div>

<!-- approvalDt Field -->
<div class="form-group row col-6">
  {!! Form::label('approvalDt', trans('lang.delivery_address_approvalDt'), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $deliveryAddress->approvalDt !!}</p>
  </div>
</div>

<!-- assignDt Field -->
<div class="form-group row col-6">
  {!! Form::label('assignDt', trans('lang.delivery_address_assignDt'), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $deliveryAddress->assignDt !!}</p>
  </div>
</div>

<!-- pickUpDt Field -->
<div class="form-group row col-6">
  {!! Form::label('pickUpDt', trans('lang.delivery_address_pickUpDt'), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $deliveryAddress->pickUpDt !!}</p>
  </div>
</div>

<!-- warehousingDt Field -->
<div class="form-group row col-6">
  {!! Form::label('warehousingDt', trans('lang.delivery_address_warehousingDt'), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $deliveryAddress->warehousingDt !!}</p>
  </div>
</div>

<!-- gatheredDt Field -->
<div class="form-group row col-6">
  {!! Form::label('gatheredDt', trans('lang.delivery_address_gatheredDt'), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $deliveryAddress->gatheredDt !!}</p>
  </div>
</div>

<!-- cancelRequestDt Field -->
<div class="form-group row col-6">
  {!! Form::label('cancelRequestDt', trans('lang.delivery_address_cancelRequestDt'), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $deliveryAddress->cancelRequestDt !!}</p>
  </div>
</div>

<!-- cancelDt Field -->
<div class="form-group row col-6">
  {!! Form::label('cancelDt', trans('lang.delivery_address_cancelDt'), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $deliveryAddress->cancelDt !!}</p>
  </div>
</div>

<!-- invoiceNumber Field -->
<div class="form-group row col-6">
  {!! Form::label('invoiceNumber', trans('lang.delivery_address_invoiceNumber'), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $deliveryAddress->invoiceNumber !!}</p>
  </div>
</div>

<!-- deliveryCode Field -->
<div class="form-group row col-6">
  {!! Form::label('deliveryCode', trans('lang.delivery_address_deliveryCode'), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $deliveryAddress->deliveryCode !!}</p>
  </div>
</div>

<!-- deliveryStatus Field -->
<div class="form-group row col-6">
  {!! Form::label('deliveryStatus', trans('lang.delivery_address_deliveryStatus'), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $deliveryAddress->deliveryStatus !!}</p>
  </div>
</div>

<!-- shipRegisterDt Field -->
<div class="form-group row col-6">
  {!! Form::label('shipRegisterDt', trans('lang.delivery_address_shipRegisterDt'), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $deliveryAddress->shipRegisterDt !!}</p>
  </div>
</div>

<!-- shipStartingDt Field -->
<div class="form-group row col-6">
  {!! Form::label('shipStartingDt', trans('lang.delivery_address_shipStartingDt'), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $deliveryAddress->shipStartingDt !!}</p>
  </div>
</div>

<!-- shipCompleteDt Field -->
<div class="form-group row col-6">
  {!! Form::label('shipCompleteDt', trans('lang.delivery_address_shipCompleteDt'), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $deliveryAddress->shipCompleteDt !!}</p>
  </div>
</div>

<!-- pickerName Field -->
<div class="form-group row col-6">
  {!! Form::label('pickerName', trans('lang.delivery_address_pickerName'), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $deliveryAddress->pickerName !!}</p>
  </div>
</div>

<!-- pickerMobile Field -->
<div class="form-group row col-6">
  {!! Form::label('pickerMobile', trans('lang.delivery_address_pickerMobile'), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $deliveryAddress->pickerMobile !!}</p>
  </div>
</div>

<!-- pickerPictureURI Field -->
<div class="form-group row col-6">
  {!! Form::label('pickerPictureURI', trans('lang.delivery_address_pickerPictureURI'), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $deliveryAddress->pickerPictureURI !!}</p>
  </div>
</div>

<!-- orderMemo Field -->
<div class="form-group row col-6">
  {!! Form::label('orderMemo', trans('lang.delivery_address_orderMemo'), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $deliveryAddress->orderMemo !!}</p>
  </div>
</div>

<!-- cancelRequestCode Field -->
<div class="form-group row col-6">
  {!! Form::label('cancelRequestCode', trans('lang.delivery_address_cancelRequestCode'), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $deliveryAddress->cancelRequestCode !!}</p>
  </div>
</div>

<!-- cancelReason Field -->
<div class="form-group row col-6">
  {!! Form::label('cancelReason', trans('lang.delivery_address_cancelReason'), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $deliveryAddress->cancelReason !!}</p>
  </div>
</div>

<!-- errorCode Field -->
<div class="form-group row col-6">
  {!! Form::label('errorCode', trans('lang.delivery_address_errorCode'), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $deliveryAddress->errorCode !!}</p>
  </div>
</div>

<!-- errorMessage Field -->
<div class="form-group row col-6">
  {!! Form::label('errorMessage', trans('lang.delivery_address_errorMessage'), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $deliveryAddress->errorMessage !!}</p>
  </div>
</div>

<!-- created_at Field -->
<div class="form-group row col-6">
  {!! Form::label('created_at', trans('lang.delivery_address_created_at'), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $deliveryAddress->created_at !!}</p>
  </div>
</div>

<!-- updated_at Field -->
<div class="form-group row col-6">
  {!! Form::label('updated_at', trans('lang.delivery_address_updated_at'), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $deliveryAddress->updated_at !!}</p>
  </div>
</div>

