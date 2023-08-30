@extends('layouts.backend')

@section('title',  __('My Profile'))

@push('style')
@endpush

@section('content')
	<div class="container-fluid">
		<!--Page Heading-->
		<div class="row">
			<div class="col pre-loader">
				<div id="tw-loader" class="tw-loader">
					<div class="tw-ellipsis">
						<div></div><div></div><div></div><div></div>
					</div>						
				</div>
			</div>
		</div>
		<!--/Page Heading/-->
		<!--Content-->
		<div id="tw-content" class="row display-none">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-header">{{ __('My Profile') }}</div>
					<div class="card-body tabs-area p-0">
						<ul class="tabs-nav">
							<li><a class="link-tab active" href="javascript:void(0);"><i class="fa fa-minus"></i>{{ __('My Profile') }}</a></li>
						</ul>
						<div class="tabs-body">
							<div class="tab-link-content">
								<form novalidate="" data-validate="parsley" id="DataEntry_formId">
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label for="name"><span class="red">*</span> {{ __('Name') }}</label>
												<input type="text" name="name" id="name" class="form-control parsley-validated" data-required="true">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label for="email"><span class="red">*</span> {{ __('Email') }}</label>
												<input type="email" name="email" id="email" class="form-control parsley-validated" data-required="true">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group relative">
												<label for="password"><span class="red">*</span> {{ __('Password') }}</label>
												<span toggle="#password" class="fa fa-eye field-icon toggle-password"></span>
												<input type="password" name="password" id="password" class="form-control parsley-validated" data-required="true">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label for="address">{{ __('Address') }}</label>
												<textarea name="address" id="address" class="form-control" rows="3"></textarea>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label for="profile_photo"><span class="red">*</span> {{ __('Profile Photo') }}</label>
												<div class="errorMgs display-none" id="profile_photo_errorMgs"></div>
												<div class="file_up">
													<input type="text" name="profile_photo" id="profile_photo" class="form-control parsley-validated" data-required="true" readonly>
													<div class="file_browse_box">
														<input type="file" name="load_profile_photo" id="load_profile_photo" class="file_browse">
														<label for="load_profile_photo" class="file_browse_icon"><i class="fa fa-window-restore"></i>{{ __('Browse') }}</label>
													</div>
												</div>
												<small class="form-text text-muted">{{ __('Profile photo size 300x300 pixels') }}</small>
												<div class="file_up_box tp-image-w" id="profile_photo_show"></div>
											</div>
										</div>
										<div class="col-md-6"></div>
									</div>
									<div class="tabs-footer">
										<input id="Record_UserId" name="Record_UserId" type="text" class="display-none" value="{{ Auth::user()->id }}"/>
										<input id="public_path" type="text" class="display-none" value="{{ asset('public') }}"/>
										<!--route-->
										<input id="FileUploadId" type="text" class="display-none" value="{{ route('backend.ProfilePhotoUpload') }}"/>
										<input id="saveUsersId" type="text" class="display-none" value="{{ route('backend.saveUsers') }}"/>
										<input id="UserById" type="text" class="display-none" value="{{ route('backend.getUserById') }}"/>

										<a class="btn green-btn mr-10 submit-form-class" href="javascript:void(0);">{{ __('Save') }}</a>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div><!--/Content/-->
	</div>
@endsection

@push('scripts')
<script src="{{asset('backend/pages/profile.js')}}"></script>
@endpush
