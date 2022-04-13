{{--@if($customFields)
    <h5 class="col-12 pb-4">{!! trans('lang.main_fields') !!}</h5>
@endif--}}
<div style="flex: 50%;max-width: 50%;padding: 0 4px;" class="column">
    <!-- User Name Field -->
    <div class="form-group row ">
        {!! Form::label('user_name', trans("lang.order_user_id"),['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            @if(isset($order))
                {!! Form::text('user_name', $order->user->name, ['class' => 'form-control', 'disabled']) !!}
                {!! Form::hidden('user_id', $order->user->id, ['class' => 'select2 form-control']) !!}
            @else
                {!! Form::select('user_id', $user, null, ['class' => 'select2 form-control']) !!}
            @endif
            <div class="form-text text-muted">{{ trans("lang.order_user_id_help") }}</div>
        </div>
    </div>

    @if(isset($order))
    <!-- User Email Field -->
    <div class="form-group row ">
        {!! Form::label('user_email', trans("lang.order_user_email"),['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
                {!! Form::text('user_email', $order->user->email, ['class' => 'form-control', 'disabled']) !!}
            <div class="form-text text-muted">{{ trans("lang.order_user_email_help") }}</div>
        </div>
    </div>
    @endif

    <!-- hint Field -->
    <div class="form-group row ">
        {!! Form::label('hint', trans("lang.order_hint"),['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
        {!! Form::text('hint', null, ['class' => 'form-control']) !!}
            <div class="form-text text-muted">{{ trans("lang.order_hint_help") }}</div>
        </div>
    </div>

    <!-- accident_code Field -->
    <div class="form-group row ">
        {!! Form::label('accident_code', trans("lang.order_accident_code"),['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
        {!! Form::text('accident_code', null, ['class' => 'form-control']) !!}
            <div class="form-text text-muted">{{ trans("lang.order_accident_code_help") }}</div>
        </div>
    </div>

    <!-- accident_desc Field -->
    <div class="form-group row ">
        {!! Form::label('accident_desc', trans("lang.order_accident_desc"),['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
        {!! Form::text('accident_desc', null, ['class' => 'form-control']) !!}
            <div class="form-text text-muted">{{ trans("lang.order_accident_desc_help") }}</div>
        </div>
    </div>

    <!-- accident_result Field -->
    <div class="form-group row ">
        {!! Form::label('accident_result', trans("lang.order_accident_result"),['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
        {!! Form::text('accident_result', null, ['class' => 'form-control']) !!}
            <div class="form-text text-muted">{{ trans("lang.order_accident_result_help") }}</div>
        </div>
    </div>

    <!-- cancel_code Field -->
    <div class="form-group row ">
        {!! Form::label('cancel_code', trans("lang.order_cancel_code"),['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
        {!! Form::text('cancel_code', null, ['class' => 'form-control']) !!}
            <div class="form-text text-muted">{{ trans("lang.order_cancel_code_help") }}</div>
        </div>
    </div>

    <!-- cancel_desc Field -->
    <div class="form-group row ">
        {!! Form::label('cancel_desc', trans("lang.order_cancel_desc"),['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
        {!! Form::text('cancel_desc', null, ['class' => 'form-control']) !!}
            <div class="form-text text-muted">{{ trans("lang.order_cancel_desc_help") }}</div>
        </div>
    </div>

    <!-- cancel_result Field -->
    <div class="form-group row ">
        {!! Form::label('cancel_result', trans("lang.order_cancel_result"),['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
        {!! Form::text('cancel_result', null, ['class' => 'form-control']) !!}
            <div class="form-text text-muted">{{ trans("lang.order_cancel_result_help") }}</div>
        </div>
    </div>

    <!-- photo1 Field -->
    <div class="form-group row ">
        {!! Form::label('photo1', trans("lang.order_photo1"),['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
        {!! Form::text('photo1', null, ['class' => 'form-control']) !!}
            <div class="form-text text-muted">{{ trans("lang.order_photo1_help") }}</div>
        </div>
    </div>

    <!-- photo1_uuid Field -->
    <div class="form-group row ">
        {!! Form::label('photo1_uuid', trans("lang.order_photo1_uuid"),['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
        {!! Form::text('photo1_uuid', null, ['class' => 'form-control']) !!}
            <div class="form-text text-muted">{{ trans("lang.order_photo1_uuid_help") }}</div>
        </div>
    </div>

    <!-- photo2 Field -->
    <div class="form-group row ">
        {!! Form::label('photo2', trans("lang.order_photo2"),['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
        {!! Form::text('photo2', null, ['class' => 'form-control']) !!}
            <div class="form-text text-muted">{{ trans("lang.order_photo2_help") }}</div>
        </div>
    </div>

    <!-- photo2_uuid Field -->
    <div class="form-group row ">
        {!! Form::label('photo2_uuid', trans("lang.order_photo2_uuid"),['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
        {!! Form::text('photo2_uuid', null, ['class' => 'form-control']) !!}
            <div class="form-text text-muted">{{ trans("lang.order_photo2_uuid_help") }}</div>
        </div>
    </div>

    <!-- photo3 Field -->
    <div class="form-group row ">
        {!! Form::label('photo3', trans("lang.order_photo3"),['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
        {!! Form::text('photo3', null, ['class' => 'form-control']) !!}
            <div class="form-text text-muted">{{ trans("lang.order_photo3_help") }}</div>
        </div>
    </div>

    <!-- photo3_uuid Field -->
    <div class="form-group row ">
        {!! Form::label('photo3_uuid', trans("lang.order_photo3_uuid"),['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
        {!! Form::text('photo3_uuid', null, ['class' => 'form-control']) !!}
            <div class="form-text text-muted">{{ trans("lang.order_photo3_uuid_help") }}</div>
        </div>
    </div>

    <!-- item_count Field -->
    <div class="form-group row ">
        {!! Form::label('item_count', trans("lang.order_item_count"),['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
        {!! Form::text('item_count', null, ['class' => 'form-control']) !!}
            <div class="form-text text-muted">{{ trans("lang.order_item_count_help") }}</div>
        </div>
    </div>

    <!-- item_total_price Field -->
    <div class="form-group row ">
        {!! Form::label('item_total_price', trans("lang.order_item_total_price"),['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
        {!! Form::text('item_total_price', null, ['class' => 'form-control']) !!}
            <div class="form-text text-muted">{{ trans("lang.order_item_total_price_help") }}</div>
        </div>
    </div>

    <!-- item_main_name Field -->
    <div class="form-group row ">
        {!! Form::label('item_main_name', trans("lang.order_item_main_name"),['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
        {!! Form::text('item_main_name', null, ['class' => 'form-control']) !!}
            <div class="form-text text-muted">{{ trans("lang.order_item_main_name_help") }}</div>
        </div>
    </div>

    <!-- item_main_category Field -->
    <div class="form-group row ">
        {!! Form::label('item_main_category', trans("lang.order_item_main_category"),['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
        {!! Form::text('item_main_category', null, ['class' => 'form-control']) !!}
            <div class="form-text text-muted">{{ trans("lang.order_item_main_category_help") }}</div>
        </div>
    </div>

    <!-- weight Field -->
    <div class="form-group row ">
        {!! Form::label('weight', trans("lang.order_weight"),['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
        {!! Form::text('weight', null, ['class' => 'form-control']) !!}
            <div class="form-text text-muted">{{ trans("lang.order_weight_help") }}</div>
        </div>
    </div>

    <!-- weightunit Field -->
    <div class="form-group row ">
        {!! Form::label('weightunit', trans("lang.order_weightunit"),['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
        {!! Form::text('weightunit', null, ['class' => 'form-control']) !!}
            <div class="form-text text-muted">{{ trans("lang.order_weightunit_help") }}</div>
        </div>
    </div>

    <!-- size_width Field -->
    <div class="form-group row ">
        {!! Form::label('size_width', trans("lang.order_size_width"),['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
        {!! Form::text('size_width', null, ['class' => 'form-control']) !!}
            <div class="form-text text-muted">{{ trans("lang.order_size_width_help") }}</div>
        </div>
    </div>

    <!-- size_length Field -->
    <div class="form-group row ">
        {!! Form::label('size_length', trans("lang.order_size_length"),['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
        {!! Form::text('size_length', null, ['class' => 'form-control']) !!}
            <div class="form-text text-muted">{{ trans("lang.order_size_length_help") }}</div>
        </div>
    </div>

    <!-- size_height Field -->
    <div class="form-group row ">
        {!! Form::label('size_height', trans("lang.order_size_height"),['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
        {!! Form::text('size_height', null, ['class' => 'form-control']) !!}
            <div class="form-text text-muted">{{ trans("lang.order_size_height_help") }}</div>
        </div>
    </div>

    <!-- sizeunit Field -->
    <div class="form-group row ">
        {!! Form::label('sizeunit', trans("lang.order_sizeunit"),['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
        {!! Form::text('sizeunit', null, ['class' => 'form-control']) !!}
            <div class="form-text text-muted">{{ trans("lang.order_sizeunit_help") }}</div>
        </div>
    </div>

    <!-- boxtype Field -->
    <div class="form-group row ">
        {!! Form::label('boxtype', trans("lang.order_boxtype"),['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
        {!! Form::text('boxtype', null, ['class' => 'form-control']) !!}
            <div class="form-text text-muted">{{ trans("lang.order_boxtype_help") }}</div>
        </div>
    </div>

    <!-- nation_code Field -->
    <div class="form-group row ">
        {!! Form::label('nation_code', trans("lang.order_nation_code"),['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
        {!! Form::text('nation_code', null, ['class' => 'form-control']) !!}
            <div class="form-text text-muted">{{ trans("lang.order_nation_code_help") }}</div>
        </div>
    </div>

    <!-- post_num Field -->
    <div class="form-group row ">
        {!! Form::label('post_num', trans("lang.order_post_num"),['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
        {!! Form::text('post_num', null, ['class' => 'form-control']) !!}
            <div class="form-text text-muted">{{ trans("lang.order_post_num_help") }}</div>
        </div>
    </div>

    <!-- address1 Field -->
    <div class="form-group row ">
        {!! Form::label('address1', trans("lang.order_address1"),['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
        {!! Form::text('address1', null, ['class' => 'form-control']) !!}
            <div class="form-text text-muted">{{ trans("lang.order_address1_help") }}</div>
        </div>
    </div>

    <!-- address2 Field -->
    <div class="form-group row ">
        {!! Form::label('address2', trans("lang.order_address2"),['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
        {!! Form::text('address2', null, ['class' => 'form-control']) !!}
            <div class="form-text text-muted">{{ trans("lang.order_address2_help") }}</div>
        </div>
    </div>

    <!-- address3 Field -->
    <div class="form-group row ">
        {!! Form::label('address3', trans("lang.order_address3"),['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
        {!! Form::text('address3', null, ['class' => 'form-control']) !!}
            <div class="form-text text-muted">{{ trans("lang.order_address3_help") }}</div>
        </div>
    </div>

    <!-- address4 Field -->
    <div class="form-group row ">
        {!! Form::label('address4', trans("lang.order_address4"),['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
        {!! Form::text('address4', null, ['class' => 'form-control']) !!}
            <div class="form-text text-muted">{{ trans("lang.order_address4_help") }}</div>
        </div>
    </div>

    <!-- Driver Id Field -->
    {{--<div class="form-group row ">
        {!! Form::label('driver_id', trans("lang.order_driver_id"),['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            {!! Form::select('driver_id', $driver, null, ['data-empty'=>trans("lang.order_driver_id_placeholder"),'class' => 'select2 not-required form-control']) !!}
            <div class="form-text text-muted">{{ trans("lang.order_driver_id_help") }}</div>
        </div>
    </div>--}}

    <!-- Status Field -->
    {{--<div class="form-group row ">
        {!! Form::label('status', trans("lang.payment_status"),['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            {!! Form::select('status',
            [
            'Waiting for Client' => trans('lang.order_pending'),
            'Not Paid' => trans('lang.order_not_paid'),
            'Paid' => trans('lang.order_paid'),
            ]
            , isset($order->payment) ? $order->payment->status : '', ['class' => 'select2 form-control']) !!}
            <div class="form-text text-muted">{{ trans("lang.payment_status_help") }}</div>
        </div>
    </div>--}}
</div>
<div style="flex: 50%;max-width: 50%;padding: 0 4px;" class="column">

    <!-- address_photo1 Field -->
    <div class="form-group row ">
        {!! Form::label('address_photo1', trans("lang.order_address_photo1"),['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
        {!! Form::text('address_photo1', null, ['class' => 'form-control']) !!}
            <div class="form-text text-muted">{{ trans("lang.order_address_photo1_help") }}</div>
        </div>
    </div>

    <!-- address_photo1_uuid Field -->
    <div class="form-group row ">
        {!! Form::label('address_photo1_uuid', trans("lang.order_address_photo1_uuid"),['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
        {!! Form::text('address_photo1_uuid', null, ['class' => 'form-control']) !!}
            <div class="form-text text-muted">{{ trans("lang.order_address_photo1_uuid_help") }}</div>
        </div>
    </div>

    <!-- address_photo2 Field -->
    <div class="form-group row ">
        {!! Form::label('address_photo2', trans("lang.order_address_photo2"),['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
        {!! Form::text('address_photo2', null, ['class' => 'form-control']) !!}
            <div class="form-text text-muted">{{ trans("lang.order_address_photo2_help") }}</div>
        </div>
    </div>

    <!-- address_photo2_uuid Field -->
    <div class="form-group row ">
        {!! Form::label('address_photo2_uuid', trans("lang.order_address_photo2_uuid"),['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
        {!! Form::text('address_photo2_uuid', null, ['class' => 'form-control']) !!}
            <div class="form-text text-muted">{{ trans("lang.order_address_photo2_uuid_help") }}</div>
        </div>
    </div>

    <!-- address_trans_done Field -->
    <div class="form-group row ">
        {!! Form::label('address_trans_done', trans("lang.order_address_trans_done"),['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
        {!! Form::text('address_trans_done', null, ['class' => 'form-control']) !!}
            <div class="form-text text-muted">{{ trans("lang.order_address_trans_done_help") }}</div>
        </div>
    </div>

    <!-- Order Status Id Field -->
    <div class="form-group row ">
        {!! Form::label('order_status_id', trans("lang.order_order_status_id"),['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            {!! Form::select('order_status_id', $orderStatus, null, ['class' => 'select2 form-control']) !!}
            <div class="form-text text-muted">{{ trans("lang.order_order_status_id_help") }}</div>
        </div>
    </div>

    <!-- receiver_name Field -->
    <div class="form-group row ">
        {!! Form::label('receiver_name', trans("lang.order_receiver_name"),['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
        {!! Form::text('receiver_name', null, ['class' => 'form-control']) !!}
            <div class="form-text text-muted">{{ trans("lang.order_receiver_name_help") }}</div>
        </div>
    </div>

    <!-- receiver_name_photo1 Field -->
    <div class="form-group row ">
        {!! Form::label('receiver_name_photo1', trans("lang.order_receiver_name_photo1"),['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
        {!! Form::text('receiver_name_photo1', null, ['class' => 'form-control']) !!}
            <div class="form-text text-muted">{{ trans("lang.order_receiver_name_photo1_help") }}</div>
        </div>
    </div>

    <!-- receiver_name_photo1_uuid Field -->
    <div class="form-group row ">
        {!! Form::label('receiver_name_photo1_uuid', trans("lang.order_receiver_name_photo1_uuid"),['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
        {!! Form::text('receiver_name_photo1_uuid', null, ['class' => 'form-control']) !!}
            <div class="form-text text-muted">{{ trans("lang.order_receiver_name_photo1_uuid_help") }}</div>
        </div>
    </div>

    <!-- receiver_name_photo2 Field -->
    <div class="form-group row ">
        {!! Form::label('receiver_name_photo2', trans("lang.order_receiver_name_photo2"),['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
        {!! Form::text('receiver_name_photo2', null, ['class' => 'form-control']) !!}
            <div class="form-text text-muted">{{ trans("lang.order_receiver_name_photo2_help") }}</div>
        </div>
    </div>

    <!-- receiver_name_photo2_uuid Field -->
    <div class="form-group row ">
        {!! Form::label('receiver_name_photo2_uuid', trans("lang.order_receiver_name_photo2_uuid"),['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
        {!! Form::text('receiver_name_photo2_uuid', null, ['class' => 'form-control']) !!}
            <div class="form-text text-muted">{{ trans("lang.order_receiver_name_photo2_uuid_help") }}</div>
        </div>
    </div>

    <!-- receiver_name_trans_done Field -->
    <div class="form-group row ">
        {!! Form::label('receiver_name_trans_done', trans("lang.order_receiver_name_trans_done"),['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
        {!! Form::text('receiver_name_trans_done', null, ['class' => 'form-control']) !!}
            <div class="form-text text-muted">{{ trans("lang.order_receiver_name_trans_done_help") }}</div>
        </div>
    </div>

    <!-- receiver_eng_name Field -->
    <div class="form-group row ">
        {!! Form::label('receiver_eng_name', trans("lang.order_receiver_eng_name"),['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
        {!! Form::text('receiver_eng_name', null, ['class' => 'form-control']) !!}
            <div class="form-text text-muted">{{ trans("lang.order_receiver_eng_name_help") }}</div>
        </div>
    </div>

    <!-- receiver_phone_digit Field -->
    <div class="form-group row ">
        {!! Form::label('receiver_phone_digit', trans("lang.order_receiver_phone_digit"),['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
        {!! Form::text('receiver_phone_digit', null, ['class' => 'form-control']) !!}
            <div class="form-text text-muted">{{ trans("lang.order_receiver_phone_digit_help") }}</div>
        </div>
    </div>

    <!-- receiver_phone Field -->
    <div class="form-group row ">
        {!! Form::label('receiver_phone', trans("lang.order_receiver_phone"),['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
        {!! Form::text('receiver_phone', null, ['class' => 'form-control']) !!}
            <div class="form-text text-muted">{{ trans("lang.order_receiver_phone_help") }}</div>
        </div>
    </div>

    <!-- sender_name Field -->
    <div class="form-group row ">
        {!! Form::label('sender_name', trans("lang.order_sender_name"),['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
        {!! Form::text('sender_name', null, ['class' => 'form-control']) !!}
            <div class="form-text text-muted">{{ trans("lang.order_sender_name_help") }}</div>
        </div>
    </div>

    <!-- sender_phone Field -->
    <div class="form-group row ">
        {!! Form::label('sender_phone', trans("lang.order_sender_phone"),['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
        {!! Form::text('sender_phone', null, ['class' => 'form-control']) !!}
            <div class="form-text text-muted">{{ trans("lang.order_sender_phone_help") }}</div>
        </div>
    </div>

    <!-- orderno Field -->
    <div class="form-group row ">
        {!! Form::label('orderno', trans("lang.order_orderno"),['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
        {!! Form::text('orderno', null, ['class' => 'form-control']) !!}
            <div class="form-text text-muted">{{ trans("lang.order_orderno_help") }}</div>
        </div>
    </div>

    <!-- regno Field -->
    <div class="form-group row ">
        {!! Form::label('regno', trans("lang.order_regno"),['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
        {!! Form::text('regno', null, ['class' => 'form-control']) !!}
            <div class="form-text text-muted">{{ trans("lang.order_regno_help") }}</div>
        </div>
    </div>

    <!-- pickup_fee Field -->
    <div class="form-group row ">
        {!! Form::label('pickup_fee', trans("lang.order_pickup_fee"),['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
        {!! Form::text('pickup_fee', null, ['class' => 'form-control']) !!}
            <div class="form-text text-muted">{{ trans("lang.order_pickup_fee_help") }}</div>
        </div>
    </div>

    <!-- pickup_base_fee Field -->
    <div class="form-group row ">
        {!! Form::label('pickup_base_fee', trans("lang.order_pickup_base_fee"),['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
        {!! Form::text('pickup_base_fee', null, ['class' => 'form-control']) !!}
            <div class="form-text text-muted">{{ trans("lang.order_pickup_base_fee_help") }}</div>
        </div>
    </div>

    <!-- pickup_add_fee Field -->
    <div class="form-group row ">
        {!! Form::label('pickup_add_fee', trans("lang.order_pickup_add_fee"),['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
        {!! Form::text('pickup_add_fee', null, ['class' => 'form-control']) !!}
            <div class="form-text text-muted">{{ trans("lang.order_pickup_add_fee_help") }}</div>
        </div>
    </div>

    <!-- shipping_price_final Field -->
    <div class="form-group row ">
        {!! Form::label('shipping_price_final', trans("lang.order_shipping_price_final"),['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
        {!! Form::text('shipping_price_final', null, ['class' => 'form-control']) !!}
            <div class="form-text text-muted">{{ trans("lang.order_shipping_price_final_help") }}</div>
        </div>
    </div>

    <!-- shipping_price_type Field -->
    <div class="form-group row ">
        {!! Form::label('shipping_price_type', trans("lang.order_shipping_price_type"),['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
        {!! Form::text('shipping_price_type', null, ['class' => 'form-control']) !!}
            <div class="form-text text-muted">{{ trans("lang.order_shipping_price_type_help") }}</div>
        </div>
    </div>

    <!-- shipping_price_normal Field -->
    <div class="form-group row ">
        {!! Form::label('shipping_price_normal', trans("lang.order_shipping_price_normal"),['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
        {!! Form::text('shipping_price_normal', null, ['class' => 'form-control']) !!}
            <div class="form-text text-muted">{{ trans("lang.order_shipping_price_normal_help") }}</div>
        </div>
    </div>

    <!-- shipping_price_premium Field -->
    <div class="form-group row ">
        {!! Form::label('shipping_price_premium', trans("lang.order_shipping_price_premium"),['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
        {!! Form::text('shipping_price_premium', null, ['class' => 'form-control']) !!}
            <div class="form-text text-muted">{{ trans("lang.order_shipping_price_premium_help") }}</div>
        </div>
    </div>

    <!-- im_id Field -->
    <div class="form-group row ">
        {!! Form::label('im_id', trans("lang.order_im_id"),['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
        {!! Form::text('im_id', null, ['class' => 'form-control']) !!}
            <div class="form-text text-muted">{{ trans("lang.order_im_id_help") }}</div>
        </div>
    </div>

    <!-- payment_method Field -->
    <div class="form-group row ">
        {!! Form::label('payment_method', trans("lang.order_payment_method"),['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
        {!! Form::text('payment_method', null, ['class' => 'form-control']) !!}
            <div class="form-text text-muted">{{ trans("lang.order_payment_method_help") }}</div>
        </div>
    </div>

    <!-- payment_company Field -->
    <div class="form-group row ">
        {!! Form::label('payment_company', trans("lang.order_payment_company"),['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
        {!! Form::text('payment_company', null, ['class' => 'form-control']) !!}
            <div class="form-text text-muted">{{ trans("lang.order_payment_company_help") }}</div>
        </div>
    </div>

    <!-- payment_num Field -->
    <div class="form-group row ">
        {!! Form::label('payment_num', trans("lang.order_payment_num"),['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
        {!! Form::text('payment_num', null, ['class' => 'form-control']) !!}
            <div class="form-text text-muted">{{ trans("lang.order_payment_num_help") }}</div>
        </div>
    </div>

    <!-- payment_amount Field -->
    <div class="form-group row ">
        {!! Form::label('payment_amount', trans("lang.order_payment_amount"),['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
        {!! Form::text('payment_amount', null, ['class' => 'form-control']) !!}
            <div class="form-text text-muted">{{ trans("lang.order_payment_amount_help") }}</div>
        </div>
    </div>

    <!-- pickupOrderNo Field -->
    <div class="form-group row ">
        {!! Form::label('pickupOrderNo', trans("lang.order_pickupOrderNo"),['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
        {!! Form::text('pickupOrderNo', null, ['class' => 'form-control']) !!}
            <div class="form-text text-muted">{{ trans("lang.order_pickupOrderNo_help") }}</div>
        </div>
    </div>

    <!-- shipping_msg Field -->
    <div class="form-group row ">
        {!! Form::label('shipping_msg', trans("lang.order_shipping_msg"),['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
        {!! Form::text('shipping_msg', null, ['class' => 'form-control']) !!}
            <div class="form-text text-muted">{{ trans("lang.order_shipping_msg_help") }}</div>
        </div>
    </div>
</div>
{{--@if($customFields)
    <div class="clearfix"></div>
    <div class="col-12 custom-field-container">
        <h5 class="col-12 pb-4">{!! trans('lang.custom_field_plural') !!}</h5>
        {!! $customFields !!}
    </div>
@endif--}}
<!-- Submit Field -->
<div class="form-group col-12 text-right">
    <button type="submit" class="btn btn-{{setting('theme_color')}}"><i class="fa fa-save"></i> {{trans('lang.save')}} {{trans('lang.order')}}</button>
    <a href="{!! url()->previous() !!}" class="btn btn-default"><i class="fa fa-undo"></i> {{trans('lang.cancel')}}</a>
</div>
