<!-- Id Field -->
<div class="form-group row col-md-4 col-sm-12">
    {!! Form::label('order_client', trans('lang.order_client'), ['class' => 'col-4 control-label']) !!}
    <div class="col-8">
      <p>{!! $order->user->name !!}</p>
    </div>

    {!! Form::label('order_client_email', trans('lang.order_user_email'), ['class' => 'col-4 control-label']) !!}
    <div class="col-8">
      <p>{!! $order->user->email !!}</p>
    </div>

    {!! Form::label('nation_code', trans('lang.order_nation_code'), ['class' => 'col-4 control-label']) !!}
    <div class="col-8">
      <p>{!! $order->nation_code  !!}</p>
    </div>

    {!! Form::label('post_num', trans('lang.order_post_num'), ['class' => 'col-4 control-label']) !!}
    <div class="col-8">
      <p>{!! $order->post_num  !!}</p>
    </div>

    {!! Form::label('address1', trans('lang.order_address1'), ['class' => 'col-4 control-label']) !!}
    <div class="col-8">
      <p>{!! $order->address1  !!}</p>
    </div>

    {!! Form::label('address2', trans('lang.order_address2'), ['class' => 'col-4 control-label']) !!}
    <div class="col-8">
      <p>{!! $order->address2  !!}</p>
    </div>

    {!! Form::label('address3', trans('lang.order_address3'), ['class' => 'col-4 control-label']) !!}
    <div class="col-8">
      <p>{!! $order->address3  !!}</p>
    </div>

    {!! Form::label('address4', trans('lang.order_address4'), ['class' => 'col-4 control-label']) !!}
    <div class="col-8">
      <p>{!! $order->address4  !!}</p>
    </div>

</div>

<div class="form-group row col-md-4 col-sm-12">
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

    {!! Form::label('address_trans_done', trans('lang.order_address_trans_done'), ['class' => 'col-4 control-label']) !!}
    <div class="col-8">
      <p>{!! $order->address_trans_done  !!}</p>
    </div>

    {!! Form::label('receiver_name', trans('lang.order_receiver_name'), ['class' => 'col-4 control-label']) !!}
    <div class="col-8">
      <p>{!! $order->receiver_name  !!}</p>
    </div>

    {!! Form::label('receiver_name_photo1', trans('lang.order_receiver_name_photo1'), ['class' => 'col-4 control-label']) !!}
    <div class="col-8">
      <p>{!! getExpandPhoto($order, 'receiver_name_photo1');  !!}</p>
    </div>

    {!! Form::label('receiver_name_photo1_uuid', trans('lang.order_receiver_name_photo1_uuid'), ['class' => 'col-4 control-label']) !!}
    <div class="col-8">
      <p>{!! $order->receiver_name_photo1_uuid  !!}</p>
    </div>
</div>

<div class="form-group row col-md-4 col-sm-12">

    {!! Form::label('receiver_name_photo2', trans('lang.order_receiver_name_photo2'), ['class' => 'col-4 control-label']) !!}
    <div class="col-8">
      <p>{!! getExpandPhoto($order, 'receiver_name_photo2');  !!}</p>
    </div>

    {!! Form::label('receiver_name_photo2_uuid', trans('lang.order_receiver_name_photo2_uuid'), ['class' => 'col-4 control-label']) !!}
    <div class="col-8">
      <p>{!! $order->receiver_name_photo2_uuid  !!}</p>
    </div>

    {!! Form::label('receiver_name_trans_done', trans('lang.order_receiver_name_trans_done'), ['class' => 'col-4 control-label']) !!}
    <div class="col-8">
      <p>{!! $order->receiver_name_trans_done  !!}</p>
    </div>

    {!! Form::label('receiver_eng_name', trans('lang.order_receiver_eng_name'), ['class' => 'col-4 control-label']) !!}
    <div class="col-8">
      <p>{!! $order->receiver_eng_name  !!}</p>
    </div>

    {!! Form::label('receiver_phone_digit', trans('lang.order_receiver_phone_digit'), ['class' => 'col-4 control-label']) !!}
    <div class="col-8">
      <p>{!! $order->receiver_phone_digit  !!}</p>
    </div>

    {!! Form::label('receiver_phone', trans('lang.order_receiver_phone'), ['class' => 'col-4 control-label']) !!}
    <div class="col-8">
      <p>{!! $order->receiver_phone  !!}</p>
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

