<!-- Nation Field -->
<div class="form-group row col-6">
  {!! Form::label('nation', trans('lang.country_news_nation').' :', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $countryNews->nation !!}</p>
  </div>
</div>

<!-- Language Field -->
<div class="form-group row col-6">
  {!! Form::label('language', trans('lang.country_news_language').' :', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $countryNews->language !!}</p>
  </div>
</div>

<!-- title Field -->
<div class="form-group row col-6">
  {!! Form::label('title', trans('lang.country_news_title').' :', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $countryNews->title !!}</p>
  </div>
</div>

<!-- sub_title Field -->
<div class="form-group row col-6">
  {!! Form::label('sub_title', trans('lang.country_news_sub_title').' :', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $countryNews->sub_title !!}</p>
  </div>
</div>

<!-- Content Field -->
<div class="form-group row col-6">
  {!! Form::label('content', trans('lang.country_news_content').' :', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $countryNews->content !!}</p>
  </div>
</div>

<!-- writer Field -->
<div class="form-group row col-6">
  {!! Form::label('writer', trans('lang.country_news_writer').' :', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $countryNews->writer !!}</p>
  </div>
</div>

<!-- Created At Field -->
<div class="form-group row col-6">
  {!! Form::label('created_at', trans('lang.country_news_created_at').' :', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $countryNews->created_at !!}</p>
  </div>
</div>

<!-- Updated At Field -->
<div class="form-group row col-6">
  {!! Form::label('updated_at', trans('lang.country_news_updated_at').' :', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $countryNews->updated_at !!}</p>
  </div>
</div>

