<div style="flex: 50%;max-width: 50%;padding: 0 4px;" class="column">

<!-- Title Field -->
<div class="form-group row ">
  {!! Form::label('title', trans("lang.notice_title"), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    {!! Form::textarea('title', null, ['class' => 'form-control','placeholder'=>
     trans("lang.notice_title_placeholder")  ]) !!}
    <div class="form-text text-muted">{{ trans("lang.notice_title_help") }}</div>
  </div>
</div>

<!-- content Field -->
<div class="form-group row ">
  {!! Form::label('content', trans("lang.notice_content"), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    {!! Form::textarea('content', null, ['class' => 'form-control','placeholder'=>
     trans("lang.notice_content_placeholder")  ]) !!}
    <div class="form-text text-muted">{{ trans("lang.notice_content_help") }}</div>
  </div>
</div>
</div>
<div style="flex: 50%;max-width: 50%;padding: 0 4px;" class="column">

<!-- Nation Field -->
<div class="form-group row ">
  {!! Form::label('nation', trans("lang.notice_nation"), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    {!! Form::text('nation', null,  ['class' => 'form-control','placeholder'=>  trans("lang.notice_nation_placeholder")]) !!}
    <div class="form-text text-muted">
      {{ trans("lang.notice_nation_help") }}
    </div>
  </div>
</div>

<!-- Language Field -->
<div class="form-group row ">
  {!! Form::label('language', trans("lang.notice_language"), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    {!! Form::text('language', null,  ['class' => 'form-control','placeholder'=>  trans("lang.notice_language_placeholder")]) !!}
    <div class="form-text text-muted">
      {{ trans("lang.notice_language_help") }}
    </div>
  </div>
</div>

<!-- display on top Field -->
<div class="form-group row ">
    {!! Form::label('disptop', trans("lang.notice_disptop"),['class' => 'col-3 control-label text-right']) !!}
    <div class="checkbox icheck">
        <label class="col-9 ml-2 form-check-inline">
            {!! Form::hidden('disptop', 0) !!}
            {!! Form::checkbox('disptop', 1, null) !!}
        </label>
    </div>
</div>

<!-- display on top order Field -->
<div class="form-group row ">
    {!! Form::label('disptop_order', trans("lang.notice_disptop_order"),['class' => 'col-3 control-label text-right']) !!}
    <div class="checkbox icheck">
        <label class="col-9 ml-2 form-check-inline">
            {!! Form::hidden('disptop_order', 0) !!}
            {!! Form::checkbox('disptop_order', 1, null) !!}
        </label>
    </div>
</div>

<!-- dispHomeMode Field -->
<div class="form-group row ">
  <?php
    if(isset($notice)){
      $binary = sprintf("%03b",$notice['dispHomeMode']);
      $str=str_split($binary);
      $notice['dispHomeMode_top'] = $str[0];
      $notice['dispHomeMode_mid'] = $str[1];
      $notice['dispHomeMode_bottom'] = $str[2];
    }
  ?>
    {!! Form::label('dispHomeMode', trans("lang.notice_dispHomeMode"),['class' => 'col-3 control-label text-right']) !!}
    <div class="checkbox icheck">
        {!! Form::hidden('dispHomeMode_top', 0) !!}
        <label class="col-12 ml-2 form-check-inline">
          {!! Form::hidden('dispHomeMode_mid', 0) !!}
          {!! Form::checkbox('dispHomeMode_mid', 1, null) !!}
            <span class="ml-2">{{ trans("lang.dispHomeMode_mid") }}</span>
        </label>
        {!! Form::hidden('dispHomeMode_bottom', 0) !!}
        <div class="form-text text-muted">{{ trans("lang.dispHomeMode_help") }}</div>
    </div>
</div>

</div>
<!-- Submit Field -->
<div class="form-group col-12 text-right">
  <button type="submit" class="btn btn-{{setting('theme_color')}}" ><i class="fa fa-save"></i> {{trans('lang.save')}} {{trans('lang.notice')}}</button>
  <a href="{!! url()->previous() !!}" class="btn btn-default"><i class="fa fa-undo"></i> {{trans('lang.cancel')}}</a>
</div>
