@extends('layouts.auth.default')
@section('content')
<br>
<?php 
$user_id = isEmailExpired($email,$token);
?>
@if(isset($user_id))
<p class="login-box-msg">{{ __('messages.Password')." : ".$newPass = RandomNumberGenerator()}}</p>
{{ changePassword($user_id,$newPass) }}
@else
<p class="login-box-msg">{{ __('messages.Page Expired') }}</p>
@endif
@endsection