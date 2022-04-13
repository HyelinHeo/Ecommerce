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

    <!-- Order Status Id Field -->
    <div class="form-group row ">
        {!! Form::label('order_status_id', trans("lang.order_order_status_id"),['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            {!! Form::select('order_status_id', $orderStatus, null, ['class' => 'select2 form-control']) !!}
            <div class="form-text text-muted">{{ trans("lang.order_order_status_id_help") }}</div>
        </div>
    </div>

</div>

<!-- Submit Field -->
<div class="form-group col-12 text-right">
    <button type="submit" class="btn btn-{{setting('theme_color')}}"><i class="fa fa-save"></i> {{trans('lang.save')}} {{trans('lang.watchdog_orders')}}</button>
    <a href="{!! url()->previous() !!}" class="btn btn-default"><i class="fa fa-undo"></i> {{trans('lang.cancel')}}</a>
</div>
