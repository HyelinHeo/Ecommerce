@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">{{trans('lang.user_feedback_plural')}}<small class="ml-3 mr-3">|</small><small>{{trans('lang.user_feedback_desc')}}</small></h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{url('/dashboard')}}"><i class="fa fa-dashboard"></i> {{trans('lang.dashboard')}}</a></li>
          <li class="breadcrumb-item"><a href="{!! route('watchdogUserFeedback.error') !!}">{{trans('lang.user_feedback_plural')}}</a>
          </li>
          <li class="breadcrumb-item active">{{trans('lang.user_feedback_table')}}</li>
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
          <a class="nav-link <?=strpos($_SERVER['REQUEST_URI'],'error')==false &&
                                strpos($_SERVER['REQUEST_URI'],'opinion')==false &&
                                strpos($_SERVER['REQUEST_URI'],'proposal')==false &&
                                strpos($_SERVER['REQUEST_URI'],'translation')==false &&
                                strpos($_SERVER['REQUEST_URI'],'withdrawal')==false &&
                                strpos($_SERVER['REQUEST_URI'],'duplicateReport')==false &&
                                strpos($_SERVER['REQUEST_URI'],'others')==false ? "active" : "" ?>" href="{!! route('watchdogUserFeedback.index') !!}"><i class="fa fa-list mr-2"></i>{{trans('lang.user_feedback_table')}}</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?=strpos($_SERVER['REQUEST_URI'],'error')!==false ? "active" : "" ?>" href="{!! route('watchdogUserFeedback.error') !!}"><i class="fa fa-list mr-2"></i>{{trans('lang.user_feedback_table_error')}}</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?=strpos($_SERVER['REQUEST_URI'],'opinion')!==false ? "active" : "" ?>" href="{!! route('watchdogUserFeedback.opinion') !!}"><i class="fa fa-list mr-2"></i>{{trans('lang.user_feedback_table_opinion')}}</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?=strpos($_SERVER['REQUEST_URI'],'proposal')!==false ? "active" : "" ?>" href="{!! route('watchdogUserFeedback.proposal') !!}"><i class="fa fa-list mr-2"></i>{{trans('lang.user_feedback_table_proposal')}}</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?=strpos($_SERVER['REQUEST_URI'],'translation')!==false ? "active" : "" ?>" href="{!! route('watchdogUserFeedback.translation') !!}"><i class="fa fa-list mr-2"></i>{{trans('lang.user_feedback_table_translation')}}</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?=strpos($_SERVER['REQUEST_URI'],'withdrawal')!==false ? "active" : "" ?>" href="{!! route('watchdogUserFeedback.withdrawal') !!}"><i class="fa fa-list mr-2"></i>{{trans('lang.user_feedback_table_withdrawal')}}</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?=strpos($_SERVER['REQUEST_URI'],'duplicateReport')!==false ? "active" : "" ?>" href="{!! route('watchdogUserFeedback.duplicateReport') !!}"><i class="fa fa-list mr-2"></i>{{trans('lang.user_feedback_table_duplicate_email_report')}}</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?=strpos($_SERVER['REQUEST_URI'],'others')!==false ? "active" : "" ?>" href="{!! route('watchdogUserFeedback.others') !!}"><i class="fa fa-list mr-2"></i>{{trans('lang.user_feedback_table_others')}}</a>
        </li>
        @can('watchdogUserFeedback.create')
        <li class="nav-item">
          <a class="nav-link" href="{!! route('watchdogUserFeedback.create') !!}"><i class="fa fa-plus mr-2"></i>{{trans('lang.user_feedback_create')}}</a>
        </li>
        @endcan
        @include('layouts.right_toolbar', compact('dataTable'))
      </ul>
    </div>
    <div class="card-body">
      @include('watchdog.user_feedback.table')
      <div class="clearfix"></div>
    </div>
  </div>
</div>
@endsection

