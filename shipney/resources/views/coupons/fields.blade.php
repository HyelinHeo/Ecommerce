<div style="flex: 50%;max-width: 50%;padding: 0 4px;" class="column">
<!-- Image Field -->
<!-- <div class="form-group row ">
  {!! Form::label('image', trans("lang.event_image"), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    {!! Form::text('image', null,  ['class' => 'form-control','placeholder'=>  trans("lang.event_image_placeholder")]) !!}
    <div class="form-text text-muted">
      {{ trans("lang.event_image_help") }}
    </div>
  </div>
</div> -->

<!-- image_uuid Field -->
<!-- <div class="form-group row ">
  {!! Form::label('image_uuid', trans("lang.event_image_uuid"), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    {!! Form::text('image_uuid', null,  ['class' => 'form-control','placeholder'=>  trans("lang.event_image_uuid_placeholder")]) !!}
    <div class="form-text text-muted">
      {{ trans("lang.event_image_uuid_help") }}
    </div>
  </div>
</div> -->

<!-- url Field -->
<!-- <div class="form-group row ">
  {!! Form::label('url', trans("lang.event_url"), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    {!! Form::text('url', null,  ['class' => 'form-control','placeholder'=>  trans("lang.event_url_placeholder")]) !!}
    <div class="form-text text-muted">
      {{ trans("lang.event_url_help") }}
    </div>
  </div>
</div> -->


<!-- type Field -->

{!! Form::hidden('type', 1) !!}
<!-- <div class="form-group row">
  {!! Form::label('type', trans("lang.event_type"), ['class' => 'col-3 control-label text-right']) !!}
  <div class="radiobox col-9">
    <label class="form-check-list">
      {!! Form::radio('type', 0, true) !!}
      <span class="ml-2">{!! trans('lang.event_type_event') !!}</span>
    </label>
    <label class="form-check-list">
      {!! Form::radio('type', 1, false) !!}
      <span class="ml-2">{!! trans('lang.event_type_coupon') !!}</span>
    </label>
  </div>
</div> -->

<!-- nation Field -->
<div class="form-group row">
  {!! Form::label('nation', trans("lang.event_nation"), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    {!! Form::text('nation', null,  ['class' => 'form-control','placeholder'=>  trans("lang.event_nation_placeholder")]) !!}
    <div class="form-text text-muted">
      {{ trans("lang.event_nation_help") }}
    </div>
  </div>
</div>

<!-- target nation Field -->
<div class="form-group row">
  {!! Form::label('target_nation', trans("lang.event_target_nation"), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    {!! Form::text('target_nation', null,  ['class' => 'form-control','placeholder'=>  trans("lang.event_target_nation_placeholder")]) !!}
    <div class="form-text text-muted">
      {{ trans("lang.event_target_nation_help") }}
    </div>
  </div>
</div>

<!-- language Field -->
<div class="form-group row ">
  {!! Form::label('language', trans("lang.event_language"), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    {!! Form::text('language', null,  ['class' => 'form-control','placeholder'=>  trans("lang.event_language_placeholder")]) !!}
    <div class="form-text text-muted">
      {{ trans("lang.event_language_help") }}
    </div>
  </div>
</div>

<!-- discount Field -->
<div class="form-group row ">
  {!! Form::label('discount', trans("lang.event_discount"), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    {!! Form::number('discount', null,  ['class' => 'form-control','placeholder'=>  trans("lang.event_discount_placeholder")]) !!}
    <div class="form-text text-muted">
      {{ trans("lang.event_discount_help") }}
    </div>
  </div>
</div>

<!-- discount_type Field -->
<div class="form-group row">
  {!! Form::label('discount_type', trans("lang.event_discount_type"), ['class' => 'col-3 control-label text-right']) !!}
  <div class="radiobox col-9">
    <label class="form-check-list">
      {!! Form::radio('discount_type', 'price', true) !!}
      <span class="ml-2">Price</span>
    </label>
    <label class="form-check-list">
      {!! Form::radio('discount_type', 'percent', false) !!}
      <span class="ml-2">Percent</span>
    </label>
  </div>
</div>

<!-- max_price Field -->
<div class="form-group row ">
  {!! Form::label('max_price', trans("lang.event_max_price"), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    {!! Form::number('max_price', null,  ['class' => 'form-control','placeholder'=>  trans("lang.event_max_price_placeholder")]) !!}
    <div class="form-text text-muted">
      {{ trans("lang.event_max_price_help") }}
    </div>
  </div>
</div>

<!-- limit_use Field -->
<div class="form-group row ">
  {!! Form::label('limit_use', trans("lang.event_limit_use"), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    {!! Form::number('limit_use', null,  ['class' => 'form-control','placeholder'=>  trans("lang.event_limit_use_placeholder")]) !!}
    <div class="form-text text-muted">
      {{ trans("lang.event_limit_use_help") }}
    </div>
  </div>
</div>

<!-- start_date Field -->
<div class="form-group row ">
  {!! Form::label('start_date', trans("lang.event_start_date"), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    @if(isset($coupon))
    {!! Form::date('start_date', date('Y-m-d', strtotime($coupon->start_date))) !!}
    @else
    {!! Form::date('start_date', \Carbon\Carbon::now()) !!}
    @endif
    <div class="form-text text-muted">
      {{ trans("lang.event_start_date_help") }}
    </div>
  </div>
</div>

<!-- end_date Field -->
<div class="form-group row ">
  {!! Form::label('end_date', trans("lang.event_end_date"), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    @if(isset($coupon))
    {!! Form::date('end_date', date('Y-m-d', strtotime($coupon->end_date))) !!}
    @else
    {!! Form::date('end_date', \Carbon\Carbon::now()) !!}
    @endif
    <div class="form-text text-muted">
      {{ trans("lang.event_end_date_help") }}
    </div>
  </div>
</div>

</div>
<div style="flex: 50%;max-width: 50%;padding: 0 4px;" class="column">

<!-- title Field -->
<div class="form-group row ">
  {!! Form::label('title', trans("lang.event_title"), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    {!! Form::text('title', null,  ['class' => 'form-control','placeholder'=>  trans("lang.event_title_placeholder")]) !!}
    <div class="form-text text-muted">
      {{ trans("lang.event_title_help") }}
    </div>
  </div>
</div>

<!-- summary Field -->
<div class="form-group row ">
  {!! Form::label('summary', trans("lang.event_summary"), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    {!! Form::textarea('summary', null, ['class' => 'form-control','placeholder'=>
     trans("lang.event_summary_placeholder")  ]) !!}
    <div class="form-text text-muted">{{ trans("lang.event_summary_help") }}</div>
  </div>
</div>

<!-- content Field -->
<div class="form-group row ">
  {!! Form::label('content', trans("lang.event_content"), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    {!! Form::textarea('content', null, ['class' => 'form-control','placeholder'=>
     trans("lang.event_content_placeholder")  ]) !!}
    <div class="form-text text-muted">{{ trans("lang.event_content_help") }}</div>
  </div>
</div>

</div>
<!-- Submit Field -->
<div class="form-group col-12 text-right">
  <button type="submit" class="btn btn-{{setting('theme_color')}}" ><i class="fa fa-save"></i> {{trans('lang.save')}} {{trans('lang.event')}}</button>
  <a href="{!! url()->previous() !!}" class="btn btn-default"><i class="fa fa-undo"></i> {{trans('lang.cancel')}}</a>
</div>
