<!-- Id Field -->
<div class="form-group row col-md-6 col-sm-12">
    {!! Form::label('order_client', trans('lang.order_client'), ['class' => 'col-4 control-label']) !!}
    <div class="col-8">
      <p>{!! $order->user->name !!}</p>
    </div>

    {!! Form::label('order_client_email', trans('lang.order_user_email'), ['class' => 'col-4 control-label']) !!}
    <div class="col-8">
      <p>{!! $order->user->email !!}</p>
    </div>

    {!! Form::label('order_status_id', trans('lang.order_status_status'), ['class' => 'col-4 control-label']) !!}
    <div class="col-8">
      <p>{!! $order->orderStatus->status  !!}</p>
    </div>

    {!! Form::label('order_status_updated_at', trans('lang.order_order_status_updated_at'), ['class' => 'col-4 control-label']) !!}
    <div class="col-8">
      <p>{!! $order->order_status_updated_at  !!}</p>
    </div>

    {!! Form::label('created_at', trans('lang.order_created_at'), ['class' => 'col-4 control-label']) !!}
    <div class="col-8">
      <p>{!! $order->created_at  !!}</p>
    </div>

    {!! Form::label('updated_at', trans('lang.order_updated_at'), ['class' => 'col-4 control-label']) !!}
    <div class="col-8">
      <p>{!! $order->updated_at  !!}</p>
    </div>

</div>

