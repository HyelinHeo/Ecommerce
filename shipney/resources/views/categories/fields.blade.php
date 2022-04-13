@if($customFields)
<h5 class="col-12 pb-4">{!! trans('lang.main_fields') !!}</h5>
@endif
<div style="flex: 50%;max-width: 50%;padding: 0 4px;" class="column">
<!-- Name Field -->
<div class="form-group row ">
  {!! Form::label('name', trans("lang.category_name"), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    {!! Form::text('name', null,  ['class' => 'form-control','placeholder'=>  trans("lang.category_name_placeholder")]) !!}
    <div class="form-text text-muted">
      {{ trans("lang.category_name_help") }}
    </div>
  </div>
</div>

<!-- nation Field -->
<div class="form-group row ">
  {!! Form::label('nation', trans("lang.category_nation"), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    {!! Form::text('nation', null,  ['class' => 'form-control','placeholder'=>  trans("lang.category_nation_placeholder")]) !!}
    <div class="form-text text-muted">
      {{ trans("lang.category_nation_help") }}
    </div>
  </div>
</div>

<!-- Code Field -->
<div class="form-group row ">
  {!! Form::label('code', trans("lang.category_code"), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    {!! Form::text('code', null,  ['class' => 'form-control','placeholder'=>  trans("lang.category_code_placeholder")]) !!}
    <div class="form-text text-muted">
      {{ trans("lang.category_code_help") }}
    </div>
  </div>
</div>

</div>
<div style="flex: 50%;max-width: 50%;padding: 0 4px;" class="column">

<!-- name_eng Field -->
<div class="form-group row ">
  {!! Form::label('name_eng', trans("lang.category_name_eng"), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    {!! Form::text('name_eng', null,  ['class' => 'form-control','placeholder'=>  trans("lang.category_name_eng_placeholder")]) !!}
    <div class="form-text text-muted">
      {{ trans("lang.category_name_eng_help") }}
    </div>
  </div>
</div>

<!-- language Field -->
<div class="form-group row ">
  {!! Form::label('language', trans("lang.category_language"), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    {!! Form::text('language', null,  ['class' => 'form-control','placeholder'=>  trans("lang.category_language_placeholder")]) !!}
    <div class="form-text text-muted">
      {{ trans("lang.category_language_help") }}
    </div>
  </div>
</div>

<!-- need_input Field -->
<div class="form-group row ">
  {!! Form::label('need_input', trans("lang.category_need_input"), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
      {!! Form::hidden('need_input', 0) !!}
      {!! Form::checkbox('need_input', 1, null) !!}
    <div class="form-text text-muted">
      {{ trans("lang.category_need_input_help") }}
    </div>
  </div>
</div>

</div>
<!-- Submit Field -->
<div class="form-group col-12 text-right">
  <button type="submit" class="btn btn-{{setting('theme_color')}}" ><i class="fa fa-save"></i> {{trans('lang.save')}} {{trans('lang.category')}}</button>
  <a href="{!! url()->previous() !!}" class="btn btn-default"><i class="fa fa-undo"></i> {{trans('lang.cancel')}}</a>
</div>
