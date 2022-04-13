
<div class="content">
  <div class="clearfix"></div>
  <div class="card">
    <div class="card-body">
      <div class="form-group">
        @foreach($arrys as $arr)
        <div class="radiobox">
          <label class="form-check-list">
            {!! Form::radio('type', $arr, ($arr == 'ocs' ? true : false)) !!}
            <span class="ml-2">{!! trans('lang.notification_'.$arr) !!}</span>
          </label>
        </div>
        @endforeach
      </div>
    </div>
  </div>
  <div class="clearfix"></div>
  <div class="card">
    <div class="card-body">
      <!-- Title Field -->
      <div class="form-group row ">
        {!! Form::label('title', trans("lang.notification_title"), ['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
          {!! Form::text('title', null,  ['class' => 'form-control','placeholder'=>  trans("lang.notification_title_placeholder")]) !!}
          <div class="form-text text-muted">
            {{ trans("lang.notification_title_help") }}
          </div>
        </div>
      </div>
      <!-- ID Field -->
      <div class="form-group row ">
        {!! Form::label('common_id', trans("lang.notification_id"), ['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
          {!! Form::number('common_id', null,  ['class' => 'form-control','placeholder'=>  trans("lang.notification_id_placeholder")]) !!}
          <div class="form-text text-muted">
            {{ trans("lang.notification_id_help") }}
          </div>
        </div>
      </div>
      <!-- Image Field -->
      <div class="form-group row ">
        {!! Form::label('image', trans("lang.notification_image"), ['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
          {!! Form::text('image', null,  ['class' => 'form-control','placeholder'=>  trans("lang.notification_image_placeholder")]) !!}
          <div class="form-text text-muted">
            {{ trans("lang.notification_image_help") }}
          </div>
        </div>
      </div>
      <!-- Body Field -->
      <div class="form-group row ">
        {!! Form::label('body', trans("lang.notification_body"), ['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
          {!! Form::textarea('body', null,  ['class' => 'form-control','placeholder'=>  trans("lang.notification_body_placeholder")]) !!}
          <div class="form-text text-muted">
            {{ trans("lang.notification_body_help") }}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>