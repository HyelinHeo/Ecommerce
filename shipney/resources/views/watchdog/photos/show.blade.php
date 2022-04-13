@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">{{trans('lang.watchdog_photos_plural')}}<small class="ml-3 mr-3">|</small><small>{{trans('lang.watchdog_photos_desc')}}</small></h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{url('/dashboard')}}"><i class="fa fa-dashboard"></i> {{trans('lang.dashboard')}}</a></li>
          <li class="breadcrumb-item"><a href="{!! route('watchdogPhotos.index') !!}">{{trans('lang.watchdog_photos_plural')}}</a>
          </li>
          <li class="breadcrumb-item active">{{trans('lang.watchdog_photos')}}</li>
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
          <a class="nav-link" href="{!! route('watchdogPhotos.index') !!}"><i class="fa fa-list mr-2"></i>{{trans('lang.watchdog_photos_table')}}</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="{!! url()->current() !!}"><i class="fa fa-plus mr-2"></i>{{trans('lang.watchdog_photos')}}</a>
        </li>
        <div class="ml-auto d-inline-flex">
          <li class="nav-item">
            <a class="nav-link pt-1" href="{!! route('orders.show', $order->id) !!}"><i class="fa fa-info-circle"></i> {{trans('lang.detail')}}</a>
          </li>
          @can('watchdogPhotos.edit')
          <li class="nav-item">
            <a class="nav-link pt-1" href="{{ route('watchdogPhotos.edit', $order->id) }}"><i class="fa fa-edit"></i> {{trans('lang.watchdog_photos_edit')}}</a>
          </li>
          @endcan
          @can('watchdogPhotos.destroy')
          <li class="nav-item">
            {!! Form::open(['route' => ['watchdogPhotos.destroy', $order->id], 'method' => 'delete']) !!}
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
        @include('watchdog.photos.show_fields')
      </div>
      <div class="clearfix"></div>
      <div class="row d-print-none">
        <!-- Back Field -->
        <div class="form-group col-12 text-right">
          <a href="{!! route('watchdogPhotos.index') !!}" class="btn btn-default"><i class="fa fa-undo"></i> {{trans('lang.back')}}</a>
        </div>
      </div>
      <div class="clearfix"></div>
    </div>
  </div>
</div>
@endsection
