<!-- Nation Field -->
<div class="form-group row col-6">
  {!! Form::label('nation', trans('lang.notice_nation').' :', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $notice->nation !!}</p>
  </div>
</div>

<!-- Language Field -->
<div class="form-group row col-6">
  {!! Form::label('language', trans('lang.notice_language').' :', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $notice->language !!}</p>
  </div>
</div>

<!-- title Field -->
<div class="form-group row col-6">
  {!! Form::label('title', trans('lang.notice_title').' :', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $notice->title !!}</p>
  </div>
</div>

<!-- Content Field -->
<div class="form-group row col-6">
  {!! Form::label('content', trans('lang.notice_content').' :', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $notice->content !!}</p>
  </div>
</div>

<!-- disptop Field -->
<div class="form-group row col-6">
  {!! Form::label('disptop', trans('lang.notice_disptop').' :', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $notice->disptop !!}</p>
  </div>
</div>

<!-- disptop_order Field -->
<div class="form-group row col-6">
  {!! Form::label('disptop_order', trans('lang.notice_disptop_order').' :', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $notice->disptop_order !!}</p>
  </div>
</div>

<!-- active Field -->
<div class="form-group row col-6">
  {!! Form::label('active', trans('lang.notice_active').' :', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! getBoolean($notice->active) !!}</p>
  </div>
</div>

<!-- dispHomeMode Field -->
<div class="form-group row col-6">
  {!! Form::label('dispHomeMode', trans('lang.notice_dispHomeMode').' :', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! getDisplayHomeModeColumn($notice,'dispHomeMode') !!}</p>
  </div>
</div>

<!-- Created At Field -->
<div class="form-group row col-6">
  {!! Form::label('created_at', trans('lang.notice_created_at').' :', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $notice->created_at !!}</p>
  </div>
</div>

<!-- Updated At Field -->
<div class="form-group row col-6">
  {!! Form::label('updated_at', trans('lang.notice_updated_at').' :', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $notice->updated_at !!}</p>
  </div>
</div>

