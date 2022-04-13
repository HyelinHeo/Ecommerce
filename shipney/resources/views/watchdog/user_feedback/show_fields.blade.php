<!-- Id Field -->
<div class="form-group row col-md-6 col-sm-12">
    @if(isset($userFeedback->user))
    {!! Form::label('user_feedback_user', trans('lang.user_feedback_user'), ['class' => 'col-4 control-label']) !!}
    <div class="col-8">
      <p>{!! $userFeedback->user->name !!}</p>
    </div>
    @endif

    {!! Form::label('email', trans('lang.user_feedback_email'), ['class' => 'col-4 control-label']) !!}
    <div class="col-8">
      <p>{!! $userFeedback->email !!}</p>
    </div>

    {!! Form::label('phone', trans('lang.user_feedback_phone'), ['class' => 'col-4 control-label']) !!}
    <div class="col-8">
      <p>{!! $userFeedback->phone  !!}</p>
    </div>

    {!! Form::label('data', trans('lang.user_feedback_data'), ['class' => 'col-4 control-label']) !!}
    <div class="col-8">
      <p>{!! $userFeedback->data  !!}</p>
    </div>

    {!! Form::label('content', trans('lang.user_feedback_content'), ['class' => 'col-4 control-label']) !!}
    <div class="col-8">
      <p>{!! $userFeedback->content  !!}</p>
    </div>

    {!! Form::label('done', trans('lang.user_feedback_done'), ['class' => 'col-4 control-label']) !!}
    <div class="col-8">
      {!! getDoneColumn($userFeedback,'done') !!}
    </div>

    {!! Form::label('comment', trans('lang.user_feedback_comment'), ['class' => 'col-4 control-label']) !!}
    <div class="col-8">
      <p>{!! $userFeedback->comment  !!}</p>
    </div>

    {!! Form::label('created_at', trans('lang.user_feedback_created_at'), ['class' => 'col-4 control-label']) !!}
    <div class="col-8">
      <p>{!! $userFeedback->created_at  !!}</p>
    </div>

    {!! Form::label('updated_at', trans('lang.user_feedback_updated_at'), ['class' => 'col-4 control-label']) !!}
    <div class="col-8">
      <p>{!! $userFeedback->updated_at  !!}</p>
    </div>

</div>

