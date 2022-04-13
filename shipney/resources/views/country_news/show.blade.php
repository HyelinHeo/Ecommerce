@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">{{trans('lang.country_news_plural')}}<small class="ml-3 mr-3">|</small><small>{{trans('lang.country_news_desc')}}</small></h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> {{trans('lang.dashboard')}}</a></li>
          <li class="breadcrumb-itema ctive"><a href="{!! route('countryNews.index') !!}">{{trans('lang.country_news_plural')}}</a>
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
          <a class="nav-link" href="{!! route('countryNews.index') !!}"><i class="fa fa-list mr-2"></i>{{trans('lang.country_news_table')}}</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="{!! route('countryNews.create') !!}"><i class="fa fa-plus mr-2"></i>{{trans('lang.country_news_create')}}</a>
        </li>
        <div class="ml-auto d-inline-flex">
          @can('countryNews.edit')
          <li class="nav-item">
            <a class="nav-link pt-1" href="{{ route('countryNews.edit', $countryNews->id) }}"><i class="fa fa-edit"></i> {{trans('lang.country_news_edit')}}</a>
          </li>
          @endcan
          @can('countryNews.destroy')
          <li class="nav-item">
            {!! Form::open(['route' => ['countryNews.destroy', $countryNews->id], 'method' => 'delete']) !!}
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
        @include('country_news.show_fields')

        <!-- Back Field -->
        <div class="form-group col-12 text-right">
          <a href="{!! route('countryNews.index') !!}" class="btn btn-default"><i class="fa fa-undo"></i> {{trans('lang.back')}}</a>
        </div>
      </div>
      <div class="clearfix"></div>
    </div>
  </div>
</div>
@endsection
