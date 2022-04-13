<div style="flex: 50%;max-width: 50%;padding: 0 4px;" class="column">

<!-- Title Field -->
<div class="form-group row ">
  {!! Form::label('title', trans("lang.country_news_title"), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    {!! Form::text('title', null, ['class' => 'form-control','placeholder'=>
     trans("lang.country_news_title_placeholder")  ]) !!}
    <div class="form-text text-muted">{{ trans("lang.country_news_title_help") }}</div>
  </div>
</div>

<!-- Sub Title Field -->
<div class="form-group row ">
  {!! Form::label('sub_title', trans("lang.country_news_sub_title"), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    {!! Form::textarea('sub_title', null, ['class' => 'form-control','placeholder'=>
     trans("lang.country_news_sub_title_placeholder")  ]) !!}
    <div class="form-text text-muted">{{ trans("lang.country_news_sub_title_help") }}</div>
  </div>
</div>
</div>
<div style="flex: 50%;max-width: 50%;padding: 0 4px;" class="column">

<!-- Nation Field -->
<div class="form-group row ">
  {!! Form::label('nation', trans("lang.country_news_nation"), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    {!! Form::text('nation', null,  ['class' => 'form-control','placeholder'=>  trans("lang.country_news_nation_placeholder")]) !!}
    <div class="form-text text-muted">
      {{ trans("lang.country_news_nation_help") }}
    </div>
  </div>
</div>

<!-- Language Field -->
<div class="form-group row ">
  {!! Form::label('language', trans("lang.country_news_language"), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    {!! Form::text('language', null,  ['class' => 'form-control','placeholder'=>  trans("lang.country_news_language_placeholder")]) !!}
    <div class="form-text text-muted">
      {{ trans("lang.country_news_language_help") }}
    </div>
  </div>
</div>

<!-- content Field -->
<div class="form-group row ">
  {!! Form::label('content', trans("lang.country_news_content"), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    {!! Form::textarea('content', null, ['class' => 'form-control','placeholder'=>
     trans("lang.country_news_content_placeholder")  ]) !!}
    <div class="form-text text-muted">{{ trans("lang.country_news_content_help") }}</div>
  </div>
</div>

</div>
<!-- Submit Field -->
<div class="form-group col-12 text-right">
  <button type="submit" class="btn btn-{{setting('theme_color')}}" ><i class="fa fa-save"></i> {{trans('lang.save')}} {{trans('lang.country_news')}}</button>
  <a href="{!! url()->previous() !!}" class="btn btn-default"><i class="fa fa-undo"></i> {{trans('lang.cancel')}}</a>
</div>
