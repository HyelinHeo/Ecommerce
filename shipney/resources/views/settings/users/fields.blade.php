<div style="flex: 50%;max-width: 50%;padding: 0 4px;" class="column">
    <!-- Name Field -->
    <div class="form-group row ">
        {!! Form::label('name', trans("lang.user_name"), ['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            {!! Form::text('name', null,  ['class' => 'form-control','placeholder'=>  trans("lang.user_name_placeholder")]) !!}
            <div class="form-text text-muted">
                {{ trans("lang.user_name_help") }}
            </div>
        </div>
    </div>

    <!-- Email Field -->
    <div class="form-group row ">
        {!! Form::label('email', trans("lang.user_email"), ['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            {!! Form::text('email', null,  ['class' => 'form-control','placeholder'=>  trans("lang.user_email_placeholder")]) !!}
            <div class="form-text text-muted">
                {{ trans("lang.user_email_help") }}
            </div>
        </div>
    </div>

    <!-- api_token Field -->
    <div class="form-group row ">
        {!! Form::label('api_token', trans("lang.user_api_token"), ['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            {!! Form::text('api_token', null,  ['class' => 'form-control', 'readonly']) !!}
            <div class="form-text text-muted">
                {!! "user's api tocken"; !!}
            </div>
        </div>
    </div>

    <!-- phone Field -->
    <div class="form-group row ">
        {!! Form::label('phone', trans("lang.user_phone"), ['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            {!! Form::text('phone', null,  ['class' => 'form-control','placeholder'=>  trans("lang.user_phone_placeholder")]) !!}
            <div class="form-text text-muted">
                {{ trans("lang.user_phone_help") }}
            </div>
        </div>
    </div>

    <!-- country_code Field -->
    <div class="form-group row ">
        {!! Form::label('country_code', trans("lang.user_country_code"), ['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            {!! Form::text('country_code', null,  ['class' => 'form-control','placeholder'=>  trans("lang.user_country_code_placeholder")]) !!}
            <div class="form-text text-muted">
                {{ trans("lang.user_country_code_help") }}
            </div>
        </div>
    </div>

    <!-- country_digit Field -->
    <div class="form-group row ">
        {!! Form::label('country_digit', trans("lang.user_country_digit"), ['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            {!! Form::text('country_digit', null,  ['class' => 'form-control','placeholder'=>  trans("lang.user_country_digit_placeholder")]) !!}
            <div class="form-text text-muted">
                {{ trans("lang.user_country_digit_help") }}
            </div>
        </div>
    </div>

    <!-- language_code Field -->
    <div class="form-group row ">
        {!! Form::label('language_code', trans("lang.user_language_code"), ['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            {!! Form::text('language_code', null,  ['class' => 'form-control','placeholder'=>  trans("lang.user_language_code_placeholder")]) !!}
            <div class="form-text text-muted">
                {{ trans("lang.user_language_code_help") }}
            </div>
        </div>
    </div>

    @can('permissions.index')
    <!-- Roles Field -->
    <div class="form-group row ">
        {!! Form::label('roles[]', trans("lang.user_role_id"),['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            {!! Form::select('roles[]', $role, $rolesSelected, ['class' => 'select2 form-control' , 'multiple'=>'multiple']) !!}
            <div class="form-text text-muted">{{ trans("lang.user_role_id_help") }}</div>
        </div>
    </div>
    @endcan

    <!-- extra_info Field -->
    <div class="form-group row ">
        {!! Form::label('extra_info', trans("lang.extra_info"), ['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            {!! Form::textarea('extra_info', null,  ['class' => 'form-control','placeholder'=>  trans("lang.extra_info_placeholder")]) !!}
            <div class="form-text text-muted">
                {{ trans("lang.extra_info_help") }}
            </div>
        </div>
    </div>

</div>
<div style="flex: 50%;max-width: 50%;padding: 0 4px;" class="column">
    <!-- reg_type Field -->
    <div class="form-group row ">
        {!! Form::label('reg_type', trans("lang.user_reg_type"), ['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            {!! Form::text('reg_type', null,  ['class' => 'form-control']) !!}
            <div class="form-text text-muted">
                {{ trans("lang.user_reg_type_help") }}
            </div>
        </div>
    </div>

    <!-- sns_token Field -->
    <div class="form-group row ">
        {!! Form::label('sns_token', trans("lang.user_sns_token"), ['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            {!! Form::text('sns_token', null,  ['class' => 'form-control']) !!}
            <div class="form-text text-muted">
                {{ trans("lang.user_sns_token_help") }}
            </div>
        </div>
    </div>

    <!-- friend_auto_add Field -->
    <div class="form-group row ">
        {!! Form::label('friend_auto_add', trans("lang.user_friend_auto_add"), ['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            {!! Form::checkbox('friend_auto_add', true,  ['class' => 'form-control']) !!}
            <div class="form-text text-muted">
                {{ trans("lang.user_friend_auto_add_help") }}
            </div>
        </div>
    </div>

    <!-- friend_allow_add_me Field -->
    <div class="form-group row ">
        {!! Form::label('friend_allow_add_me', trans("lang.user_friend_allow_add_me"), ['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            {!! Form::checkbox('friend_allow_add_me',  true,  ['class' => 'form-control']) !!}
            <div class="form-text text-muted">
                {{ trans("lang.user_friend_allow_add_me_help") }}
            </div>
        </div>
    </div>

    <!-- allow_notify Field -->
    <div class="form-group row ">
        {!! Form::label('allow_notify', trans("lang.allow_notify"), ['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            {!! Form::checkbox('allow_notify', true,  ['class' => 'form-control']) !!}
            <div class="form-text text-muted">
                {{ trans("lang.allow_notify_help") }}
            </div>
        </div>
    </div>

    <!-- allow_notify_shipping Field -->
    <div class="form-group row ">
        {!! Form::label('allow_notify_shipping', trans("lang.allow_notify_shipping"), ['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            {!! Form::checkbox('allow_notify_shipping', true,  ['class' => 'form-control']) !!}
            <div class="form-text text-muted">
                {{ trans("lang.allow_notify_shipping_help") }}
            </div>
        </div>
    </div>

    <!-- allow_notify_event Field -->
    <div class="form-group row ">
        {!! Form::label('allow_notify_event', trans("lang.allow_notify_event"), ['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            {!! Form::checkbox('allow_notify_event', true,  ['class' => 'form-control']) !!}
            <div class="form-text text-muted">
                {{ trans("lang.allow_notify_event_help") }}
            </div>
        </div>
    </div>

    <!-- allow_notify_notice Field -->
    <div class="form-group row ">
        {!! Form::label('allow_notify_notice', trans("lang.allow_notify_notice"), ['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            {!! Form::checkbox('allow_notify_notice', true,  ['class' => 'form-control']) !!}
            <div class="form-text text-muted">
                {{ trans("lang.allow_notify_notice_help") }}
            </div>
        </div>
    </div>

    <!-- allow_notify_lockscreen Field -->
    <div class="form-group row ">
        {!! Form::label('allow_notify_lockscreen', trans("lang.allow_notify_lockscreen"), ['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            {!! Form::checkbox('allow_notify_lockscreen', true,  ['class' => 'form-control']) !!}
            <div class="form-text text-muted">
                {{ trans("lang.allow_notify_lockscreen_help") }}
            </div>
        </div>
    </div>

    <!-- agree_privacy Field -->
    <div class="form-group row ">
        {!! Form::label('agree_privacy', trans("lang.agree_privacy"), ['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            {!! Form::checkbox('agree_privacy', true,  ['class' => 'form-control']) !!}
            <div class="form-text text-muted">
                {{ trans("lang.agree_privacy_help") }}
            </div>
        </div>
    </div>

    <!-- agree_terms Field -->
    <div class="form-group row ">
        {!! Form::label('agree_terms', trans("lang.agree_terms"), ['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            {!! Form::checkbox('agree_terms', true,  ['class' => 'form-control']) !!}
            <div class="form-text text-muted">
                {{ trans("lang.agree_terms_help") }}
            </div>
        </div>
    </div>

    <!-- agree_mobile Field -->
    <div class="form-group row ">
        {!! Form::label('agree_mobile', trans("lang.agree_mobile"), ['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            {!! Form::checkbox('agree_mobile', true,  ['class' => 'form-control']) !!}
            <div class="form-text text-muted">
                {{ trans("lang.agree_mobile_help") }}
            </div>
        </div>
    </div>
</div>

<!-- Submit Field -->
<div class="form-group col-12 text-right">
    <button type="submit" class="btn btn-{{setting('theme_color')}}"><i class="fa fa-save"></i> {{trans('lang.save')}} {{trans('lang.user')}}</button>
    <a href="{!! url()->previous() !!}" class="btn btn-default"><i class="fa fa-undo"></i> {{trans('lang.cancel')}}</a>
</div>
