@if($customFields)
<h5 class="col-12 pb-4">{!! trans('lang.main_fields') !!}</h5>
@endif
<div style="flex: 50%;max-width: 50%;padding: 0 4px;" class="column">
<!-- ID Field -->
<div class="form-group row ">
  {!! Form::label('id', trans("lang.delivery_address_id"), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    {!! Form::text('id', null,  ['class' => 'form-control','placeholder'=>  trans("lang.delivery_address_id_placeholder")]) !!}
    <div class="form-text text-muted">
      {{ trans("lang.delivery_address_id_help") }}
    </div>
  </div>
</div>

<!-- Order No Field -->
<div class="form-group row ">
  {!! Form::label('orderno', trans("lang.delivery_address_orderno"), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    {!! Form::text('orderno', null,  ['class' => 'form-control','placeholder'=>  trans("lang.delivery_address_orderno_placeholder")]) !!}
    <div class="form-text text-muted">
      {{ trans("lang.delivery_address_orderno_help") }}
    </div>
  </div>
</div>

<!-- pickup_mode Field -->
<div class="form-group row ">
  {!! Form::label('pickup_mode', trans("lang.delivery_address_pickup_mode"), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    {!! Form::text('pickup_mode', null,  ['class' => 'form-control','placeholder'=>  trans("lang.delivery_address_pickup_mode_placeholder")]) !!}
    <div class="form-text text-muted">
      {{ trans("lang.delivery_address_pickup_mode_help") }}
    </div>
  </div>
</div>

<!-- pickup_request Field -->
<div class="form-group row ">
  {!! Form::label('pickup_request', trans("lang.delivery_address_pickup_request"), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    {!! Form::text('pickup_request', null,  ['class' => 'form-control','placeholder'=>  trans("lang.delivery_address_pickup_request_placeholder")]) !!}
    <div class="form-text text-muted">
      {{ trans("lang.delivery_address_pickup_request_help") }}
    </div>
  </div>
</div>

<!-- pickup_nation_code Field -->
<div class="form-group row ">
  {!! Form::label('pickup_nation_code', trans("lang.delivery_address_pickup_nation_code"), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    {!! Form::text('pickup_nation_code', null,  ['class' => 'form-control','placeholder'=>  trans("lang.delivery_address_pickup_nation_code_placeholder")]) !!}
    <div class="form-text text-muted">
      {{ trans("lang.delivery_address_pickup_nation_code_help") }}
    </div>
  </div>
</div>

<!-- pickup_post_num Field -->
<div class="form-group row ">
  {!! Form::label('pickup_post_num', trans("lang.delivery_address_pickup_post_num"), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    {!! Form::text('pickup_post_num', null,  ['class' => 'form-control','placeholder'=>  trans("lang.delivery_address_pickup_post_num_placeholder")]) !!}
    <div class="form-text text-muted">
      {{ trans("lang.delivery_address_pickup_post_num_help") }}
    </div>
  </div>
</div>

<!-- pickup_address_01 Field -->
<div class="form-group row ">
  {!! Form::label('pickup_address_01', trans("lang.delivery_address_pickup_address_01"), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    {!! Form::text('pickup_address_01', null,  ['class' => 'form-control','placeholder'=>  trans("lang.delivery_address_pickup_address_01_placeholder")]) !!}
    <div class="form-text text-muted">
      {{ trans("lang.delivery_address_pickup_address_01_help") }}
    </div>
  </div>
</div>

<!-- pickup_address_02 Field -->
<div class="form-group row ">
  {!! Form::label('pickup_address_02', trans("lang.delivery_address_pickup_address_02"), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    {!! Form::text('pickup_address_02', null,  ['class' => 'form-control','placeholder'=>  trans("lang.delivery_address_pickup_address_02_placeholder")]) !!}
    <div class="form-text text-muted">
      {{ trans("lang.delivery_address_pickup_address_02_help") }}
    </div>
  </div>
</div>

<!-- pickup_reserve Field -->
<div class="form-group row ">
  {!! Form::label('pickup_reserve', trans("lang.delivery_address_pickup_reserve"), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    {!! Form::text('pickup_reserve', null,  ['class' => 'form-control','placeholder'=>  trans("lang.delivery_address_pickup_reserve_placeholder")]) !!}
    <div class="form-text text-muted">
      {{ trans("lang.delivery_address_pickup_reserve_help") }}
    </div>
  </div>
</div>

<!-- pickup_type Field -->
<div class="form-group row ">
  {!! Form::label('pickup_type', trans("lang.delivery_address_pickup_type"), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    {!! Form::text('pickup_type', null,  ['class' => 'form-control','placeholder'=>  trans("lang.delivery_address_pickup_type_placeholder")]) !!}
    <div class="form-text text-muted">
      {{ trans("lang.delivery_address_pickup_type_help") }}
    </div>
  </div>
</div>

<!-- pickup_jeju Field -->
<div class="form-group row ">
  {!! Form::label('pickup_jeju', trans("lang.delivery_address_pickup_jeju"), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    {!! Form::text('pickup_jeju', null,  ['class' => 'form-control','placeholder'=>  trans("lang.delivery_address_pickup_jeju_placeholder")]) !!}
    <div class="form-text text-muted">
      {{ trans("lang.delivery_address_pickup_jeju_help") }}
    </div>
  </div>
</div>

<!-- pickup_island Field -->
<div class="form-group row ">
  {!! Form::label('pickup_island', trans("lang.delivery_address_pickup_island"), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    {!! Form::text('pickup_island', null,  ['class' => 'form-control','placeholder'=>  trans("lang.delivery_address_pickup_island_placeholder")]) !!}
    <div class="form-text text-muted">
        {{ trans("lang.delivery_address_pickup_island_help") }}
    </div>
  </div>
</div>

<!-- boxtype Field -->
<div class="form-group row ">
  {!! Form::label('boxtype', trans("lang.delivery_address_boxtype"), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    {!! Form::text('boxtype', null,  ['class' => 'form-control','placeholder'=>  trans("lang.delivery_address_boxtype_placeholder")]) !!}
    <div class="form-text text-muted">
        {{ trans("lang.delivery_address_boxtype_help") }}
    </div>
  </div>
</div>

<!-- pickup_fee Field -->
<div class="form-group row ">
  {!! Form::label('pickup_fee', trans("lang.delivery_address_pickup_fee"), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    {!! Form::text('pickup_fee', null,  ['class' => 'form-control','placeholder'=>  trans("lang.delivery_address_pickup_fee_placeholder")]) !!}
    <div class="form-text text-muted">
        {{ trans("lang.delivery_address_pickup_fee_help") }}
    </div>
  </div>
</div>

<!-- pickup_base_fee Field -->
<div class="form-group row ">
    {!! Form::label('pickup_base_fee', trans("lang.delivery_address_pickup_base_fee"), ['class' => 'col-3 control-label text-right']) !!}
    <div class="col-9">
        {!! Form::text('pickup_base_fee', null,  ['class' => 'form-control','placeholder'=>  trans("lang.delivery_address_pickup_base_fee_placeholder")]) !!}
        <div class="form-text text-muted">
            {{ trans("lang.delivery_address_pickup_base_fee_help") }}
        </div>
    </div>
</div>

<!-- pickup_add_fee Field -->
<div class="form-group row ">
    {!! Form::label('pickup_add_fee', trans("lang.delivery_address_pickup_add_fee"), ['class' => 'col-3 control-label text-right']) !!}
    <div class="col-9">
        {!! Form::text('pickup_add_fee', null,  ['class' => 'form-control','placeholder'=>  trans("lang.delivery_address_pickup_add_fee_placeholder")]) !!}
        <div class="form-text text-muted">
            {{ trans("lang.delivery_address_pickup_add_fee_help") }}
        </div>
    </div>
</div>

<!-- boxtype_real Field -->
<div class="form-group row ">
    {!! Form::label('boxtype_real', trans("lang.delivery_address_boxtype_real"), ['class' => 'col-3 control-label text-right']) !!}
    <div class="col-9">
        {!! Form::text('boxtype_real', null,  ['class' => 'form-control','placeholder'=>  trans("lang.delivery_address_boxtype_real_placeholder")]) !!}
        <div class="form-text text-muted">
            {{ trans("lang.delivery_address_boxtype_real_help") }}
        </div>
    </div>
</div>

<!-- pickup_fee_real Field -->
<div class="form-group row ">
    {!! Form::label('pickup_fee_real', trans("lang.delivery_address_pickup_fee_real"), ['class' => 'col-3 control-label text-right']) !!}
    <div class="col-9">
        {!! Form::text('pickup_fee_real', null,  ['class' => 'form-control','placeholder'=>  trans("lang.delivery_address_pickup_fee_real_placeholder")]) !!}
        <div class="form-text text-muted">
            {{ trans("lang.delivery_address_pickup_fee_real_help") }}
        </div>
    </div>
</div>

<!-- pickup_base_fee_real Field -->
<div class="form-group row ">
    {!! Form::label('pickup_base_fee_real', trans("lang.delivery_address_pickup_base_fee_real"), ['class' => 'col-3 control-label text-right']) !!}
    <div class="col-9">
        {!! Form::text('pickup_base_fee_real', null,  ['class' => 'form-control','placeholder'=>  trans("lang.delivery_address_pickup_base_fee_real_placeholder")]) !!}
        <div class="form-text text-muted">
            {{ trans("lang.delivery_address_pickup_base_fee_real_help") }}
        </div>
    </div>
</div>

<!-- pickup_add_fee_real Field -->
<div class="form-group row ">
    {!! Form::label('pickup_add_fee_real', trans("lang.delivery_address_pickup_add_fee_real"), ['class' => 'col-3 control-label text-right']) !!}
    <div class="col-9">
        {!! Form::text('pickup_add_fee_real', null,  ['class' => 'form-control','placeholder'=>  trans("lang.delivery_address_pickup_add_fee_real_placeholder")]) !!}
        <div class="form-text text-muted">
            {{ trans("lang.delivery_address_pickup_add_fee_real_help") }}
        </div>
    </div>
</div>

<!-- pickup_currency Field -->
<div class="form-group row ">
    {!! Form::label('pickup_currency', trans("lang.delivery_address_pickup_currency"), ['class' => 'col-3 control-label text-right']) !!}
    <div class="col-9">
        {!! Form::text('pickup_currency', null,  ['class' => 'form-control','placeholder'=>  trans("lang.delivery_address_pickup_currency_placeholder")]) !!}
        <div class="form-text text-muted">
            {{ trans("lang.delivery_address_pickup_currency_help") }}
        </div>
    </div>
</div>

<!-- pickupOrderNo Field -->
<div class="form-group row ">
    {!! Form::label('pickupOrderNo', trans("lang.delivery_address_pickupOrderNo"), ['class' => 'col-3 control-label text-right']) !!}
    <div class="col-9">
        {!! Form::text('pickupOrderNo', null,  ['class' => 'form-control','placeholder'=>  trans("lang.delivery_address_pickupOrderNo_placeholder")]) !!}
        <div class="form-text text-muted">
            {{ trans("lang.delivery_address_pickupOrderNo_help") }}
        </div>
    </div>
</div>

</div>
<div style="flex: 50%;max-width: 50%;padding: 0 4px;" class="column">

<!-- pickupStatus Field -->
<div class="form-group row ">
    {!! Form::label('pickupStatus', trans("lang.delivery_address_pickupStatus"), ['class' => 'col-3 control-label text-right']) !!}
    <div class="col-9">
        {!! Form::text('pickupStatus', null,  ['class' => 'form-control','placeholder'=>  trans("lang.delivery_address_pickupStatus_placeholder")]) !!}
        <div class="form-text text-muted">
            {{ trans("lang.delivery_address_pickupStatus_help") }}
        </div>
    </div>
</div>

<!-- approvalDt Field -->
<div class="form-group row ">
    {!! Form::label('approvalDt', trans("lang.delivery_address_approvalDt"), ['class' => 'col-3 control-label text-right']) !!}
    <div class="col-9">
        {!! Form::text('approvalDt', null,  ['class' => 'form-control','placeholder'=>  trans("lang.delivery_address_approvalDt_placeholder")]) !!}
        <div class="form-text text-muted">
            {{ trans("lang.delivery_address_approvalDt_help") }}
        </div>
    </div>
</div>

<!-- pickupDt Field -->
<div class="form-group row ">
    {!! Form::label('pickupDt', trans("lang.delivery_address_pickupDt"), ['class' => 'col-3 control-label text-right']) !!}
    <div class="col-9">
        {!! Form::text('pickupDt', null,  ['class' => 'form-control','placeholder'=>  trans("lang.delivery_address_pickupDt_placeholder")]) !!}
        <div class="form-text text-muted">
            {{ trans("lang.delivery_address_pickupDt_help") }}
        </div>
    </div>
</div>

<!-- warehousingDt Field -->
<div class="form-group row ">
    {!! Form::label('warehousingDt', trans("lang.delivery_address_warehousingDt"), ['class' => 'col-3 control-label text-right']) !!}
    <div class="col-9">
        {!! Form::text('warehousingDt', null,  ['class' => 'form-control','placeholder'=>  trans("lang.delivery_address_warehousingDt_placeholder")]) !!}
        <div class="form-text text-muted">
            {{ trans("lang.delivery_address_warehousingDt_help") }}
        </div>
    </div>
</div>

<!-- gatheredDt Field -->
<div class="form-group row ">
    {!! Form::label('gatheredDt', trans("lang.delivery_address_gatheredDt"), ['class' => 'col-3 control-label text-right']) !!}
    <div class="col-9">
        {!! Form::text('gatheredDt', null,  ['class' => 'form-control','placeholder'=>  trans("lang.delivery_address_gatheredDt_placeholder")]) !!}
        <div class="form-text text-muted">
            {{ trans("lang.delivery_address_gatheredDt_help") }}
        </div>
    </div>
</div>

<!-- cancelReauestDt Field -->
<div class="form-group row ">
    {!! Form::label('cancelReauestDt', trans("lang.delivery_address_cancelReauestDt"), ['class' => 'col-3 control-label text-right']) !!}
    <div class="col-9">
        {!! Form::text('cancelReauestDt', null,  ['class' => 'form-control','placeholder'=>  trans("lang.delivery_address_cancelReauestDt_placeholder")]) !!}
        <div class="form-text text-muted">
            {{ trans("lang.delivery_address_cancelReauestDt_help") }}
        </div>
    </div>
</div>

<!-- cancelDt Field -->
<div class="form-group row ">
    {!! Form::label('cancelDt', trans("lang.delivery_address_cancelDt"), ['class' => 'col-3 control-label text-right']) !!}
    <div class="col-9">
        {!! Form::text('cancelDt', null,  ['class' => 'form-control','placeholder'=>  trans("lang.delivery_address_cancelDt_placeholder")]) !!}
        <div class="form-text text-muted">
            {{ trans("lang.delivery_address_cancelDt_help") }}
        </div>
    </div>
</div>

<!-- invoiceNumber Field -->
<div class="form-group row ">
    {!! Form::label('invoiceNumber', trans("lang.delivery_address_invoiceNumber"), ['class' => 'col-3 control-label text-right']) !!}
    <div class="col-9">
        {!! Form::text('invoiceNumber', null,  ['class' => 'form-control','placeholder'=>  trans("lang.delivery_address_invoiceNumber_placeholder")]) !!}
        <div class="form-text text-muted">
            {{ trans("lang.delivery_address_invoiceNumber_help") }}
        </div>
    </div>
</div>

<!-- deliveryCode Field -->
<div class="form-group row ">
    {!! Form::label('deliveryCode', trans("lang.delivery_address_deliveryCode"), ['class' => 'col-3 control-label text-right']) !!}
    <div class="col-9">
        {!! Form::text('deliveryCode', null,  ['class' => 'form-control','placeholder'=>  trans("lang.delivery_address_deliveryCode_placeholder")]) !!}
        <div class="form-text text-muted">
            {{ trans("lang.delivery_address_deliveryCode_help") }}
        </div>
    </div>
</div>

<!-- deliveryStatus Field -->
<div class="form-group row ">
    {!! Form::label('deliveryStatus', trans("lang.delivery_address_deliveryStatus"), ['class' => 'col-3 control-label text-right']) !!}
    <div class="col-9">
        {!! Form::text('deliveryStatus', null,  ['class' => 'form-control','placeholder'=>  trans("lang.delivery_address_deliveryStatus_placeholder")]) !!}
        <div class="form-text text-muted">
            {{ trans("lang.delivery_address_deliveryStatus_help") }}
        </div>
    </div>
</div>

<!-- shipRegisterDt Field -->
<div class="form-group row ">
    {!! Form::label('shipRegisterDt', trans("lang.delivery_address_shipRegisterDt"), ['class' => 'col-3 control-label text-right']) !!}
    <div class="col-9">
        {!! Form::text('shipRegisterDt', null,  ['class' => 'form-control','placeholder'=>  trans("lang.delivery_address_shipRegisterDt_placeholder")]) !!}
        <div class="form-text text-muted">
            {{ trans("lang.delivery_address_shipRegisterDt_help") }}
        </div>
    </div>
</div>

<!-- shipStartingDt Field -->
<div class="form-group row ">
    {!! Form::label('shipStartingDt', trans("lang.delivery_address_shipStartingDt"), ['class' => 'col-3 control-label text-right']) !!}
    <div class="col-9">
        {!! Form::text('shipStartingDt', null,  ['class' => 'form-control','placeholder'=>  trans("lang.delivery_address_shipStartingDt_placeholder")]) !!}
        <div class="form-text text-muted">
            {{ trans("lang.delivery_address_shipStartingDt_help") }}
        </div>
    </div>
</div>

<!-- shipCompleteDt Field -->
<div class="form-group row ">
    {!! Form::label('shipCompleteDt', trans("lang.delivery_address_shipCompleteDt"), ['class' => 'col-3 control-label text-right']) !!}
    <div class="col-9">
        {!! Form::text('shipCompleteDt', null,  ['class' => 'form-control','placeholder'=>  trans("lang.delivery_address_shipCompleteDt_placeholder")]) !!}
        <div class="form-text text-muted">
            {{ trans("lang.delivery_address_shipCompleteDt_help") }}
        </div>
    </div>
</div>

<!-- pickerName Field -->
<div class="form-group row ">
    {!! Form::label('pickerName', trans("lang.delivery_address_pickerName"), ['class' => 'col-3 control-label text-right']) !!}
    <div class="col-9">
        {!! Form::text('pickerName', null,  ['class' => 'form-control','placeholder'=>  trans("lang.delivery_address_pickerName_placeholder")]) !!}
        <div class="form-text text-muted">
            {{ trans("lang.delivery_address_pickerName_help") }}
        </div>
    </div>
</div>

<!-- pickerMobile Field -->
<div class="form-group row ">
    {!! Form::label('pickerMobile', trans("lang.delivery_address_pickerMobile"), ['class' => 'col-3 control-label text-right']) !!}
    <div class="col-9">
        {!! Form::text('pickerMobile', null,  ['class' => 'form-control','placeholder'=>  trans("lang.delivery_address_pickerMobile_placeholder")]) !!}
        <div class="form-text text-muted">
            {{ trans("lang.delivery_address_pickerMobile_help") }}
        </div>
    </div>
</div>

<!-- pickerPictureURI Field -->
<div class="form-group row ">
    {!! Form::label('pickerPictureURI', trans("lang.delivery_address_pickerPictureURI"), ['class' => 'col-3 control-label text-right']) !!}
    <div class="col-9">
        {!! Form::text('pickerPictureURI', null,  ['class' => 'form-control','placeholder'=>  trans("lang.delivery_address_pickerPictureURI_placeholder")]) !!}
        <div class="form-text text-muted">
            {{ trans("lang.delivery_address_pickerPictureURI_help") }}
        </div>
    </div>
</div>

<!-- orderMemo Field -->
<div class="form-group row ">
    {!! Form::label('orderMemo', trans("lang.delivery_address_orderMemo"), ['class' => 'col-3 control-label text-right']) !!}
    <div class="col-9">
        {!! Form::text('orderMemo', null,  ['class' => 'form-control','placeholder'=>  trans("lang.delivery_address_orderMemo_placeholder")]) !!}
        <div class="form-text text-muted">
            {{ trans("lang.delivery_address_orderMemo_help") }}
        </div>
    </div>
</div>

<!-- cancelRequestCode Field -->
<div class="form-group row ">
    {!! Form::label('cancelRequestCode', trans("lang.delivery_address_cancelRequestCode"), ['class' => 'col-3 control-label text-right']) !!}
    <div class="col-9">
        {!! Form::text('cancelRequestCode', null,  ['class' => 'form-control','placeholder'=>  trans("lang.delivery_address_cancelRequestCode_placeholder")]) !!}
        <div class="form-text text-muted">
            {{ trans("lang.delivery_address_cancelRequestCode_help") }}
        </div>
    </div>
</div>

<!-- cancelReason Field -->
<div class="form-group row ">
    {!! Form::label('cancelReason', trans("lang.delivery_address_cancelReason"), ['class' => 'col-3 control-label text-right']) !!}
    <div class="col-9">
        {!! Form::text('cancelReason', null,  ['class' => 'form-control','placeholder'=>  trans("lang.delivery_address_cancelReason_placeholder")]) !!}
        <div class="form-text text-muted">
            {{ trans("lang.delivery_address_cancelReason_help") }}
        </div>
    </div>
</div>

<!-- errorCode Field -->
<div class="form-group row ">
    {!! Form::label('errorCode', trans("lang.delivery_address_errorCode"), ['class' => 'col-3 control-label text-right']) !!}
    <div class="col-9">
        {!! Form::text('errorCode', null,  ['class' => 'form-control','placeholder'=>  trans("lang.delivery_address_errorCode_placeholder")]) !!}
        <div class="form-text text-muted">
            {{ trans("lang.delivery_address_errorCode_help") }}
        </div>
    </div>
</div>

<!-- errorMessage Field -->
<div class="form-group row ">
    {!! Form::label('errorMessage', trans("lang.delivery_address_errorMessage"), ['class' => 'col-3 control-label text-right']) !!}
    <div class="col-9">
        {!! Form::text('errorMessage', null,  ['class' => 'form-control','placeholder'=>  trans("lang.delivery_address_errorMessage_placeholder")]) !!}
        <div class="form-text text-muted">
            {{ trans("lang.delivery_address_errorMessage_help") }}
        </div>
    </div>
</div>

<!-- 'Boolean Is Default Field' -->
{{--<div class="form-group row ">
  {!! Form::label('is_default', trans("lang.delivery_address_is_default"),['class' => 'col-3 control-label text-right']) !!}
  <div class="checkbox icheck">
    <label class="col-9 ml-2 form-check-inline">
      {!! Form::hidden('is_default', 0) !!}
      {!! Form::checkbox('is_default', 1, null) !!}
    </label>
  </div>
</div>
--}}

</div>
@if($customFields)
<div class="clearfix"></div>
<div class="col-12 custom-field-container">
  <h5 class="col-12 pb-4">{!! trans('lang.custom_field_plural') !!}</h5>
  {!! $customFields !!}
</div>
@endif
<!-- Submit Field -->
<div class="form-group col-12 text-right">
  <button type="submit" class="btn btn-{{setting('theme_color')}}" ><i class="fa fa-save"></i> {{trans('lang.save')}} {{trans('lang.delivery_address')}}</button>
  <a href="{!! route('deliveryAddresses.index') !!}" class="btn btn-default"><i class="fa fa-undo"></i> {{trans('lang.cancel')}}</a>
</div>
