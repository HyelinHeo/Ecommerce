<!-- ID Field -->
<div class="form-group row col-6">
  {!! Form::label('id', trans('lang.event_id').':', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $event->id !!}</p>
  </div>
</div>

<!-- type Field -->
<div class="form-group row col-6">
  {!! Form::label('type', trans('lang.event_type').':', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    @if($event->type == 0)
    <p>{{ trans('lang.event_type_event') }}</p>
    @elseif($event->type == 1)
    <p>{{ trans('lang.event_type_coupon') }}</p>
    @endif
  </div>
</div>

<!-- image_thumb Field -->
<div class="form-group row col-6">
  {!! Form::label('image_thumb', trans('lang.event_image_thumb').':', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! getPhotoColumn($event,'image_thumb','','icon','200px') !!}</p>
  </div>
</div>

<!-- Image Field -->
<div class="form-group row col-6">
  {!! Form::label('image', trans('lang.event_image').':', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! getPhotoColumn($event,'image','','icon','200px') !!}</p>
  </div>
</div>

<!-- url Field -->
<!-- <div class="form-group row col-6">
  {!! Form::label('url', trans('lang.event_url').':', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $event->url !!}</p>
  </div>
</div> -->

<!-- nation Field -->
<div class="form-group row col-6">
  {!! Form::label('nation', trans('lang.event_nation').':', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $event->nation !!}</p>
  </div>
</div>

<!-- target nation Field -->
<div class="form-group row col-6">
  {!! Form::label('target_nation', trans('lang.event_target_nation').':', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $event->target_nation !!}</p>
  </div>
</div>

<!-- language Field -->
<div class="form-group row col-6">
  {!! Form::label('language', trans('lang.event_language').':', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $event->language !!}</p>
  </div>
</div>

<!-- discount Field -->
<div class="form-group row col-6">
  {!! Form::label('discount', trans('lang.event_discount').':', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $event->discount !!}</p>
  </div>
</div>

<!-- discount_type Field -->
<div class="form-group row col-6">
  {!! Form::label('discount_type', trans('lang.event_discount_type').':', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $event->discount_type !!}</p>
  </div>
</div>

<!-- max_price Field -->
<div class="form-group row col-6">
  {!! Form::label('max_price', trans('lang.event_max_price').':', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $event->max_price !!}</p>
  </div>
</div>

<!-- limit_use Field -->
<div class="form-group row col-6">
  {!! Form::label('limit_use', trans('lang.event_limit_use').':', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $event->limit_use !!}</p>
  </div>
</div>

<!-- start_date Field -->
<div class="form-group row col-6">
  {!! Form::label('start_date', trans('lang.event_start_date').':', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $event->start_date !!}</p>
  </div>
</div>

<!-- end_date Field -->
<div class="form-group row col-6">
  {!! Form::label('end_date', trans('lang.event_end_date').':', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $event->end_date !!}</p>
  </div>
</div>

<!-- title Field -->
<div class="form-group row col-6">
  {!! Form::label('title', trans('lang.event_title').':', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $event->title !!}</p>
  </div>
</div>

<!-- summary Field -->
<div class="form-group row col-6">
  {!! Form::label('summary', trans('lang.event_summary').':', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $event->summary !!}</p>
  </div>
</div>

<!-- dispHomeMode Field -->
<div class="form-group row col-6">
  {!! Form::label('dispHomeMode', trans('lang.event_dispHomeMode').':', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
  <p>{!! getDisplayHomeModeColumn($event,'dispHomeMode') !!}</p>
  </div>
</div>

<!-- content Field -->
<div class="form-group row col-6">
  {!! Form::label('content', trans('lang.event_content').':', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $event->content !!}</p>
  </div>
</div>

<!-- Created At Field -->
<div class="form-group row col-6">
  {!! Form::label('created_at', trans('lang.event_created_at').':', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $event->created_at !!}</p>
  </div>
</div>

<!-- Updated At Field -->
<div class="form-group row col-6">
  {!! Form::label('updated_at', trans('lang.event_updated_at').':', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $event->updated_at !!}</p>
  </div>
</div>

