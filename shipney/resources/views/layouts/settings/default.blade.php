@extends('layouts.app')

@section('content')

<?php 
    
    $request_uri = $_SERVER['REQUEST_URI'];
    $isUserPage=(strpos($request_uri,"users"))?false:true;
?>
<!-- Content Header (Page header) -->
<div class="content-header content-header{{setting('fixed_header')}}">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">
                <!-- {{trans('lang.setting')}}<small>{{trans('lang.setting_desc')}} -->
                @if($isUserPage)
                {{trans('lang.users')}}
                @else
                {{trans('lang.setting')}}
                @endif
                 <small>
                 @if($isUserPage)
                 {{trans('lang.users_desc')}}
                 @else
                 {{trans('lang.setting_desc')}}
                 @endif 
                 </small>
                 </h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> {{trans('lang.dashboard')}}</a></li>
                    <li class="breadcrumb-item active">@yield('settings_title')</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<div class="content">
    <div class="clearfix"></div>
    @include('flash::message')
    <div class="clearfix"></div>
    <div class="row">
        @if($isUserPage)
        <div class="col-md-3">
            @include('layouts.settings.menu')
        </div>
        <div class="col-md-9">
            @yield('settings_content')
        </div>
        @else
        <div class="col-md-12">
            @yield('settings_content')
        </div>
        @endif
    </div>
</div>
@endsection
