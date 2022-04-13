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

</div>
<div style="flex: 50%;max-width: 50%;padding: 0 4px;" class="column">
    
    <!-- Photo1 Field -->
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

</div>

<!-- Submit Field -->
<div class="form-group col-12 text-right">
    <button type="submit" class="btn btn-{{setting('theme_color')}}"><i class="fa fa-save"></i> {{trans('lang.save')}} {{trans('lang.watchdog_orders')}}</button>
    <a href="{!! url()->previous() !!}" class="btn btn-default"><i class="fa fa-undo"></i> {{trans('lang.cancel')}}</a>
</div>
