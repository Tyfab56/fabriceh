@extends('layouts.backend')

@section('title',  __('Users'))

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
					<div class="card-header">{{ __('backend.Tables') }}</div>
					<div class="card-body tabs-area p-0">
						<ul class="tabs-nav">
							<li><a data-tabid="1" class="link-tab active" href="javascript:void(0);"><i class="fa fa-minus"></i>{{ __('Users') }}</a></li>
							<li><a data-tabid="2" class="link-tab active" href="javascript:void(0);"><i class="fa fa-minus"></i>{{ __('Images') }}</a></li>
							<li><a data-tabid="9" class="link-tab active" href="javascript:void(0);"><i class="fa fa-minus"></i>{{ __('Images') }}</a></li>
						</ul>
						<div class="tabs-body">
							<div id="tabId-1" class="tab-link-content tabshow">
								<div class="tabs-head">
									<h4>{{ __('Users') }}</h4>
									<a onclick="onFormPanel(1)" href="javascript:void(0);" class="btn green-btn btn-form float-right"><i class="fa fa-plus"></i> {{ __('Add New') }}</a>
									<a onclick="onListPanel(1)" href="javascript:void(0);" class="btn warning-btn btn-list float-right display-none"><i class="fa fa-reply"></i> {{ __('Back to List') }}</a>
								</div>
								<!--Data grid-->
								<div id="list-panel-tabid-1">
									<div class="row">
										<div class="col-lg-12">
											<div class="table-responsive">
												<table id="DataTable_UsersId" class="table table-striped table-bordered">
													<thead>
														<tr>
															<th class="text-center">{{ __('SL.') }}</th>
															<th class="text-left">{{ __('Name') }}</th>
															<th class="text-left">{{ __('Email') }}</th>
															<th class="text-center">{{ __('Action') }}</th>
														</tr>
													</thead>
													<tbody></tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
								<!--/Data grid-->
								<!--Data Entry Form-->
								<div id="form-panel-tabid-1" class="display-none">
									<form novalidate="" data-validate="parsley" id="DataEntry_formId_1">
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
											<input id="Record_UserId" name="Record_UserId" type="text" class="display-none"/>
											<input name="user_id" type="text" class="display-none" value="{{ Auth::user()->id }}"/>
											<input id="public_path" type="text" class="display-none" value="{{ asset('public') }}"/>
											<!--route-->
											<input id="FileUploadId" type="text" class="display-none" value="{{ route('backend.ProfilePhotoUpload') }}"/>
											<input id="saveUsersId" type="text" class="display-none" value="{{ route('backend.saveUsers') }}"/>
											<input id="getUsersDataId" type="text" class="display-none" value="{{ route('backend.getUsersData') }}"/>
											<input id="UserById" type="text" class="display-none" value="{{ route('backend.getUserById') }}"/>
											<input id="deleteUserId" type="text" class="display-none" value="{{ route('backend.deleteUser') }}"/>
											
											<a data-submitformid="1" class="btn green-btn mr-10 submit-form-class" href="javascript:void(0);">{{ __('Save') }}</a>
											<a onClick="onListPanel(1)" class="btn danger-btn btn-list" href="javascript:void(0);">{{ __('Cancel') }}</a>
										</div>
									</form>
								</div>
								<!--/Data Entry Form/-->
							</div>
							<div id="tabId-2" class="tab-link-content tabhide">
								<div class="tabs-head">
									<h4>{{ __('Blog') }}</h4>
									<a onclick="onFormPanel(2)" href="javascript:void(0);" class="btn green-btn btn-form float-right"><i class="fa fa-plus"></i> {{ __('Add New') }}</a>
									<a onclick="onListPanel(2)" href="javascript:void(0);" class="btn warning-btn btn-list float-right display-none"><i class="fa fa-reply"></i> {{ __('Back to List') }}</a>
								</div>
								<!--Data grid-->
								<div id="list-panel-tabid-2">
									<div class="row">
										<div class="col-lg-12">
											<div class="table-responsive">
												<table id="DataTable_BlogId" class="table table-striped table-bordered">
													<thead>
														<tr>
															<th class="text-center">{{ __('SL.') }}</th>
															<th class="text-left">{{ __('Title') }}</th>
															<th class="text-center">{{ __('Action') }}</th>
														</tr>
													</thead>
													<tbody></tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
								<!--/Data grid-->
								<!--Data Entry Form-->
								<div id="form-panel-tabid-2" class="display-none">
									<form novalidate="" data-validate="parsley" id="DataEntry_formId_2">
										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
													<label for="blog_title"><span class="red">*</span> {{ __('Title') }}</label>
													<input type="text" name="blog_title" id="blog_title" class="form-control parsley-validated" data-required="true">
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<div class="form-group tpeditor">
													<label for="blog_description"><span class="red">*</span> {{ __('Description') }}</label>
													<textarea name="blog_description" id="blog_description" class="form-control parsley-validated" data-required="true" rows="5"></textarea>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
													<label for="blog_image"><span class="red">*</span> {{ __('Blog Image') }}</label>
													<div class="errorMgs display-none" id="blog_image_errorMgs"></div>
													<div class="file_up">
														<input type="text" name="blog_image" id="blog_image" class="form-control parsley-validated" data-required="true" readonly>
														<div class="file_browse_box">
															<input type="file" name="load_blog_image" id="load_blog_image" class="file_browse">
															<label for="load_blog_image" class="file_browse_icon"><i class="fa fa-window-restore"></i>{{ __('Browse') }}</label>
														</div>
													</div>
													<small class="form-text text-muted">{{ __('Blog image size 400x350 pixels or 400x450 pixels') }}</small>
													<div class="file_up_box tp-image-w" id="blog_image_show"></div>
												</div>
											</div>
										</div>
										
										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
													<label for="seo_keywords"> {{ __('SEO Keywords (Separate with commas)') }}</label>
													<textarea name="seo_keywords" id="seo_keywords" class="form-control" rows="3"></textarea>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
													<label for="seo_desc">{{ __('SEO Description (Maximum 150 Characters)') }}</label>
													<textarea name="seo_desc" id="seo_desc" class="form-control" rows="3"></textarea>
												</div>
											</div>
										</div>
										
										<div class="tabs-footer">
											<input id="Record_BlogId" name="Record_BlogId" type="text" class="display-none"/>
											<input name="user_id" type="text" class="display-none" value="{{ Auth::user()->id }}"/>
											<input id="public_path" type="text" class="display-none" value="{{ asset('public') }}"/>
											<!--route-->
											<input id="FileUploadId" type="text" class="display-none" value="{{ route('backend.BlogImageUpload') }}"/>
											<input id="saveBlogId" type="text" class="display-none" value="{{ route('backend.saveBlog') }}"/>
											<input id="getBlogDataId" type="text" class="display-none" value="{{ route('backend.getBlogData') }}"/>
											<input id="BlogById" type="text" class="display-none" value="{{ route('backend.getBlogById') }}"/>
											<input id="deleteBlogId" type="text" class="display-none" value="{{ route('backend.deleteBlog') }}"/>
											
											<a data-submitformid="1" class="btn green-btn mr-10 submit-form-class" href="javascript:void(0);">{{ __('Save') }}</a>
											<a onClick="onListPanel(1)" class="btn danger-btn btn-list" href="javascript:void(0);">{{ __('Cancel') }}</a>
										</div>
									</form>
								</div>
								<!--/Data Entry Form/-->
							</div>
							<div id="tabId-9" class="tab-link-content tabhide">
								<form novalidate="" data-validate="parsley" id="DataEntry_formId_9">
									<div class="row">
										<div class="col-md-12">
											<div class="row">
												<div class="col-md-12">
													<div class="tw_checkbox checkbox_group">
														<input id="is_gmap" name="is_gmap" type="checkbox">
														<label for="is_gmap">{{ __('Enable/Disable') }}</label>
														<span></span>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
													<div class="form-group">
														<label for="api_key"><span class="red">*</span> {{ __('API Key') }}</label>
														<input type="text" name="api_key" id="api_key" class="form-control parsley-validated" data-required="true">
														<small class="form-text text-muted"><a target="_blank" href="https://developers.google.com/maps/documentation/javascript/get-api-key">Get an Google Map API Key</a></small>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-4">
													<div class="form-group">
														<label for="Latitude"><span class="red">*</span> {{ __('Latitude') }}</label>
														<input type="text" name="Latitude" id="Latitude" class="form-control parsley-validated" data-required="true">
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label for="Longitude"><span class="red">*</span> {{ __('Longitude') }}</label>
														<input type="text" name="Longitude" id="Longitude" class="form-control parsley-validated" data-required="true">
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label for="zoom"><span class="red">*</span> {{ __('Zoom') }}</label>
														<input type="text" name="zoom" id="zoom" class="form-control parsley-validated" data-required="true">
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="tabs-footer">
										<!--route-->
										<input id="saveGoogleMapId" type="text" class="display-none" value="{{ route('backend.saveGoogleMap') }}"/>
										<a data-submitformid="8" class="btn green-btn mr-10 submit-form-class" href="javascript:void(0);">{{ __('Save') }}</a>
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
<script src="{{asset('backend/pages/users.js')}}"></script>
@endpush
