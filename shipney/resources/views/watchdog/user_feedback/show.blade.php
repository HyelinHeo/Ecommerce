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
          <li class="breadcrumb-item"><a href="{!! url()->previous() !!}">{{trans('lang.user_feedback_plural')}}</a>
          </li>
          <li class="breadcrumb-item active">{{trans('lang.user_feedback')}}</li>
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
          <a class="nav-link" href="{!! route('watchdogUserFeedback.index') !!}"><i class="fa fa-list mr-2"></i>{{trans('lang.user_feedback_table')}}</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{!! route('watchdogUserFeedback.error') !!}"><i class="fa fa-list mr-2"></i>{{trans('lang.user_feedback_table_error')}}</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{!! route('watchdogUserFeedback.opinion') !!}"><i class="fa fa-list mr-2"></i>{{trans('lang.user_feedback_table_opinion')}}</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{!! route('watchdogUserFeedback.proposal') !!}"><i class="fa fa-list mr-2"></i>{{trans('lang.user_feedback_table_proposal')}}</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{!! route('watchdogUserFeedback.translation') !!}"><i class="fa fa-list mr-2"></i>{{trans('lang.user_feedback_table_translation')}}</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{!! route('watchdogUserFeedback.withdrawal') !!}"><i class="fa fa-list mr-2"></i>{{trans('lang.user_feedback_table_withdrawal')}}</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{!! route('watchdogUserFeedback.duplicateReport') !!}"><i class="fa fa-list mr-2"></i>{{trans('lang.user_feedback_table_duplicate_email_report')}}</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{!! route('watchdogUserFeedback.others') !!}"><i class="fa fa-list mr-2"></i>{{trans('lang.user_feedback_table_others')}}</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="{!! url()->current() !!}"><i class="fa fa-plus mr-2"></i>{{trans('lang.user_feedback')}}</a>
        </li>
        <div class="ml-auto d-inline-flex">
          @if($userFeedback->done!=1)
          <li class="nav-item">
            {!! Form::open(['route' => ['watchdogUserFeedback.done', $userFeedback->id], 'method' => 'get']) !!}
              {!! Form::button('<i class="fa fa-check">Done</i>', [
              'type' => 'submit',
              'class' => 'btn btn-link text-blue',
              'onclick' => "return confirm('Are you sure?')"
              ]) !!}
            {!! Form::close() !!}
          </li>
          @endif
          @can('watchdogUserFeedback.edit')
          <li class="nav-item">
            <a class="nav-link pt-1" href="{{ route('watchdogUserFeedback.edit', $userFeedback->id) }}"><i class="fa fa-edit"></i> {{trans('lang.user_feedback_edit')}}</a>
          </li>
          @endcan
          @can('watchdogUserFeedback.destroy')
          <li class="nav-item">
            {!! Form::open(['route' => ['watchdogUserFeedback.destroy', $userFeedback->id], 'method' => 'delete']) !!}
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
        @include('watchdog.user_feedback.show_fields')
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
    $("#printOrders").on("click",function () {
      window.print();
    });
  </script>
@endpush
