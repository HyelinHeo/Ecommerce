@extends('layouts.app')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
@push('css_lib')
<!-- tab-content -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<!-- iCheck -->
<link rel="stylesheet" href="{{asset('plugins/iCheck/flat/blue.css')}}">
<!-- select2 -->
<link rel="stylesheet" href="{{asset('plugins/select2/select2.min.css')}}">
<!-- bootstrap wysihtml5 - text editor -->
<link rel="stylesheet" href="{{asset('plugins/summernote/summernote-bs4.css')}}">
{{--dropzone--}}
<link rel="stylesheet" href="{{asset('plugins/dropzone/bootstrap.min.css')}}">
@endpush
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">{{trans('lang.notification_plural')}}<small class="ml-3 mr-3">|</small><small>{{trans('lang.notification_desc')}}</small></h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{url('/dashboard')}}"><i class="fa fa-dashboard"></i> {{trans('lang.dashboard')}}</a></li>
          <li class="breadcrumb-item"><a href="{!! route('notifications.index') !!}">{{trans('lang.notification_plural')}}</a>
          </li>
          <li class="breadcrumb-item active">{{trans('lang.notification_create')}}</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<div class="content">
  <div class="clearfix"></div>
  @include('flash::message')
  @include('adminlte-templates::common.errors')
  <div class="clearfix"></div>
  {!! Form::open(['route' => 'notifications.store']) !!}
  <div class="row">
    <div class="col-md-4">
      <?php
        $arrys = config('app.notification');
      ?>
      @include('layouts.notification.default')
    </div>
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">
          <ul class="nav nav-tabs align-items-end card-header-tabs w-100" role="tablist">
            <li class="nav-item">
              @if(strpos($_SERVER['REQUEST_URI'],'user')!==false)
              <a class="nav-link active" href="#"><i class="fa fa-list mr-2"></i>{{trans('lang.user_list')}}</a>
              @elseif(strpos($_SERVER['REQUEST_URI'],'order')!==false)
              <a class="nav-link active" href="#"><i class="fa fa-list mr-2"></i>{{trans('lang.order_list')}}</a>
              @endif
            </li>
          </ul>
        </div>
        <div class="card-body tab-content">
            @include('notifications.table')
          <!-- Submit Field -->
          <div class="form-group mt-4 col-12 text-left" id="select_user">

          </div>
          <div class="form-group mt-4 col-12 text-right">
            <button type="submit" class="btn btn-{{setting('theme_color')}}"><i class="fa fa-save"></i> {{trans('lang.save')}} {{trans('lang.notification')}}
            </button>
            <a href="{!! url()->previous() !!}" class="btn btn-default"><i class="fa fa-undo"></i> {{trans('lang.cancel')}}</a>
          </div>
          <div class="clearfix"></div>
        </div>
      </div>
    </div>
  </div>
  {!! Form::close() !!}
  <div class="clearfix"></div>
</div>
<script>
  function selectUserList(e){
    if(document.getElementById('select_all')){
      alert('모든 사용자를 추가하였습니다.');
      return;
    }
    if(document.getElementById('select_'+$(e).attr('id'))){
      alert('추가한 사용자입니다.');
      return;
    }
    if($(e).attr('value')=='all'){
      var selection = document.getElementById("select_user"); 
      while ( selection.hasChildNodes() ) {
        selection.removeChild( selection.firstChild ); 
        }
      $('#select_user').append("<p class='select' id='select_"+$(e).attr('value')+"' onClick='deleteUser(this)'>"+$(e).attr('data-extra')+"<input type='hidden' name='all' value="+$(e).attr('value')+"><i class='fa fa-close'></i></p>");
    }else{
      $('#select_user').append("<p class='select' id='select_"+$(e).attr('value')+"' onClick='deleteUser(this)'>"+$(e).attr('data-extra')+"<input type='hidden' name='users[]' value="+$(e).attr('value')+"><i class='fa fa-close'></i></p>");
    }
    // if($('input:radio[id=users]').is(':checked')){
        
    // }else{
    //     $('#divId').show();
    // }
  }

  function deleteUser(e){
    console.log($(e).attr('id'));
    const select = document.getElementById($(e).attr('id'));
    select.remove();
  }
</script>
@endsection
@push('scripts_lib')
<!-- iCheck -->
<script src="{{asset('plugins/iCheck/icheck.min.js')}}"></script>
<!-- select2 -->
<script src="{{asset('plugins/select2/select2.min.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('plugins/summernote/summernote-bs4.min.js')}}"></script>
{{--dropzone--}}
<script src="{{asset('plugins/dropzone/dropzone.js')}}"></script>
<script type="text/javascript">
    Dropzone.autoDiscover = false;
    var dropzoneFields = [];
</script>
@endpush