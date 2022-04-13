@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">{{trans('lang.delivery_address_plural')}}<small class="ml-3 mr-3">|</small><small>{{trans('lang.delivery_address_desc')}}</small></h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> {{trans('lang.dashboard')}}</a></li>
          <li class="breadcrumb-itema ctive"><a href="{!! route('deliveryAddresses.index') !!}">{{trans('lang.delivery_address_plural')}}</a>
          </li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<div class="content">
  <div class="card">
    <div class="card-header">
      <ul class="nav nav-tabs align-items-end card-header-tabs w-100">
        <li class="nav-item">
          <a class="nav-link" href="{!! route('deliveryAddresses.index') !!}"><i class="fa fa-list mr-2"></i>{{trans('lang.delivery_address_table')}}</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="{!! url()->current() !!}"><i class="fa fa-plus mr-2"></i>{{trans('lang.delivery_address')}}</a>
        </li>
        @can('deliveryAddresses.create')
        <li class="nav-item">
          <a class="nav-link active" href="{!! route('deliveryAddresses.create') !!}"><i class="fa fa-plus mr-2"></i>{{trans('lang.delivery_address_create')}}</a>
        </li>
        @endcan
        <div class="ml-auto d-inline-flex">
          <!-- <li class="nav-item">
            <a class="nav-link pt-1" id="printOrder" href="#"><i class="fa fa-print"></i> {{trans('lang.print')}}</a>
          </li> -->
          @can('deliveryAddresses.edit')
          <li class="nav-item">
            <a class="nav-link pt-1" href="{{ route('deliveryAddresses.edit', $deliveryAddress->id) }}"><i class="fa fa-edit"></i> {{trans('lang.delivery_address_edit')}}</a>
          </li>
          @endcan
          @can('deliveryAddresses.destroy')
          <li class="nav-item">
            {!! Form::open(['route' => ['deliveryAddresses.destroy', $deliveryAddress->id], 'method' => 'delete']) !!}
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
        @include('delivery_addresses.show_fields')

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
