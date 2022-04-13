<!-- Id Field -->
<div class="form-group row col-6">
  {!! Form::label('id', trans('lang.payment_id').' :', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $payment->id !!}</p>
  </div>
</div>

<!-- User Id Field -->
<div class="form-group row col-6">
  {!! Form::label('user_id', trans('lang.payment_user_id').' :', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $payment->user->name !!}</p>
  </div>
</div>

<!-- Order No Field -->
<div class="form-group row col-6">
  {!! Form::label('orderno', trans('lang.payment_orderno').' :', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $payment->orderno !!}</p>
  </div>
</div>

<!-- Description Field -->
<div class="form-group row col-6">
  {!! Form::label('description', trans('lang.payment_description').' :', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $payment->description !!}</p>
  </div>
</div>

<!-- Result Code Field -->
<div class="form-group row col-6">
  {!! Form::label('resultCode', trans('lang.payment_resultCode').' :', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $payment->resultCode !!}</p>
  </div>
</div>

<!-- Result Msg Field -->
<div class="form-group row col-6">
  {!! Form::label('resultMsg', trans('lang.payment_resultMsg').' :', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $payment->resultMsg !!}</p>
  </div>
</div>

<!-- tid Field -->
<div class="form-group row col-6">
  {!! Form::label('tid', trans('lang.payment_tid').' :', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $payment->tid !!}</p>
  </div>
</div>

<!-- Pay Type Field -->
<div class="form-group row col-6">
  {!! Form::label('payType', trans('lang.payment_payType').' :', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $payment->payType !!}</p>
  </div>
</div>

<!-- Auth Date Field -->
<div class="form-group row col-6">
  {!! Form::label('authDate', trans('lang.payment_authDate').' :', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $payment->authDate !!}</p>
  </div>
</div>

<!-- Auth Num Field -->
<div class="form-group row col-6">
  {!! Form::label('authNum', trans('lang.payment_authNum').' :', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $payment->authNum !!}</p>
  </div>
</div>

<!-- Price Field -->
<div class="form-group row col-6">
  {!! Form::label('price', trans('lang.payment_price').' :', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $payment->price !!}</p>
  </div>
</div>

<!-- User Name Field -->
<div class="form-group row col-6">
  {!! Form::label('userName', trans('lang.payment_userName').' :', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $payment->userName !!}</p>
  </div>
</div>

<!-- Card Code1 Field -->
<div class="form-group row col-6">
  {!! Form::label('cardCode1', trans('lang.payment_cardCode1').' :', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $payment->cardCode1 !!}</p>
  </div>
</div>

<!-- Card Code2 Field -->
<div class="form-group row col-6">
  {!! Form::label('cardCode2', trans('lang.payment_cardCode2').' :', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $payment->cardCode2 !!}</p>
  </div>
</div>

<!-- Card Company Name Field -->
<div class="form-group row col-6">
  {!! Form::label('cardCompName', trans('lang.payment_cardCompName').' :', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $payment->cardCompName !!}</p>
  </div>
</div>

<!-- Card Number Field -->
<div class="form-group row col-6">
  {!! Form::label('cardNum', trans('lang.payment_cardNum').' :', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $payment->cardNum !!}</p>
  </div>
</div>

<!-- Card Prtc Field -->
<div class="form-group row col-6">
  {!! Form::label('cardPrtc', trans('lang.payment_cardPrtc').' :', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $payment->cardPrtc !!}</p>
  </div>
</div>

<!-- Card Corp Flag Field -->
<div class="form-group row col-6">
  {!! Form::label('cardCorpFlag', trans('lang.payment_cardCorpFlag').' :', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $payment->cardCorpFlag !!}</p>
  </div>
</div>

<!-- Card Check Flag Field -->
<div class="form-group row col-6">
  {!! Form::label('cardCheckFlag', trans('lang.payment_cardCheckFlag').' :', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $payment->cardCheckFlag !!}</p>
  </div>
</div>

<!-- Extra Data Field -->
<div class="form-group row col-6">
  {!! Form::label('extraData', trans('lang.payment_extraData').' :', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $payment->extraData !!}</p>
  </div>
</div>

<!-- Method Token Field -->
<div class="form-group row col-6">
  {!! Form::label('method_token', trans('lang.payment_method_token').' :', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $payment->method_token !!}</p>
  </div>
</div>

<!-- Cancel Result Code Field -->
<div class="form-group row col-6">
  {!! Form::label('cancelResultCode', trans('lang.payment_cancelResultCode').' :', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $payment->cancelResultCode !!}</p>
  </div>
</div>

<!-- Cancel Result Msg Field -->
<div class="form-group row col-6">
  {!! Form::label('cancelResultMsg', trans('lang.payment_cancelResultMsg').' :', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $payment->cancelResultMsg !!}</p>
  </div>
</div>

<!-- Cancel Date Field -->
<div class="form-group row col-6">
  {!! Form::label('cancelDate', trans('lang.payment_cancelDate').' :', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $payment->cancelDate !!}</p>
  </div>
</div>

<!-- Cancel Time Field -->
<div class="form-group row col-6">
  {!! Form::label('cancelTime', trans('lang.payment_cancelTime').' :', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $payment->cancelTime !!}</p>
  </div>
</div>

<!-- Cancel Number Field -->
<div class="form-group row col-6">
  {!! Form::label('cancelNum', trans('lang.payment_cancelNum').' :', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $payment->cancelNum !!}</p>
  </div>
</div>

<!-- Prtc Result Code Field -->
<div class="form-group row col-6">
  {!! Form::label('prtcResultCode', trans('lang.payment_prtcResultCode').' :', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $payment->prtcResultCode !!}</p>
  </div>
</div>

<!-- Prtc Result Msg Field -->
<div class="form-group row col-6">
  {!! Form::label('prtcResultMsg', trans('lang.payment_prtcResultMsg').' :', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $payment->prtcResultMsg !!}</p>
  </div>
</div>

<!-- Prtc Tid Field -->
<div class="form-group row col-6">
  {!! Form::label('prtcTid', trans('lang.payment_prtcTid').' :', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $payment->prtcTid !!}</p>
  </div>
</div>

<!-- Prtc Price Field -->
<div class="form-group row col-6">
  {!! Form::label('prtcPrice', trans('lang.payment_prtcPrice').' :', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $payment->prtcPrice !!}</p>
  </div>
</div>

<!-- Prtc Remains Field -->
<div class="form-group row col-6">
  {!! Form::label('prtcRemains', trans('lang.payment_prtcRemains').' :', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $payment->prtcRemains !!}</p>
  </div>
</div>

<!-- Prtc Cnt Field -->
<div class="form-group row col-6">
  {!! Form::label('prtcCnt', trans('lang.payment_prtcCnt').' :', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $payment->prtcCnt !!}</p>
  </div>
</div>

<!-- Prtc Type Field -->
<div class="form-group row col-6">
  {!! Form::label('prtcType', trans('lang.payment_prtcType').' :', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $payment->prtcType !!}</p>
  </div>
</div>

<!-- Prtc Date Field -->
<div class="form-group row col-6">
  {!! Form::label('prtcDate', trans('lang.payment_prtcDate').' :', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $payment->prtcDate !!}</p>
  </div>
</div>

<!-- Prtc Time Field -->
<div class="form-group row col-6">
  {!! Form::label('prtcTime', trans('lang.payment_prtcTime').' :', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $payment->prtcTime !!}</p>
  </div>
</div>

<!-- Created At Field -->
<div class="form-group row col-6">
  {!! Form::label('created_at', trans('lang.payment_created_at').' :', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $payment->created_at !!}</p>
  </div>
</div>

<!-- Updated At Field -->
<div class="form-group row col-6">
  {!! Form::label('updated_at', trans('lang.payment_updated_at').' :', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $payment->updated_at !!}</p>
  </div>
</div>

