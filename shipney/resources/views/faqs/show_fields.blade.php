<!-- Id Field -->
<div class="form-group row col-6">
  {!! Form::label('id', trans('lang.faq_id').' :', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $faq->id !!}</p>
  </div>
</div>

<!-- Faq Category Code Field -->
<div class="form-group row col-6">
  {!! Form::label('faq_category_code',  trans('lang.faq_faq_category_code').' :', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $faq->faq_category_code !!}</p>
  </div>
</div>

<!-- Nation Field -->
<div class="form-group row col-6">
  {!! Form::label('nation', trans('lang.faq_nation').' :', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $faq->nation !!}</p>
  </div>
</div>

<!-- Language Field -->
<div class="form-group row col-6">
  {!! Form::label('language', trans('lang.faq_language').' :', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $faq->language !!}</p>
  </div>
</div>

<!-- Question Field -->
<div class="form-group row col-6">
  {!! Form::label('question', trans('lang.faq_question').' :', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $faq->question !!}</p>
  </div>
</div>

<!-- Answer Field -->
<div class="form-group row col-6">
  {!! Form::label('answer', trans('lang.faq_answer').' :', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $faq->answer !!}</p>
  </div>
</div>

<!-- Created At Field -->
<div class="form-group row col-6">
  {!! Form::label('created_at', trans('lang.faq_created_at').' :', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $faq->created_at !!}</p>
  </div>
</div>

<!-- Updated At Field -->
<div class="form-group row col-6">
  {!! Form::label('updated_at', trans('lang.faq_updated_at').' :', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $faq->updated_at !!}</p>
  </div>
</div>

