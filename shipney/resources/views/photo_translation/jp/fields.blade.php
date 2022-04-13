{{--@if($customFields)
    <h5 class="col-12 pb-4">{!! trans('lang.main_fields') !!}</h5>
@endif--}}
<div style="flex: 50%;max-width: 45%;padding: 10px;" class="column">

    <!-- nation_code Field -->
    <div class="form-group row ">
        {!! Form::label('nation_code', trans("lang.order_nation_code"),['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
        {!! Form::text('nation_code', null, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="group-border">

        <!-- address_photo1 Field -->
        <div class="form-group row ">
            {!! Form::label('address_photo1', trans("lang.order_address_photo1"),['class' => 'col-3 control-label text-right']) !!}
            <div class="col-9">
            {!! getExpandPhotoForTrans($order, 'address_photo1', true);  !!}
            </div>
        </div>

        <!-- address_photo1_uuid Field -->
        <!-- <div class="form-group row ">
            {!! Form::label('address_photo1_uuid', trans("lang.order_address_photo1_uuid"),['class' => 'col-3 control-label text-right']) !!}
            <div class="col-9">
            {!! Form::text('address_photo1_uuid', null, ['class' => 'form-control']) !!}
            </div>
        </div> -->

        <!-- address_photo2 Field -->
        <div class="form-group row ">
            {!! Form::label('address_photo2', trans("lang.order_address_photo2"),['class' => 'col-3 control-label text-right']) !!}
            <div class="col-9">
            {!! getExpandPhotoForTrans($order, 'address_photo2', true);  !!}
            </div>
        </div>

        <!-- address_photo2_uuid Field -->
        <!-- <div class="form-group row ">
            {!! Form::label('address_photo2_uuid', trans("lang.order_address_photo2_uuid"),['class' => 'col-3 control-label text-right']) !!}
            <div class="col-9">
            {!! Form::text('address_photo2_uuid', null, ['class' => 'form-control']) !!}
            </div>
        </div> -->

        <!-- post_num Field -->
        <div class="form-group row ">
            {!! Form::label('post_num', trans("lang.order_post_num"),['class' => 'col-3 control-label text-right']) !!}
            <div class="col-9">
            {!! Form::text('post_num', null, ['class' => 'form-control']) !!}
            </div>
        </div>

        <!-- address1 Field -->
        <div class="form-group row ">
            {!! Form::label('address1', trans("lang.order_address1"),['class' => 'col-3 control-label text-right']) !!}
            <div class="col-9">
            {!! Form::text('address1', null, ['class' => 'form-control']) !!}
            </div>
        </div>

        <!-- address2 Field -->
        <div class="form-group row ">
            {!! Form::label('address2', trans("lang.order_address2"),['class' => 'col-3 control-label text-right']) !!}
            <div class="col-9">
            {!! Form::text('address2', null, ['class' => 'form-control']) !!}
            </div>
        </div>

        <!-- address3 Field -->
        <div class="form-group row ">
            {!! Form::label('address3', trans("lang.order_address3"),['class' => 'col-3 control-label text-right']) !!}
            <div class="col-9">
            {!! Form::text('address3', null, ['class' => 'form-control']) !!}
            </div>
        </div>

        <!-- address4 Field -->
        <div class="form-group row ">
            {!! Form::label('address4', trans("lang.order_address4"),['class' => 'col-3 control-label text-right']) !!}
            <div class="col-9">
            {!! Form::text('address4', null, ['class' => 'form-control']) !!}
            </div>
        </div>
    </div>

    <!-- address_trans_done Field -->
    <div class="form-group row ">
        {!! Form::label('address_trans_done', trans("lang.order_address_trans_done"),['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
        {!! Form::hidden('address_trans_done', false) !!}
        {!! Form::checkbox('address_trans_done', 'complete', null) !!}
            <div class="form-text text-muted">{{ trans("lang.order_address_trans_done_help") }}</div>
        </div>
    </div>
</div>
<div style="flex: 50%;max-width: 45%;padding: 10px;" class="column">
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
        </div>
    </div>

    @if(isset($order))
    <!-- User Email Field -->
    <div class="form-group row ">
        {!! Form::label('user_email', trans("lang.order_user_email"),['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
                {!! Form::text('user_email', $order->user->email, ['class' => 'form-control', 'disabled']) !!}
        </div>
    </div>
    @endif

    <div class="group-border">

        <!-- receiver_name_photo1 Field -->
        <div class="form-group row ">
            {!! Form::label('receiver_name_photo1', trans("lang.order_receiver_name_photo1"),['class' => 'col-3 control-label text-right']) !!}
            <div class="col-9">
            {!! getExpandPhotoForTrans($order, 'receiver_name_photo1', false);  !!}
            </div>
        </div>

        <!-- receiver_name_photo1_uuid Field -->
        <!-- <div class="form-group row ">
            {!! Form::label('receiver_name_photo1_uuid', trans("lang.order_receiver_name_photo1_uuid"),['class' => 'col-3 control-label text-right']) !!}
            <div class="col-9">
            {!! Form::text('receiver_name_photo1_uuid', null, ['class' => 'form-control']) !!}
            </div>
        </div> -->

        <!-- receiver_name_photo2 Field -->
        <div class="form-group row ">
            {!! Form::label('receiver_name_photo2', trans("lang.order_receiver_name_photo2"),['class' => 'col-3 control-label text-right']) !!}
            <div class="col-9">
            {!! getExpandPhotoForTrans($order, 'receiver_name_photo2', false);  !!}
            </div>
        </div>

        <!-- receiver_name_photo2_uuid Field -->
        <!-- <div class="form-group row ">
            {!! Form::label('receiver_name_photo2_uuid', trans("lang.order_receiver_name_photo2_uuid"),['class' => 'col-3 control-label text-right']) !!}
            <div class="col-9">
            {!! Form::text('receiver_name_photo2_uuid', null, ['class' => 'form-control']) !!}
            </div>
        </div> -->

        <!-- receiver_name Field -->
        <div class="form-group row ">
            {!! Form::label('receiver_name', trans("lang.order_receiver_name"),['class' => 'col-3 control-label text-right']) !!}
            <div class="col-9">
            {!! Form::text('receiver_name', null, ['class' => 'form-control']) !!}
            </div>
        </div>

        <!-- receiver_eng_name Field -->
        <div class="form-group row ">
            {!! Form::label('receiver_eng_name', trans("lang.order_receiver_eng_name"),['class' => 'col-3 control-label text-right']) !!}
            <div class="col-9">
            {!! Form::text('receiver_eng_name', null, ['class' => 'form-control']) !!}
            </div>
        </div>
    </div>

    <!-- receiver_name_trans_done Field -->
    <div class="form-group row ">
        {!! Form::label('receiver_name_trans_done', trans("lang.order_receiver_name_trans_done"),['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
        {!! Form::hidden('receiver_name_trans_done', false) !!}
        {!! Form::checkbox('receiver_name_trans_done', 'complete', null) !!}
            <div class="form-text text-muted">{{ trans("lang.order_receiver_name_trans_done_help") }}</div>
        </div>
    </div>

    <!-- receiver_phone_digit Field -->
    <!-- <div class="form-group row ">
        {!! Form::label('receiver_phone_digit', trans("lang.order_receiver_phone_digit"),['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
        {!! Form::text('receiver_phone_digit', null, ['class' => 'form-control']) !!}
        </div>
    </div> -->

    <!-- receiver_phone Field -->
    <!-- <div class="form-group row ">
        {!! Form::label('receiver_phone', trans("lang.order_receiver_phone"),['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
        {!! Form::text('receiver_phone', null, ['class' => 'form-control']) !!}
        </div>
    </div> -->

    <!-- order_status_id Field (required) -->
    <div class="form-group row ">
        <div class="col-9">
        {!! Form::hidden('order_status_id', null, ['class' => 'form-control']) !!}
        </div>
    </div>

    <!-- 'Boolean active Field' -->
    <!-- <div class="form-group row ">
        {!! Form::label('active', trans("lang.order_active"),['class' => 'col-3 control-label text-right']) !!}
        <div class="checkbox icheck">
            <label class="col-9 ml-2 form-check-inline">
                {!! Form::hidden('active', 0) !!}
                {!! Form::checkbox('active', 1, null) !!}
            </label>
        </div>
    </div> -->
</div>

<!-- Submit Field -->
<div class="form-group col-12 text-right">
    <button type="submit" class="btn btn-{{setting('theme_color')}}"><i class="fa fa-save"></i> {{trans('lang.save')}} {{trans('lang.photo_translation')}}</button>
    <a href="{!! url()->previous() !!}" class="btn btn-default"><i class="fa fa-undo"></i> {{trans('lang.cancel')}}</a>
</div>
