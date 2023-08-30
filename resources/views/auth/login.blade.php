@extends('layouts.auth')

@php
$SettingsData = gSettings();
@endphp

@section('title',  $SettingsData['site_title'] ? __('Login').' - '.$SettingsData['site_title'] : __('Login').' - Personal Portfolio Laravel')

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
					<form id="login-form" method="POST" action="{{ route('login') }}">
						@csrf
						
						@if($errors->any())
							<ul class="errors-list">
							@foreach($errors->all() as $error)
								<li>{{$error}}</li>
							@endforeach
							</ul>
						@endif
						<div class="form-group">
							<input type="email" id="email" name="email" class="form-control" placeholder="{{ __('Email Address') }}" value="{{ old('email') }}" required autocomplete="email" autofocus>
						</div>
						<div class="form-group">
							<input type="password" id="password" name="password" class="form-control" placeholder="{{ __('Password') }}" required autocomplete="current-password">
						</div>
						<div class="tw_checkbox checkbox_group">
							<input id="remember" name="remember" type="checkbox" {{ old('remember') ? 'checked' : '' }}>
							<label for="remember">{{ __('Remember Me') }}</label>
							<span></span>
						</div>
						<input type="submit" class="btn login-btn" value="{{ __('Login') }}">
					</form>
					@if (Route::has('password.request'))
					<h3><a href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a></h3>
					@endif
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@push('scripts')
@endpush