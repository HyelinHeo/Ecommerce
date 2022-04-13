@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">{{trans('lang.order_plural')}}<small class="ml-3 mr-3">|</small><small>{{trans('lang.order_desc')}}</small></h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{url('/dashboard')}}"><i class="fa fa-dashboard"></i> {{trans('lang.dashboard')}}</a></li>
          <li class="breadcrumb-item"><a href="{!! route('orders.index') !!}">{{trans('lang.order_plural')}}</a>
          </li>
          <li class="breadcrumb-item active">{{trans('lang.order')}}</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<div class="content">
  <div class="card">
    <div class="card-header d-print-none">
      <ul class="nav nav-tabs align-items-end card-header-tabs w-100">
        <li class="nav-item">
          <a class="nav-link" href="{!! route('orders.index') !!}"><i class="fa fa-list mr-2"></i>{{trans('lang.order_table')}}</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="{!! url()->current() !!}"><i class="fa fa-plus mr-2"></i>{{trans('lang.order')}}</a>
        </li>
        <div class="ml-auto d-inline-flex">
          <!-- <li class="nav-item">
            <a class="nav-link pt-1" id="printOrder" href="#"><i class="fa fa-print"></i> {{trans('lang.print')}}</a>
          </li> -->
          @can('orders.edit')
          <li class="nav-item">
            <a class="nav-link pt-1" href="{{ route('orders.edit', $order->id) }}"><i class="fa fa-edit"></i> {{trans('lang.order_edit')}}</a>
          </li>
          @endcan
          @can('orders.destroy')
          <li class="nav-item">
            {!! Form::open(['route' => ['orders.destroy', $order->id], 'method' => 'delete']) !!}
              {!! Form::button('<i class="fa fa-trash"></i>', [
              'type' => 'submit',
              'class' => 'btn btn-link text-danger',
              'onclick' => "return confirm('Are you sure?')"
              ]) !!}
            {!! Form::close() !!}
          </li>
          @endcan
        </div>
      </ul>
    </div>
    <div class="card-body">
      <div class="row">
        @include('orders.show_fields')
      </div>
    <p class="text-dark">{{trans('lang.product_plural')}}</p>
      @include('product_orders.table')
      {{--payment table--}}
    <p class="text-dark">{{trans('lang.payment_plural')}}</p>
      <div id="dataTableBuilder_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
        <table class="table dataTable no-footer dtr-inline" id="dataTableBuilder" width="100%" role="grid" style="width: 100%;">
          <thead>
            <tr role="row">
              <th title="{{trans('lang.payment_userName')}}" class="sorting_disabled"aria-label="{{trans('lang.payment_userName')}}" data-column-index="0">{{trans('lang.payment_userName')}}</th>
              <th title="{{trans('lang.payment_price')}}" class="sorting_disabled" aria-label="{{trans('lang.payment_price')}}" data-column-index="4">{{trans('lang.payment_price')}}</th>
              <th title="{{trans('lang.payment_resultCode')}}" class="sorting_disabled" aria-label="{{trans('lang.payment_resultCode')}}" data-column-index="1">{{trans('lang.payment_resultCode')}}</th>
              <th title="{{trans('lang.payment_payType')}}" class="sorting_disabled" aria-label="{{trans('lang.payment_payType')}}" data-column-index="2">{{trans('lang.payment_payType')}}</th>
              <th title="{{trans('lang.payment_authDate')}}" class="sorting_disabled" aria-label="{{trans('lang.payment_authDate')}}" data-column-index="3">{{trans('lang.payment_authDate')}}</th>
              <th title="{{trans('lang.payment_cancelResultCode')}}" class="sorting_disabled" aria-label="{{trans('lang.payment_cancelResultCode')}}" data-column-index="4">{{trans('lang.payment_cancelResultCode')}}</th>
              <th title="{{trans('lang.payment_prtcResultCode')}}" class="sorting_disabled" aria-label="{{trans('lang.payment_prtcResultCode')}}" data-column-index="5">{{trans('lang.payment_prtcResultCode')}}</th>
              <th title="{{trans('lang.view_details')}}" class="sorting_disabled" aria-label="{{trans('lang.view_details')}}" data-column-index="6">{{trans('lang.view_details')}}</th>
            </tr>
          </thead>
          <tbody>
          @if(count($payments)>0)
            @foreach($payments as $payment)
              <tr role="row" class="odd">
                <td>{!! $payment['userName'] !!}</td>   
                <td>{!! getPrice($payment['price']) !!}</td>  
                <td>{!! $payment['resultCode'] !!}</td>  
                <td>{!! $payment['payType'] !!}</td>  
                <td>{!! $payment['authDate'] !!}</td>  
                <td>{!! $payment['cancelResultCode'] !!}</td>  
                <td>{!! $payment['prtcResultCode'] !!}</td>   
                <td><a class='btn btn-link' href="{{ route('payments.show', $payment->id) }}"><i class="fa fa-eye"></i></a></td>  
              </tr>
            @endforeach 
          @else
          <tr><td colspan='7' style="text-align: -webkit-center;">{{trans('lang.payment_no_data_available')}}</td></tr>
          @endif
          </tbody>
        </table>
      </div>
      {{--pickupInformations table--}}
    <p class="text-dark">{{trans('lang.delivery_address_plural')}}</p>
      <div id="dataTableBuilder_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
        <table class="table dataTable no-footer dtr-inline" id="dataTableBuilder" width="100%" role="grid" style="width: 100%;">
          <thead>
            <tr role="row">
              <th title="{{trans('lang.delivery_address_pickup_mode')}}" class="sorting_disabled"aria-label="{{trans('lang.delivery_address_pickup_mode')}}" data-column-index="0">{{trans('lang.delivery_address_pickup_mode')}}</th>
              <th title="{{trans('lang.delivery_address_pickup_request')}}" class="sorting_disabled" aria-label="{{trans('lang.delivery_address_pickup_request')}}" data-column-index="4">{{trans('lang.delivery_address_pickup_request')}}</th>
              <th title="{{trans('lang.delivery_address_pickup_fee')}}" class="sorting_disabled" aria-label="{{trans('lang.delivery_address_pickup_fee')}}" data-column-index="1">{{trans('lang.delivery_address_pickup_fee')}}</th>
              <th title="{{trans('lang.delivery_address_pickup_base_fee')}}" class="sorting_disabled" aria-label="{{trans('lang.delivery_address_pickup_base_fee')}}" data-column-index="2">{{trans('lang.delivery_address_pickup_base_fee')}}</th>
              <th title="{{trans('lang.delivery_address_pickup_add_fee')}}" class="sorting_disabled" aria-label="{{trans('lang.delivery_address_pickup_add_fee')}}" data-column-index="3">{{trans('lang.delivery_address_pickup_add_fee')}}</th>
              <th title="{{trans('lang.delivery_address_pickup_orderNo')}}" class="sorting_disabled" aria-label="{{trans('lang.delivery_address_pickup_orderNo')}}" data-column-index="4">{{trans('lang.delivery_address_pickup_orderNo')}}</th>
              <th title="{{trans('lang.delivery_address_pickup_status')}}" class="sorting_disabled" aria-label="{{trans('lang.delivery_address_pickup_status')}}" data-column-index="5">{{trans('lang.delivery_address_pickup_status')}}</th>
              <th title="{{trans('lang.view_details')}}" class="sorting_disabled" aria-label="{{trans('lang.view_details')}}" data-column-index="6">{{trans('lang.view_details')}}</th>
            </tr>
          </thead>
          <tbody>
          @if(count($pickupInformations)>0)
            @foreach($pickupInformations as $pickup)
              <tr role="row" class="odd">
                <td>{!! $pickup['pickup_mode'] !!}</td>  
                <td>{!! getBoolean($pickup['pickup_request']) !!}</td>  
                <td>{!! getPrice($pickup['pickup_fee']) !!}</td>  
                <td>{!! getPrice($pickup['pickup_base_fee']) !!}</td>  
                <td>{!! getPrice($pickup['pickup_add_fee']) !!}</td>  
                <td>{!! $pickup['pickupOrderNo'] !!}</td>  
                <td>{!! $pickup['pickupStatus'] !!}</td>  
                <td><a class='btn btn-link' href="{{ route('deliveryAddresses.show', $pickup->id) }}"><i class="fa fa-eye"></i></a></td>  
              </tr>
            @endforeach 
          @else
          <tr><td colspan='7' style="text-align: -webkit-center;">{{trans('lang.delivery_address_no_data_available')}}</td></tr>
          @endif
          </tbody>
        </table>
      </div>

      {{--<div class="row">
      <div class="col-5 offset-7">
        <div class="table-responsive table-light">
          <table class="table">
            <tbody><tr>
              <th class="text-right">{{trans('lang.order_subtotal')}}</th>
              <td>{!! getPrice($subtotal) !!}</td>
            </tr>
            <tr>
              <th class="text-right">{{trans('lang.order_delivery_fee')}}</th>
              <td>{!! getPrice($order['delivery_fee'])!!}</td>
            </tr>
            <tr>
              <th class="text-right">{{trans('lang.order_tax')}} ({!!$order->tax!!}%) </th>
              <td>{!! getPrice($taxAmount)!!}</td>
            </tr>

            <tr>
              <th class="text-right">{{trans('lang.order_total')}}</th>
              <td>{!!getPrice($total)!!}</td>
            </tr>
            </tbody></table>
        </div>
      </div>
      </div>--}}
      <div class="clearfix"></div>
      <div class="row d-print-none">
        <!-- Back Field -->
        <div class="form-group col-12 text-right">
          <a href="{!! url()->previous() !!}" class="btn btn-default"><i class="fa fa-undo"></i> {{trans('lang.back')}}</a>
        </div>
      </div>
      <div class="clearfix"></div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
  <script type="text/javascript">
    $("#printOrder").on("click",function () {
      window.print();
    });
  </script>
@endpush
