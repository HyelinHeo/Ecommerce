<!-- Id Field -->
<div class="form-group row col-6">
  {!! Form::label('id', 'Id:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $payment->id !!}</p>
  </div>
</div>

<!-- User Id Field -->
<div class="form-group row col-6">
  {!! Form::label('user_id', 'User Name:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $payment->user->name !!}</p>
  </div>
</div>

<!-- Order No Field -->
<div class="form-group row col-6">
  {!! Form::label('orderno', 'Order No:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $payment->orderno !!}</p>
  </div>
</div>

<!-- Description Field -->
<div class="form-group row col-6">
  {!! Form::label('description', 'Description:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $payment->description !!}</p>
  </div>
</div>

<!-- Result Code Field -->
<div class="form-group row col-6">
  {!! Form::label('resultCode', 'Result Code:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $payment->resultCode !!}</p>
  </div>
</div>

<!-- Result Msg Field -->
<div class="form-group row col-6">
  {!! Form::label('resultMsg', 'Result Msg:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $payment->resultMsg !!}</p>
  </div>
</div>

<!-- tid Field -->
<div class="form-group row col-6">
  {!! Form::label('tid', 'tid:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $payment->tid !!}</p>
  </div>
</div>

<!-- Pay Type Field -->
<div class="form-group row col-6">
  {!! Form::label('payType', 'Pay Type:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $payment->payType !!}</p>
  </div>
</div>

<!-- Auth Date Field -->
<div class="form-group row col-6">
  {!! Form::label('authDate', 'Auth Date:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $payment->authDate !!}</p>
  </div>
</div>

<!-- Auth Num Field -->
<div class="form-group row col-6">
  {!! Form::label('authNum', 'Auth Num:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $payment->authNum !!}</p>
  </div>
</div>

<!-- Price Field -->
<div class="form-group row col-6">
  {!! Form::label('price', 'Price:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $payment->price !!}</p>
  </div>
</div>

<!-- User Name Field -->
<div class="form-group row col-6">
  {!! Form::label('userName', 'Payer Name:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $payment->userName !!}</p>
  </div>
</div>

<!-- Card Code1 Field -->
<div class="form-group row col-6">
  {!! Form::label('cardCode1', 'Card Code1:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $payment->cardCode1 !!}</p>
  </div>
</div>

<!-- Card Code2 Field -->
<div class="form-group row col-6">
  {!! Form::label('cardCode2', 'Card Code2:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $payment->cardCode2 !!}</p>
  </div>
</div>

<!-- Card Company Name Field -->
<div class="form-group row col-6">
  {!! Form::label('cardCompName', 'Card Company Name:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $payment->cardCompName !!}</p>
  </div>
</div>

<!-- Card Number Field -->
<div class="form-group row col-6">
  {!! Form::label('cardNum', 'Card Number:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $payment->cardNum !!}</p>
  </div>
</div>

<!-- Card Prtc Field -->
<div class="form-group row col-6">
  {!! Form::label('cardPrtc', 'Card Prtc:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $payment->cardPrtc !!}</p>
  </div>
</div>

<!-- Card Corp Flag Field -->
<div class="form-group row col-6">
  {!! Form::label('cardCorpFlag', 'Card Corp Flag:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $payment->cardCorpFlag !!}</p>
  </div>
</div>

<!-- Card Check Flag Field -->
<div class="form-group row col-6">
  {!! Form::label('cardCheckFlag', 'Card CheckFlag:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $payment->cardCheckFlag !!}</p>
  </div>
</div>

<!-- Extra Data Field -->
<div class="form-group row col-6">
  {!! Form::label('extraData', 'Extra Data:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $payment->extraData !!}</p>
  </div>
</div>

<!-- method_token Field -->
<div class="form-group row col-6">
  {!! Form::label('method_token', 'Method Token:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $payment->method_token !!}</p>
  </div>
</div>

<!-- Cancel Result Code Field -->
<div class="form-group row col-6">
  {!! Form::label('cancelResultCode', 'Cancel Result Code:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $payment->cancelResultCode !!}</p>
  </div>
</div>

<!-- Cancel Result Msg Field -->
<div class="form-group row col-6">
  {!! Form::label('cancelResultMsg', 'Cancel Result Msg:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $payment->cancelResultMsg !!}</p>
  </div>
</div>

<!-- Cancel Date Field -->
<div class="form-group row col-6">
  {!! Form::label('cancelDate', 'Cancel Date:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $payment->cancelDate !!}</p>
  </div>
</div>

<!-- Cancel Time Field -->
<div class="form-group row col-6">
  {!! Form::label('cancelTime', 'Cancel Time:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $payment->cancelTime !!}</p>
  </div>
</div>

<!-- Cancel Number Field -->
<div class="form-group row col-6">
  {!! Form::label('cancelNum', 'Cancel Number:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $payment->cancelNum !!}</p>
  </div>
</div>

<!-- Prtc Result Code Field -->
<div class="form-group row col-6">
  {!! Form::label('prtcResultCode', 'Prtc Result Code:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $payment->prtcResultCode !!}</p>
  </div>
</div>

<!-- Prtc Result Msg Field -->
<div class="form-group row col-6">
  {!! Form::label('prtcResultMsg', 'Prtc Result Msg:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $payment->prtcResultMsg !!}</p>
  </div>
</div>

<!-- Prtc Tid Field -->
<div class="form-group row col-6">
  {!! Form::label('prtcTid', 'Prtc Tid:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $payment->prtcTid !!}</p>
  </div>
</div>

<!-- Prtc Price Field -->
<div class="form-group row col-6">
  {!! Form::label('prtcPrice', 'Prtc Price:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $payment->prtcPrice !!}</p>
  </div>
</div>

<!-- Prtc Remains Field -->
<div class="form-group row col-6">
  {!! Form::label('prtcRemains', 'Prtc Remains:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $payment->prtcRemains !!}</p>
  </div>
</div>

<!-- Prtc Cnt Field -->
<div class="form-group row col-6">
  {!! Form::label('prtcCnt', 'Prtc Cnt:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $payment->prtcCnt !!}</p>
  </div>
</div>

<!-- Prtc Type Field -->
<div class="form-group row col-6">
  {!! Form::label('prtcType', 'Prtc Type:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $payment->prtcType !!}</p>
  </div>
</div>

<!-- Prtc Date Field -->
<div class="form-group row col-6">
  {!! Form::label('prtcDate', 'Prtc Date:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $payment->prtcDate !!}</p>
  </div>
</div>

<!-- Prtc Time Field -->
<div class="form-group row col-6">
  {!! Form::label('prtcTime', 'Prtc Time:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $payment->prtcTime !!}</p>
  </div>
</div>

<!-- Created At Field -->
<div class="form-group row col-6">
  {!! Form::label('created_at', 'Created At:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $payment->created_at !!}</p>
  </div>
</div>

<!-- Updated At Field -->
<div class="form-group row col-6">
  {!! Form::label('updated_at', 'Updated At:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $payment->updated_at !!}</p>
  </div>
</div>

