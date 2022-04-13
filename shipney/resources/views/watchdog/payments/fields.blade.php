<div style="flex: 50%;max-width: 50%;padding: 0 4px;" class="column">
    <!-- User Name Field -->
    <div class="form-group row ">
        {!! Form::label('user_name', trans("lang.payment_user_id"),['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            @if(isset($payment))
                {!! Form::text('user_name', $payment->user->name, ['class' => 'form-control', 'disabled']) !!}
                {!! Form::hidden('user_id', $payment->user->id, ['class' => 'select2 form-control']) !!}
            @else
                {!! Form::select('user_id', $user, null, ['class' => 'select2 form-control']) !!}
            @endif
            <div class="form-text text-muted">{{ trans("lang.payment_user_id_help") }}</div>
        </div>
    </div>

    @if(isset($payment))
    <!-- User Email Field -->
    <div class="form-group row ">
        {!! Form::label('user_email', trans("lang.payment_user_email"),['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
                {!! Form::text('user_email', $payment->user->email, ['class' => 'form-control', 'disabled']) !!}
            <div class="form-text text-muted">{{ trans("lang.payment_user_email_help") }}</div>
        </div>
    </div>
    @endif

    <!-- Order No Field -->
    <div class="form-group row ">
        {!! Form::label('orderno', trans("lang.payment_orderno"), ['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            {!! Form::text('orderno', null,  ['class' => 'form-control', 'placeholder'=>  trans("lang.payment_orderno_placeholder")]) !!}
            <div class="form-text text-muted">
                {{ trans("lang.payment_orderno_help") }}
            </div>
        </div>
    </div>

    <!-- Description Field -->
    <div class="form-group row ">
        {!! Form::label('description', trans("lang.payment_description"), ['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            {!! Form::text('description', null,  ['class' => 'form-control', 'placeholder'=>  trans("lang.payment_description_placeholder")]) !!}
            <div class="form-text text-muted">
                {{ trans("lang.payment_description_help") }}
            </div>
        </div>
    </div>

    <!-- Result Code Field -->
    <div class="form-group row ">
        {!! Form::label('resultCode', trans("lang.payment_resultCode"), ['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            {!! Form::text('resultCode', null,  ['class' => 'form-control', 'placeholder'=>  trans("lang.payment_resultCode_placeholder")]) !!}
            <div class="form-text text-muted">
                {{ trans("lang.payment_resultCode_help") }}
            </div>
        </div>
    </div>

    <!-- Result Msg Field -->
    <div class="form-group row ">
        {!! Form::label('resultMsg', trans("lang.payment_resultMsg"), ['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            {!! Form::text('resultMsg', null,  ['class' => 'form-control', 'placeholder'=>  trans("lang.payment_resultMsg_placeholder")]) !!}
            <div class="form-text text-muted">
                {{ trans("lang.payment_resultMsg_help") }}
            </div>
        </div>
    </div>

    <!-- tid Field -->
    <div class="form-group row ">
        {!! Form::label('tid', trans("lang.payment_tid"), ['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            {!! Form::text('tid', null,  ['class' => 'form-control', 'placeholder'=>  trans("lang.payment_tid_placeholder")]) !!}
            <div class="form-text text-muted">
                {{ trans("lang.payment_tid_help") }}
            </div>
        </div>
    </div>

    <!-- Pay Type Field -->
    <div class="form-group row ">
        {!! Form::label('payType', trans("lang.payment_payType"), ['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            {!! Form::text('payType', null,  ['class' => 'form-control', 'placeholder'=>  trans("lang.payment_payType_placeholder")]) !!}
            <div class="form-text text-muted">
                {{ trans("lang.payment_payType_help") }}
            </div>
        </div>
    </div>

    <!-- Auth Date Field -->
    <div class="form-group row ">
        {!! Form::label('authDate', trans("lang.payment_authDate"), ['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            {!! Form::text('authDate', null,  ['class' => 'form-control', 'placeholder'=>  trans("lang.payment_authDate_placeholder")]) !!}
            <div class="form-text text-muted">
                {{ trans("lang.payment_authDate_help") }}
            </div>
        </div>
    </div>

    <!-- Auth Num Field -->
    <div class="form-group row ">
        {!! Form::label('authNum', trans("lang.payment_authNum"), ['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            {!! Form::text('authNum', null,  ['class' => 'form-control', 'placeholder'=>  trans("lang.payment_authNum_placeholder")]) !!}
            <div class="form-text text-muted">
                {{ trans("lang.payment_authNum_help") }}
            </div>
        </div>
    </div>

    <!-- Price Field -->
    <div class="form-group row ">
        {!! Form::label('price', trans("lang.payment_price"), ['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            {!! Form::text('price', null,  ['class' => 'form-control', 'placeholder'=>  trans("lang.payment_price_placeholder")]) !!}
            <div class="form-text text-muted">
                {{ trans("lang.payment_price_help") }}
            </div>
        </div>
    </div>

    <!-- User Name Field -->
    <div class="form-group row ">
        {!! Form::label('userName', trans("lang.payment_userName"), ['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            {!! Form::text('userName', null,  ['class' => 'form-control', 'placeholder'=>  trans("lang.payment_userName_placeholder")]) !!}
            <div class="form-text text-muted">
                {{ trans("lang.payment_userName_help") }}
            </div>
        </div>
    </div>

    <!-- Card Code1 Field -->
    <div class="form-group row ">
        {!! Form::label('cardCode1', trans("lang.payment_cardCode1"), ['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            {!! Form::text('cardCode1', null,  ['class' => 'form-control', 'placeholder'=>  trans("lang.payment_cardCode1_placeholder")]) !!}
            <div class="form-text text-muted">
                {{ trans("lang.payment_cardCode1_help") }}
            </div>
        </div>
    </div>

    <!-- Card Code2 Field -->
    <div class="form-group row ">
        {!! Form::label('cardCode2', trans("lang.payment_cardCode2"), ['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            {!! Form::text('cardCode2', null,  ['class' => 'form-control', 'placeholder'=>  trans("lang.payment_cardCode2_placeholder")]) !!}
            <div class="form-text text-muted">
                {{ trans("lang.payment_cardCode2_help") }}
            </div>
        </div>
    </div>

    <!-- Card Company Name Field -->
    <div class="form-group row ">
        {!! Form::label('cardCompName', trans("lang.payment_cardCompName"), ['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            {!! Form::text('cardCompName', null,  ['class' => 'form-control', 'placeholder'=>  trans("lang.payment_cardCompName_placeholder")]) !!}
            <div class="form-text text-muted">
                {{ trans("lang.payment_cardCompName_help") }}
            </div>
        </div>
    </div>

    <!-- Card Number Field -->
    <div class="form-group row ">
        {!! Form::label('cardNum', trans("lang.payment_cardNum"), ['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            {!! Form::text('cardNum', null,  ['class' => 'form-control', 'placeholder'=>  trans("lang.payment_cardNum_placeholder")]) !!}
            <div class="form-text text-muted">
                {{ trans("lang.payment_cardNum_help") }}
            </div>
        </div>
    </div>

    <!-- Card Prtc Field -->
    <div class="form-group row ">
        {!! Form::label('cardPrtc', trans("lang.payment_cardPrtc"), ['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            {!! Form::text('cardPrtc', null,  ['class' => 'form-control', 'placeholder'=>  trans("lang.payment_cardPrtc_placeholder")]) !!}
            <div class="form-text text-muted">
                {{ trans("lang.payment_cardPrtc_help") }}
            </div>
        </div>
    </div>

    <!-- Card Corp Flag Field -->
    <div class="form-group row ">
        {!! Form::label('cardCorpFlag', trans("lang.payment_cardCorpFlag"), ['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            {!! Form::text('cardCorpFlag', null,  ['class' => 'form-control', 'placeholder'=>  trans("lang.payment_cardCorpFlag_placeholder")]) !!}
            <div class="form-text text-muted">
                {{ trans("lang.payment_cardCorpFlag_help") }}
            </div>
        </div>
    </div>
    
</div>
<div style="flex: 50%;max-width: 50%;padding: 0 4px;" class="column">

    <!-- Card Check Flag Field -->
    <div class="form-group row ">
        {!! Form::label('cardCheckFlag', trans("lang.payment_cardCheckFlag"), ['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            {!! Form::text('cardCheckFlag', null,  ['class' => 'form-control', 'placeholder'=>  trans("lang.payment_cardCheckFlag_placeholder")]) !!}
            <div class="form-text text-muted">
                {{ trans("lang.payment_cardCheckFlag_help") }}
            </div>
        </div>
    </div>

    <!-- Extra Data Field -->
    <div class="form-group row ">
        {!! Form::label('extraData', trans("lang.payment_extraData"), ['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            {!! Form::text('extraData', null,  ['class' => 'form-control', 'placeholder'=>  trans("lang.payment_extraData_placeholder")]) !!}
            <div class="form-text text-muted">
                {{ trans("lang.payment_extraData_help") }}
            </div>
        </div>
    </div>

    <!-- Method Token Field -->
    <div class="form-group row ">
        {!! Form::label('method_token', trans("lang.payment_method_token"), ['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            {!! Form::text('method_token', null,  ['class' => 'form-control', 'placeholder'=>  trans("lang.payment_method_token_placeholder")]) !!}
            <div class="form-text text-muted">
                {{ trans("lang.payment_method_token_help") }}
            </div>
        </div>
    </div>

    <!-- Cancel Result Code Field -->
    <div class="form-group row ">
        {!! Form::label('cancelResultCode', trans("lang.payment_cancelResultCode"), ['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            {!! Form::text('cancelResultCode', null,  ['class' => 'form-control', 'placeholder'=>  trans("lang.payment_cancelResultCode_placeholder")]) !!}
            <div class="form-text text-muted">
                {{ trans("lang.payment_cancelResultCode_help") }}
            </div>
        </div>
    </div>

    <!-- Cancel Result Msg Field -->
    <div class="form-group row ">
        {!! Form::label('cancelResultMsg', trans("lang.payment_cancelResultMsg"), ['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            {!! Form::text('cancelResultMsg', null,  ['class' => 'form-control', 'placeholder'=>  trans("lang.payment_cancelResultMsg_placeholder")]) !!}
            <div class="form-text text-muted">
                {{ trans("lang.payment_cancelResultMsg_help") }}
            </div>
        </div>
    </div>

    <!-- Cancel Date Field -->
    <div class="form-group row ">
        {!! Form::label('cancelDate', trans("lang.payment_cancelDate"), ['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            {!! Form::text('cancelDate', null,  ['class' => 'form-control', 'placeholder'=>  trans("lang.payment_cancelDate_placeholder")]) !!}
            <div class="form-text text-muted">
                {{ trans("lang.payment_cancelDate_help") }}
            </div>
        </div>
    </div>

    <!-- Cancel Time Field -->
    <div class="form-group row ">
        {!! Form::label('cancelTime', trans("lang.payment_cancelTime"), ['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            {!! Form::text('cancelTime', null,  ['class' => 'form-control','placeholder'=>  trans("lang.payment_cancelTime_placeholder")]) !!}
            <div class="form-text text-muted">
                {{ trans("lang.payment_cancelTime_help") }}
            </div>
        </div>
    </div>

    <!-- Cancel Number Field -->
    <div class="form-group row ">
        {!! Form::label('cancelNum', trans("lang.payment_cancelNum"), ['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            {!! Form::text('cancelNum', null,  ['class' => 'form-control','placeholder'=>  trans("lang.payment_cancelNum_placeholder")]) !!}
            <div class="form-text text-muted">
                {{ trans("lang.payment_cancelNum_help") }}
            </div>
        </div>
    </div>

    <!-- Prtc Result Code Field -->
    <div class="form-group row ">
        {!! Form::label('prtcResultCode', trans("lang.payment_prtcResultCode"), ['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            {!! Form::text('prtcResultCode', null,  ['class' => 'form-control','placeholder'=>  trans("lang.payment_prtcResultCode_placeholder")]) !!}
            <div class="form-text text-muted">
                {{ trans("lang.payment_prtcResultCode_help") }}
            </div>
        </div>
    </div>

    <!-- Prtc Result Msg Field -->
    <div class="form-group row ">
        {!! Form::label('prtcResultMsg', trans("lang.payment_prtcResultMsg"), ['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            {!! Form::text('prtcResultMsg', null,  ['class' => 'form-control','placeholder'=>  trans("lang.payment_prtcResultMsg_placeholder")]) !!}
            <div class="form-text text-muted">
                {{ trans("lang.payment_prtcResultMsg_help") }}
            </div>
        </div>
    </div>

    <!-- Prtc Tid Field -->
    <div class="form-group row ">
        {!! Form::label('prtcTid', trans("lang.payment_prtcTid"), ['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            {!! Form::text('prtcTid', null,  ['class' => 'form-control','placeholder'=>  trans("lang.payment_prtcTid_placeholder")]) !!}
            <div class="form-text text-muted">
                {{ trans("lang.payment_prtcTid_help") }}
            </div>
        </div>
    </div>

    <!-- Prtc Price Field -->
    <div class="form-group row ">
        {!! Form::label('prtcPrice', trans("lang.payment_prtcPrice"), ['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            {!! Form::text('prtcPrice', null,  ['class' => 'form-control','placeholder'=>  trans("lang.payment_prtcPrice_placeholder")]) !!}
            <div class="form-text text-muted">
                {{ trans("lang.payment_prtcPrice_help") }}
            </div>
        </div>
    </div>

    <!-- Prtc Remains Field -->
    <div class="form-group row ">
        {!! Form::label('prtcRemains', trans("lang.payment_prtcRemains"), ['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            {!! Form::text('prtcRemains', null,  ['class' => 'form-control','placeholder'=>  trans("lang.payment_prtcRemains_placeholder")]) !!}
            <div class="form-text text-muted">
                {{ trans("lang.payment_prtcRemains_help") }}
            </div>
        </div>
    </div>

    <!-- Prtc Cnt Field -->
    <div class="form-group row ">
        {!! Form::label('prtcCnt', trans("lang.payment_prtcCnt"), ['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            {!! Form::text('prtcCnt', null,  ['class' => 'form-control','placeholder'=>  trans("lang.payment_prtcCnt_placeholder")]) !!}
            <div class="form-text text-muted">
                {{ trans("lang.payment_prtcCnt_help") }}
            </div>
        </div>
    </div>

    <!-- Prtc Type Field -->
    <div class="form-group row ">
        {!! Form::label('prtcType', trans("lang.payment_prtcType"), ['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            {!! Form::text('prtcType', null,  ['class' => 'form-control','placeholder'=>  trans("lang.payment_prtcType_placeholder")]) !!}
            <div class="form-text text-muted">
                {{ trans("lang.payment_prtcType_help") }}
            </div>
        </div>
    </div>

    <!-- Prtc Date Field -->
    <div class="form-group row ">
        {!! Form::label('prtcDate', trans("lang.payment_prtcDate"), ['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            {!! Form::text('prtcDate', null,  ['class' => 'form-control','placeholder'=>  trans("lang.payment_prtcDate_placeholder")]) !!}
            <div class="form-text text-muted">
                {{ trans("lang.payment_prtcDate_help") }}
            </div>
        </div>
    </div>

    <!-- Prtc Time Field -->
    <div class="form-group row ">
        {!! Form::label('prtcTime', trans("lang.payment_prtcTime"), ['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            {!! Form::text('prtcTime', null,  ['class' => 'form-control','placeholder'=>  trans("lang.payment_prtcTime_placeholder")]) !!}
            <div class="form-text text-muted">
                {{ trans("lang.payment_prtcTime_help") }}
            </div>
        </div>
    </div>

</div>
<!-- Submit Field -->
<div class="form-group col-12 text-right">
    <button type="submit" class="btn btn-{{setting('theme_color')}}"><i class="fa fa-save"></i> {{trans('lang.save')}} {{trans('lang.watchdog_payment')}}</button>
    <a href="{!! url()->previous() !!}" class="btn btn-default"><i class="fa fa-undo"></i> {{trans('lang.cancel')}}</a>
</div>
