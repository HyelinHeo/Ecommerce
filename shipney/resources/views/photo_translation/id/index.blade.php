@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">{{trans('lang.photo_translation_plural')}}<small class="ml-3 mr-3">|</small><small>{{trans('lang.photo_translation_desc')}}</small></h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{url('/dashboard')}}"><i class="fa fa-dashboard"></i> {{trans('lang.dashboard')}}</a></li>
          <li class="breadcrumb-item"><a href="{!! route('photoTranslationsID.index') !!}">{{trans('lang.photo_translation_plural')}}</a>
          </li>
          <li class="breadcrumb-item active">{{trans('lang.photo_translation_table')}}</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<div class="content">
  <div class="clearfix"></div>
  @include('flash::message')
  <div class="card">
    <div class="card-header">
      <ul class="nav nav-tabs align-items-end card-header-tabs w-100">
        <li class="nav-item">
          @if(strpos($_SERVER['REQUEST_URI'],'done')!==false)
          <a class="nav-link" href="{!! route('photoTranslationsID.index') !!}"><i class="fa fa-list mr-2"></i>{{trans('lang.photo_translation_table')}}</a>
          @else
          <a class="nav-link active" href="{!! route('photoTranslationsID.index') !!}"><i class="fa fa-list mr-2"></i>{{trans('lang.photo_translation_table')}}</a>
          @endif
        </li>
        @can('photoTranslationsID.done')
        <li class="nav-item">
          @if(strpos($_SERVER['REQUEST_URI'],'done')!==false)
          <a class="nav-link active" href="{!! route('photoTranslationsID.done') !!}"><i class="fa fa-list mr-2"></i>{{trans('lang.photo_translation_table_done')}}</a>
          @else
          <a class="nav-link" href="{!! route('photoTranslationsID.done') !!}"><i class="fa fa-list mr-2"></i>{{trans('lang.photo_translation_table_done')}}</a>
          @endif
        </li>
        @endcan
        @can('photoTranslationsID.create')
        <li class="nav-item">
          <a class="nav-link" href="{!! route('photoTranslationsID.create') !!}"><i class="fa fa-plus mr-2"></i>{{trans('lang.photo_translation_create')}}</a>
        </li>
        @endcan
        @include('layouts.right_toolbar', compact('dataTable'))
      </ul>
    </div>
    <div class="card-body">
      @include('photo_translation.id.table')
      <div class="clearfix"></div>
    </div>
  </div>
</div>
@endsection

