@extends('layouts.backend')

@section('title',  __('Contact Page'))

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
		<!--Contact-->
		<div id="tw-content" class="row display-none">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-header">{{ __('Contact Page') }}</div>
					<div class="card-body tabs-area p-0">
						<ul class="tabs-nav">
							<li><a data-tabid="1" class="link-tab active" href="javascript:void(0);"><i class="fa fa-minus"></i>{{ __('Contact') }}</a></li>
						</ul>
						<div class="tabs-body">
							<!--About-->
							<div id="tabId-1" class="tab-link-content tabshow">
								<form novalidate="" data-validate="parsley" id="DataEntry_formId_1">
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label for="contact_title">{{ __('Contact Info') }}</label>
												<input type="text" name="contact_title" id="contact_title" class="form-control">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label for="contact_email"><span class="red">*</span> {{ __('Email') }}</label>
												<input type="email" name="contact_email" id="contact_email" class="form-control parsley-validated" data-required="true">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label for="contact_skype"><span class="red">*</span> {{ __('Skype') }}</label>
												<input type="text" name="contact_skype" id="contact_skype" class="form-control parsley-validated" data-required="true">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label for="contact_phone"><span class="red">*</span> {{ __('Phone') }}</label>
												<input type="text" name="contact_phone" id="contact_phone" class="form-control parsley-validated" data-required="true">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label for="contact_address"><span class="red">*</span> {{ __('Address') }}</label>
												<input type="text" name="contact_address" id="contact_address" class="form-control parsley-validated" data-required="true">
											</div>
										</div>
									</div>
									
									<div class="tabs-footer">
										<input id="category_contact" name="category_contact" type="text" class="display-none" value="contact"/>
										<input name="user_id" type="text" class="display-none" value="{{ Auth::user()->id }}"/>
										<input id="public_path" type="text" class="display-none" value="{{ asset('public') }}"/>
										<!--route-->
										<input id="saveContactId" type="text" class="display-none" value="{{ route('backend.saveContact') }}"/>
										<input id="ContactId" type="text" class="display-none" value="{{ route('backend.getContactbyCategory') }}"/>
										<a data-submitformid="1" class="btn green-btn mr-10 submit-form-class" href="javascript:void(0);">{{ __('Save') }}</a>
									</div>
								</form>
							</div>
							<!--/Contact/-->
						</div>
					</div>
				</div>
			</div>
		</div><!--/Content/-->
	</div>
@endsection

@push('scripts')
<script src="{{asset('backend/pages/contactpage.js')}}"></script>
@endpush
