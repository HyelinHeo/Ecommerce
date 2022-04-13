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

    {!! Form::label('photo1', trans('lang.order_photo1'), ['class' => 'col-4 control-label']) !!}
    <div class="col-8">
      <p>{!! getExpandPhoto($order, 'photo1');  !!}</p>
    </div>

    {!! Form::label('photo1_uuid', trans('lang.order_photo1_uuid'), ['class' => 'col-4 control-label']) !!}
    <div class="col-8">
      <p>{!! $order->photo1_uuid  !!}</p>
    </div>

    {!! Form::label('photo2', trans('lang.order_photo2'), ['class' => 'col-4 control-label']) !!}
    <div class="col-8">
      <p>{!! getExpandPhoto($order, 'photo2');  !!}</p>
    </div>

    {!! Form::label('photo2_uuid', trans('lang.order_photo2_uuid'), ['class' => 'col-4 control-label']) !!}
    <div class="col-8">
      <p>{!! $order->photo2_uuid  !!}</p>
    </div>

    {!! Form::label('photo3', trans('lang.order_photo3'), ['class' => 'col-4 control-label']) !!}
    <div class="col-8">
      <p>{!! getExpandPhoto($order, 'photo3');  !!}</p>
    </div>

    {!! Form::label('photo3_uuid', trans('lang.order_photo3_uuid'), ['class' => 'col-4 control-label']) !!}
    <div class="col-8">
      <p>{!! $order->photo3_uuid  !!}</p>
    </div>

</div>
    
<div class="form-group row col-md-6 col-sm-12">
    
    {!! Form::label('address_photo1', trans('lang.order_address_photo1'), ['class' => 'col-4 control-label']) !!}
    <div class="col-8">
      <p>{!! getExpandPhoto($order, 'address_photo1');  !!}</p>
    </div>

    {!! Form::label('address_photo1_uuid', trans('lang.order_address_photo1_uuid'), ['class' => 'col-4 control-label']) !!}
    <div class="col-8">
      <p>{!! $order->address_photo1_uuid  !!}</p>
    </div>

    {!! Form::label('address_photo2', trans('lang.order_address_photo2'), ['class' => 'col-4 control-label']) !!}
    <div class="col-8">
      <p>{!! getExpandPhoto($order, 'address_photo2');  !!}</p>
    </div>

    {!! Form::label('address_photo2_uuid', trans('lang.order_address_photo2_uuid'), ['class' => 'col-4 control-label']) !!}
    <div class="col-8">
      <p>{!! $order->address_photo2_uuid  !!}</p>
    </div>
    
    {!! Form::label('receiver_name_photo1', trans('lang.order_receiver_name_photo1'), ['class' => 'col-4 control-label']) !!}
    <div class="col-8">
      <p>{!! getExpandPhoto($order, 'receiver_name_photo1');  !!}</p>
    </div>

    {!! Form::label('receiver_name_photo1_uuid', trans('lang.order_receiver_name_photo1_uuid'), ['class' => 'col-4 control-label']) !!}
    <div class="col-8">
      <p>{!! $order->receiver_name_photo1_uuid  !!}</p>
    </div>

    {!! Form::label('receiver_name_photo2', trans('lang.order_receiver_name_photo2'), ['class' => 'col-4 control-label']) !!}
    <div class="col-8">
      <p>{!! getExpandPhoto($order, 'receiver_name_photo2');  !!}</p>
    </div>

    {!! Form::label('receiver_name_photo2_uuid', trans('lang.order_receiver_name_photo2_uuid'), ['class' => 'col-4 control-label']) !!}
    <div class="col-8">
      <p>{!! $order->receiver_name_photo2_uuid  !!}</p>
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

