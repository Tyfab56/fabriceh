@extends('layouts.auth')

@php
$SettingsData = gSettings();
@endphp

@section('title',  $SettingsData['site_title'] ? __('Reset Password').' - '.$SettingsData['site_title'] : __('Reset Password').' - Personal Portfolio Laravel')

@push('style')
@endpush

@section('content')
<div class="loginsignup-area">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="login text-center">
					<div class="logo">
						<a href="{{ route('login') }}">
							<img src="{{ $SettingsData['back_logo'] ? asset('media/'.$SettingsData['back_logo']) : asset('backend/images/logo.png') }}">
						</a>
					</div>
					<form method="POST" action="{{ route('password.update') }}">
						@csrf
						
						@if($errors->any())
							<ul class="errors-list">
							@foreach($errors->all() as $error)
								<li>{{$error}}</li>
							@endforeach
							</ul>
						@endif
						
						<input type="hidden" name="token" value="{{ $token }}">
						
						<div class="form-group">
							<input type="email" id="email" name="email" class="form-control" placeholder="{{ __('Email Address') }}" value="{{ old('email') }}" required autocomplete="email" autofocus>
						</div>
						<div class="form-group">
							<input type="password" id="password" name="password" class="form-control" placeholder="{{ __('Password') }}" required autocomplete="new-password">
						</div>
						<div class="form-group">
							<input type="password" id="password-confirm" name="password_confirmation" class="form-control" placeholder="{{ __('Confirm Password') }}"  required autocomplete="new-password">
						</div>
						<input type="submit" class="btn login-btn" value="{{ __('Reset Password') }}">
					</form>
					<h3><a href="{{ route('login') }}">{{ __('Back to login') }}</a></h3>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@push('scripts')
@endpush
