<!-- Id Field -->
<div class="form-group row col-6">
  {!! Form::label('id', trans('lang.faq_category_id').' :', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $faqCategory->id !!}</p>
  </div>
</div>

<!-- Code Field -->
<div class="form-group row col-6">
  {!! Form::label('code', trans('lang.faq_category_code').' :', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $faqCategory->code !!}</p>
  </div>
</div>

<!-- enum_value Field -->
<div class="form-group row col-6">
  {!! Form::label('enum_value', trans('lang.faq_category_enum_value').' :', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $faqCategory->enum_value !!}</p>
  </div>
</div>

<!-- Name Field -->
<div class="form-group row col-6">
  {!! Form::label('name', trans('lang.faq_category_name').' :', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $faqCategory->name !!}</p>
  </div>
</div>

<!-- Nation Field -->
<div class="form-group row col-6">
  {!! Form::label('nation', trans('lang.faq_category_nation').' :', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $faqCategory->nation !!}</p>
  </div>
</div>

<!-- Language Field -->
<div class="form-group row col-6">
  {!! Form::label('language', trans('lang.faq_category_language').' :', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $faqCategory->language !!}</p>
  </div>
</div>

<!-- Created At Field -->
<div class="form-group row col-6">
  {!! Form::label('created_at', trans('lang.faq_category_created_at').' :', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $faqCategory->created_at !!}</p>
  </div>
</div>

<!-- Updated At Field -->
<div class="form-group row col-6">
  {!! Form::label('updated_at', trans('lang.faq_category_updated_at').' :', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $faqCategory->updated_at !!}</p>
  </div>
</div>

