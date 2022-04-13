<!-- Id Field -->
<div class="form-group row col-md-4 col-sm-12">
    {!! Form::label('id', trans('lang.order_id'), ['class' => 'col-4 control-label']) !!}
    <div class="col-8">
      <p>#{!! $order->id !!}</p>
    </div>

    {!! Form::label('order_client', trans('lang.order_client'), ['class' => 'col-4 control-label']) !!}
    <div class="col-8">
      <p>{!! $order->user->name !!}</p>
    </div>

    {!! Form::label('order_client_email', trans('lang.order_user_email'), ['class' => 'col-4 control-label']) !!}
    <div class="col-8">
      <p>{!! $order->user->email !!}</p>
    </div>

    {!! Form::label('hint', 'Hint:', ['class' => 'col-4 control-label']) !!}
    <div class="col-8">
        <p>{!! $order->hint !!}</p>
    </div>

    {!! Form::label('accident_code', trans('lang.order_accident_code'), ['class' => 'col-4 control-label']) !!}
    <div class="col-8">
      <p>{!! $order->accident_code !!}</p>
    </div>

    {!! Form::label('accident_desc', trans('lang.order_accident_desc'), ['class' => 'col-4 control-label']) !!}
    <div class="col-8">
      <p>{!! $order->accident_desc !!}</p>
    </div>

    {!! Form::label('accident_result', trans('lang.order_accident_result'), ['class' => 'col-4 control-label']) !!}
    <div class="col-8">
      <p>{!! $order->accident_result !!}</p>
    </div>

    {!! Form::label('cancel_code', trans('lang.order_cancel_code'), ['class' => 'col-4 control-label']) !!}
    <div class="col-8">
      <p>{!! $order->cancel_code !!}</p>
    </div>

    {!! Form::label('cancel_desc', trans('lang.order_cancel_desc'), ['class' => 'col-4 control-label']) !!}
    <div class="col-8">
      <p>{!! $order->cancel_desc !!}</p>
    </div>

    {!! Form::label('cancel_result', trans('lang.order_cancel_result'), ['class' => 'col-4 control-label']) !!}
    <div class="col-8">
      <p>{!! $order->cancel_result !!}</p>
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

    {!! Form::label('item_count', trans('lang.order_item_count'), ['class' => 'col-4 control-label']) !!}
    <div class="col-8">
      <p>{!! $order->item_count  !!}</p>
    </div>

    {!! Form::label('item_total_price', trans('lang.order_item_total_price'), ['class' => 'col-4 control-label']) !!}
    <div class="col-8">
      <p>{!! $order->item_total_price  !!}</p>
    </div>

    {!! Form::label('item_main_name', trans('lang.order_item_main_name'), ['class' => 'col-4 control-label']) !!}
    <div class="col-8">
      <p>{!! $order->item_main_name  !!}</p>
    </div>

    {!! Form::label('item_main_category', trans('lang.order_item_main_category'), ['class' => 'col-4 control-label']) !!}
    <div class="col-8">
      <p>{!! $order->item_main_category  !!}</p>
    </div>
</div>

<!-- Order Status Id Field -->
<div class="form-group row col-md-4 col-sm-12">

    {!! Form::label('weight', trans('lang.order_weight'), ['class' => 'col-4 control-label']) !!}
    <div class="col-8">
      <p>{!! $order->weight  !!}</p>
    </div>

    {!! Form::label('weightunit', trans('lang.order_weightunit'), ['class' => 'col-4 control-label']) !!}
    <div class="col-8">
      <p>{!! $order->weightunit  !!}</p>
    </div>

    {!! Form::label('size_width', trans('lang.order_size_width'), ['class' => 'col-4 control-label']) !!}
    <div class="col-8">
      <p>{!! $order->size_width  !!}</p>
    </div>

    {!! Form::label('size_length', trans('lang.order_size_length'), ['class' => 'col-4 control-label']) !!}
    <div class="col-8">
      <p>{!! $order->size_length  !!}</p>
    </div>

    {!! Form::label('size_height', trans('lang.order_size_height'), ['class' => 'col-4 control-label']) !!}
    <div class="col-8">
      <p>{!! $order->size_height  !!}</p>
    </div>

    {!! Form::label('sizeunit', trans('lang.order_sizeunit'), ['class' => 'col-4 control-label']) !!}
    <div class="col-8">
      <p>{!! $order->sizeunit  !!}</p>
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

    {!! Form::label('order_status_id', trans('lang.order_status_status'), ['class' => 'col-4 control-label']) !!}
    <div class="col-8">
      <p>{!! $order->orderStatus->status  !!}</p>
    </div>
</div>

<div class="form-group row col-md-4 col-sm-12">
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

    {!! Form::label('sender_name', trans('lang.order_sender_name'), ['class' => 'col-4 control-label']) !!}
    <div class="col-8">
      <p>{!! $order->sender_name  !!}</p>
    </div>

    {!! Form::label('sender_phone', trans('lang.order_sender_phone'), ['class' => 'col-4 control-label']) !!}
    <div class="col-8">
      <p>{!! $order->sender_phone  !!}</p>
    </div>

    {!! Form::label('shipping_price_final', trans('lang.order_shipping_price_final'), ['class' => 'col-4 control-label']) !!}
    <div class="col-8">
      <p>{!! $order->shipping_price_final  !!}</p>
    </div>

    {!! Form::label('shipping_price_type', trans('lang.order_shipping_price_type'), ['class' => 'col-4 control-label']) !!}
    <div class="col-8">
      <p>{!! $order->shipping_price_type  !!}</p>
    </div>

    {!! Form::label('shipping_price_normal', trans('lang.order_shipping_price_normal'), ['class' => 'col-4 control-label']) !!}
    <div class="col-8">
      <p>{!! $order->shipping_price_normal  !!}</p>
    </div>

    {!! Form::label('shipping_price_premium', trans('lang.order_shipping_price_premium'), ['class' => 'col-4 control-label']) !!}
    <div class="col-8">
      <p>{!! $order->shipping_price_premium  !!}</p>
    </div>

    {!! Form::label('shipping_msg', trans('lang.order_shipping_msg'), ['class' => 'col-4 control-label']) !!}
    <div class="col-8">
    <p>{!! ($order->shipping_msg) !!}</p>
    </div>

    {!! Form::label('active', trans('lang.order_active'), ['class' => 'col-4 control-label']) !!}
    <div class="col-8">
    @if($order->active)
      <p><span class='badge badge-success'> {{trans('lang.yes')}}</span></p>
      @else
      <p><span class='badge badge-danger'>{{trans('lang.order_canceled')}}</span></p>
      @endif
    </div>

    {!! Form::label('order_created_date', trans('lang.order_created_at'), ['class' => 'col-4 control-label']) !!}
    <div class="col-8">
        <p>{!! $order->created_at !!}</p>
    </div>
    
    {!! Form::label('order_updated_date', trans('lang.order_updated_at'), ['class' => 'col-4 control-label']) !!}
    <div class="col-8">
        <p>{!! $order->updated_at !!}</p>
    </div>
</div>

{{--<!-- Tax Field -->--}}
{{--<div class="form-group row col-md-6 col-sm-12">--}}
{{--  {!! Form::label('tax', 'Tax:', ['class' => 'col-4 control-label']) !!}--}}
{{--  <div class="col-8">--}}
{{--    <p>{!! $order->tax !!}</p>--}}
{{--  </div>--}}
{{--</div>--}}


