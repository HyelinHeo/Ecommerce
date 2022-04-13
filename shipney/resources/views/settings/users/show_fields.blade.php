<!-- Id Field -->
<div class="form-group row col-6">
  {!! Form::label('id', 'Id:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $user->id !!}</p>
  </div>
</div>

<!-- Name Field -->
<div class="form-group row col-6">
  {!! Form::label('name',  trans("lang.user_name"), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $user->name !!}</p>
  </div>
</div>

<!-- reg_type Field -->
<div class="form-group row col-6">
  {!! Form::label('reg_type',  trans("lang.user_reg_type"), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $user->reg_type !!}</p>
  </div>
</div>

<!-- sns_token Field -->
<div class="form-group row col-6">
  {!! Form::label('sns_token',  trans("lang.user_sns_token"), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $user->sns_token !!}</p>
  </div>
</div>

<!-- Email Field -->
<div class="form-group row col-6">
  {!! Form::label('email', trans("lang.user_email"), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $user->email !!}</p>
  </div>
</div>

<!-- Api Token Field -->
<div class="form-group row col-6">
  {!! Form::label('api_token', trans("lang.user_api_token"), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $user->api_token !!}</p>
  </div>
</div>

<!-- phone Field -->
<div class="form-group row col-6">
  {!! Form::label('phone', trans("lang.user_phone"), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $user->phone !!}</p>
  </div>
</div>

<!-- country_code Field -->
<div class="form-group row col-6">
  {!! Form::label('country_code', trans("lang.user_country_code"), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $user->country_code !!}</p>
  </div>
</div>

<!-- country_digit Field -->
<div class="form-group row col-6">
  {!! Form::label('country_digit', trans("lang.user_country_digit"), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $user->country_digit !!}</p>
  </div>
</div>

<!-- language_code Field -->
<div class="form-group row col-6">
  {!! Form::label('language_code', trans("lang.user_language_code"), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $user->language_code !!}</p>
  </div>
</div>

<!-- friend_auto_add Field -->
<div class="form-group row col-6">
  {!! Form::label('friend_auto_add', trans("lang.user_friend_auto_add"), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $user->friend_auto_add !!}</p>
  </div>
</div>

<!-- friend_allow_add_me Field -->
<div class="form-group row col-6">
  {!! Form::label('friend_allow_add_me', trans("lang.user_friend_allow_add_me"), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $user->friend_allow_add_me !!}</p>
  </div>
</div>

<!-- allow_notify Field -->
<div class="form-group row col-6">
  {!! Form::label('allow_notify', trans("lang.allow_notify"), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $user->allow_notify !!}</p>
  </div>
</div>

<!-- allow_notify_shipping Field -->
<div class="form-group row col-6">
  {!! Form::label('allow_notify_shipping', trans("lang.allow_notify_shipping"), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $user->allow_notify_shipping !!}</p>
  </div>
</div>

<!-- allow_notify_event Field -->
<div class="form-group row col-6">
  {!! Form::label('allow_notify_event', trans("lang.allow_notify_event"), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $user->allow_notify_event !!}</p>
  </div>
</div>

<!-- allow_notify_notice Field -->
<div class="form-group row col-6">
  {!! Form::label('allow_notify_notice', trans("lang.allow_notify_notice"), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $user->allow_notify_notice !!}</p>
  </div>
</div>

<!-- allow_notify_lockscreen Field -->
<div class="form-group row col-6">
  {!! Form::label('allow_notify_lockscreen', trans("lang.allow_notify_lockscreen"), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $user->allow_notify_lockscreen !!}</p>
  </div>
</div>

<!-- agree_privacy Field -->
<div class="form-group row col-6">
  {!! Form::label('agree_privacy', trans("lang.agree_privacy"), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $user->agree_privacy !!}</p>
  </div>
</div>

<!-- agree_terms Field -->
<div class="form-group row col-6">
  {!! Form::label('agree_terms', trans("lang.agree_terms"), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $user->agree_terms !!}</p>
  </div>
</div>

<!-- agree_mobile Field -->
<div class="form-group row col-6">
  {!! Form::label('agree_mobile', trans("lang.agree_mobile"), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $user->agree_mobile !!}</p>
  </div>
</div>

<!-- extra_info Field -->
<div class="form-group row col-6">
  {!! Form::label('extra_info', trans("lang.extra_info"), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $user->extra_info !!}</p>
  </div>
</div>

<!-- Role Id Field -->
@can('permissions.index')
<div class="form-group row col-6">
  {!! Form::label('role', 'Role:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $rolesSelected[0] !!}</p>
  </div>
</div>
@endcan

<!-- Created At Field -->
<div class="form-group row col-6">
  {!! Form::label('created_at',  trans("lang.user_created_at"), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $user->created_at !!}</p>
  </div>
</div>

<!-- Updated At Field -->
<div class="form-group row col-6">
  {!! Form::label('updated_at',  trans("lang.user_updated_at"), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $user->updated_at !!}</p>
  </div>
</div>

