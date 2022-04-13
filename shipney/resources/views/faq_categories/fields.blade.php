@if($customFields)
<h5 class="col-12 pb-4">{!! trans('lang.main_fields') !!}</h5>
@endif
<div style="flex: 50%;max-width: 50%;padding: 0 4px;" class="column">
  <!-- Code Field -->
  <div class="form-group row ">
    {!! Form::label('code', trans("lang.faq_category_code"), ['class' => 'col-3 control-label text-right']) !!}
    <div class="col-9">
      {!! Form::text('code', null,  ['class' => 'form-control','placeholder'=>  trans("lang.faq_category_code_placeholder")]) !!}
      <div class="form-text text-muted">
        {{ trans("lang.faq_category_code_help") }}
      </div>
    </div>
  </div>
  <!-- Enum Value Field -->
  <div class="form-group row ">
    {!! Form::label('enum_value', trans("lang.faq_category_enum_value"), ['class' => 'col-3 control-label text-right']) !!}
    <div class="col-9">
      {!! Form::text('enum_value', null,  ['class' => 'form-control','placeholder'=>  trans("lang.faq_category_enum_value_placeholder")]) !!}
      <div class="form-text text-muted">
        {{ trans("lang.faq_category_enum_value_help") }}
      </div>
    </div>
  </div>
  <!-- Name Field -->
  <div class="form-group row ">
    {!! Form::label('name', trans("lang.faq_category_name"), ['class' => 'col-3 control-label text-right']) !!}
    <div class="col-9">
      {!! Form::text('name', null,  ['class' => 'form-control','placeholder'=>  trans("lang.faq_category_name_placeholder")]) !!}
      <div class="form-text text-muted">
        {{ trans("lang.faq_category_name_help") }}
      </div>
    </div>
  </div>
</div>
<div style="flex: 50%;max-width: 50%;padding: 0 4px;" class="column">
  <!-- Nation Field -->
  <div class="form-group row ">
    {!! Form::label('nation', trans("lang.faq_category_nation"), ['class' => 'col-3 control-label text-right']) !!}
    <div class="col-9">
      {!! Form::text('nation', null,  ['class' => 'form-control','placeholder'=>  trans("lang.faq_category_nation_placeholder")]) !!}
      <div class="form-text text-muted">
        {{ trans("lang.faq_category_nation_help") }}
      </div>
    </div>
  </div>
  <!-- Language Field -->
  <div class="form-group row ">
    {!! Form::label('language', trans("lang.faq_category_language"), ['class' => 'col-3 control-label text-right']) !!}
    <div class="col-9">
      {!! Form::text('language', null,  ['class' => 'form-control','placeholder'=>  trans("lang.faq_category_language_placeholder")]) !!}
      <div class="form-text text-muted">
        {{ trans("lang.faq_category_language_help") }}
      </div>
    </div>
  </div>
</div>
@if($customFields)
<div class="clearfix"></div>
<div class="col-12 custom-field-container">
  <h5 class="col-12 pb-4">{!! trans('lang.custom_field_plural') !!}</h5>
  {!! $customFields !!}
</div>
@endif
<!-- Submit Field -->
<div class="form-group col-12 text-right">
  <button type="submit" class="btn btn-{{setting('theme_color')}}" ><i class="fa fa-save"></i> {{trans('lang.save')}} {{trans('lang.faq_category')}}</button>
  <a href="{!! url()->previous() !!}" class="btn btn-default"><i class="fa fa-undo"></i> {{trans('lang.cancel')}}</a>
</div>
