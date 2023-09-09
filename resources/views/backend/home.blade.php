@extends('layouts.backend')

@section('title',  __('Home Page'))

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
					<div class="card-header">{{ __('Home Page') }}</div>
					<div class="card-body tabs-area p-0">
						<ul class="tabs-nav">
						    <li><a data-tabid="0" class="link-tab active" href="javascript:void(0);"><i class="fa fa-minus"></i>{{ __('NEW') }}</a></li>
							<li><a data-tabid="1" class="link-tab active" href="javascript:void(0);"><i class="fa fa-minus"></i>{{ __('Homepage Versions') }}</a></li>
							<li><a data-tabid="2" class="link-tab" href="javascript:void(0);"><i class="fa fa-minus"></i>{{ __('Home Content') }}</a></li>
							<li><a data-tabid="3" class="link-tab" href="javascript:void(0);"><i class="fa fa-minus"></i>{{ __('Animated Clip Text') }}</a></li>
						</ul>
						<div class="tabs-body">
						<div id="tabId-0" class="tab-link-content tabshow">
								<div class="row">
									<div class="col-lg-6 mb-30">
									</div>
								</div>
						</div>
                        </div>
						<div class="tabs-body">
							<!--Homepage Versions-->
							<div id="tabId-1" class="tab-link-content tabshow">
								<div class="row">
									<div class="col-lg-6 mb-30">
										<div class="tw-card">
											<div class="tw-card-img">
												<div id="image_background_select" class="tw-card-overlay HomepageVersion display-none"><i class="fa fa-check"></i></div>
												<a onclick="onHomepageVersionAddEdit('image_background')" href="javascript:void(0);"><img src="{{asset('backend/images/home-1.jpg')}}" alt="" /></a>
											</div>
											<div class="tw-card-header"><a onclick="onHomepageVersionAddEdit('image_background')" href="javascript:void(0);">{{ __('Image Background') }}</a></div>
										</div>
									</div>
									<div class="col-lg-6 mb-30">
										<div class="tw-card">
											<div class="tw-card-img">
												<div id="particle_background_select" class="tw-card-overlay HomepageVersion display-none"><i class="fa fa-check"></i></div>
												<a onclick="onHomepageVersionAddEdit('particle_background')" href="javascript:void(0);">
													<img src="{{asset('backend/images/home-2.jpg')}}" alt="" />
												</a>
											</div>
											<div class="tw-card-header"><a onclick="onHomepageVersionAddEdit('particle_background')" href="javascript:void(0);">{{ __('Particle Background') }}</a></div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6 mb-30">
										<div class="tw-card">
											<div class="tw-card-img">
												<div id="video_background_select" class="tw-card-overlay HomepageVersion display-none"><i class="fa fa-check"></i></div>
												<a onclick="onHomepageVersionAddEdit('video_background')" href="javascript:void(0);">
													<img src="{{asset('backend/images/home-3.jpg')}}" alt="" />
												</a>
											</div>
											<div class="tw-card-header"><a onclick="onHomepageVersionAddEdit('video_background')" href="javascript:void(0);">{{ __('Video Background') }}</a></div>
										</div>
									</div>
									<div class="col-lg-6 mb-30">
										<div class="tw-card">
											<div class="tw-card-img">
												<div id="water_fade_background_select" class="tw-card-overlay HomepageVersion display-none"><i class="fa fa-check"></i></div>
												<a onclick="onHomepageVersionAddEdit('water_fade_background')" href="javascript:void(0);">
													<img src="{{asset('backend/images/home-4.jpg')}}" alt="" />
												</a>
											</div>
											<div class="tw-card-header"><a onclick="onHomepageVersionAddEdit('water_fade_background')" href="javascript:void(0);">{{ __('Water Fade Background') }}</a></div>
										</div>
									</div>
								</div>
								<!--Homepage Versions Route and id-->
								<input id="getHomepageVersionId" type="text" class="display-none" value="{{ route('backend.getHomepageVersion') }}"/>
								<input id="saveHomepageVersionId" type="text" class="display-none" value="{{ route('backend.saveHomepageVersion') }}"/>
							</div>
							<!--/Homepage Versions/-->
							
							<!--Home Page-->
							<div id="tabId-2" class="tab-link-content tabhide">
								<form novalidate="" data-validate="parsley" id="DataEntry_formId_2">
									<div class="row">
										<div class="col-lg-8">
											<div class="row">
												<div class="col-md-12">
													<div class="form-group">
														<label for="name"><span class="red">*</span> {{ __('Name') }}</label>
														<input type="text" name="name" id="name" class="form-control parsley-validated" data-required="true">
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
													<div class="form-group">
														<label for="your_photo"><span class="red">*</span> {{ __('Your Photo') }}</label>
														<div class="errorMgs display-none" id="your_photo_errorMgs"></div>
														<div class="file_up">
															<input type="text" name="your_photo" id="your_photo" class="form-control parsley-validated" data-required="true" readonly>
															<div class="file_browse_box">
																<input type="file" name="load_your_photo" id="load_your_photo" class="file_browse">
																<label for="load_your_photo" class="file_browse_icon"><i class="fa fa-window-restore"></i>{{ __('Browse') }}</label>
															</div>
														</div>
														<small class="form-text text-muted">{{ __('Your photo size 300x300 pixels') }}</small>
														<div class="file_up_box tp-image-w" id="your_photo_show"></div>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
													<div class="form-group">
														<label for="background_image"><span class="red">*</span> {{ __('Background Image') }}</label>
														<div class="errorMgs display-none" id="background_errorMgs"></div>
														<div class="file_up">
															<input type="text" name="background_image" id="background_image" class="form-control parsley-validated" data-required="true" readonly>
															<div class="file_browse_box">
																<input type="file" name="load_background" id="load_background" class="file_browse">
																<label for="load_background" class="file_browse_icon"><i class="fa fa-window-restore"></i>{{ __('Browse') }}</label>
															</div>
														</div>
														<small class="form-text text-muted">{{ __('Background image size 1900x1280 pixels') }}</small>
														<div class="file_up_box tp-image-w" id="background_show"></div>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
													<div class="form-group">
														<label for="video_background"><span class="red">*</span> {{ __('Youtube Video Link (For Video Background)') }}</label>
														<input type="text" name="video_background" id="video_background" class="form-control parsley-validated" data-required="true">
													</div>
												</div>
											</div>
										</div>
										<div class="col-lg-4"></div>
									</div>
										
									<div class="tabs-footer">
										<input id="category_Home_Content" name="category_Home_Content" type="text" class="display-none" value="home_content"/>
										<input name="user_id" type="text" class="display-none" value="{{ Auth::user()->id }}"/>
										<input id="public_path" type="text" class="display-none" value="{{ asset('public') }}"/>
										<!--route-->
										<input id="FileUploadId" type="text" class="display-none" value="{{ route('FileUpload.home') }}"/>
										<input id="saveHomeContentId" type="text" class="display-none" value="{{ route('backend.saveHomeContent') }}"/>
										<input id="HomeContentId" type="text" class="display-none" value="{{ route('backend.getHomeContent') }}"/>
										<a data-submitformid="2" class="btn green-btn mr-10 submit-form-class" href="javascript:void(0);">{{ __('Save') }}</a>
									</div>
								</form>
							</div>
							<!--/Home Page/-->
							<!--Animated Clip Text-->
							<div id="tabId-3" class="tab-link-content tabhide">
								<div class="tabs-head">
									<h4>{{ __('Animated Clip Text') }}</h4>
									<a onclick="onFormPanel(3)" href="javascript:void(0);" class="btn green-btn btn-form float-right"><i class="fa fa-plus"></i> {{ __('Add New') }}</a>
									<a onclick="onListPanel(3)" href="javascript:void(0);" class="btn warning-btn btn-list float-right display-none"><i class="fa fa-reply"></i> {{ __('Back to List') }}</a>
								</div>
								<!--Data grid-->
								<div id="list-panel-tabid-3">
									<div class="row">
										<div class="col-lg-12">
											<div class="table-responsive">									
												<table id="DataTable_AnimatedClipTextId" class="table table-striped table-bordered">
													<thead>
														<tr>
															<th class="text-center">{{ __('SL.') }}</th>
															<th class="text-left">{{ __('Clip Text') }}</th>
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
								<div id="form-panel-tabid-3" class="display-none">
									<form novalidate="" data-validate="parsley" id="DataEntry_formId_3">
										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
													<label for="clip_text"><span class="red">*</span> {{ __('Clip Text') }}</label>
													<input type="text" name="clip_text" id="clip_text" class="form-control parsley-validated" data-required="true">
												</div>
											</div>
										</div>
										<div class="tabs-footer">
											<input id="Record_AnimatedClipTextId" name="Record_AnimatedClipTextId" type="text" class="display-none"/>
											<input id="category_animated_clip_text" name="category_animated_clip_text" type="text" class="display-none" value="animated_clip_text"/>
											<input name="user_id" type="text" class="display-none" value="{{ Auth::user()->id }}"/>
											<!--route-->
											<input id="saveAnimatedClipTextId" type="text" class="display-none" value="{{ route('backend.saveAnimatedClipText') }}"/>
											<input id="AnimatedClipTextId" type="text" class="display-none" value="{{ route('backend.getAnimatedClipText') }}"/>
											<input id="AnimatedClipTextById" type="text" class="display-none" value="{{ route('backend.getAnimatedClipTextById') }}"/>
											<input id="AnimatedClipTextDeleteId" type="text" class="display-none" value="{{ route('backend.AnimatedClipTextDelete') }}"/>
											
											<a data-submitformid="3" class="btn green-btn mr-10 submit-form-class" href="javascript:void(0);">{{ __('Save') }}</a>
											<a onClick="onListPanel(3)" class="btn danger-btn btn-list" href="javascript:void(0);">{{ __('Cancel') }}</a>
										</div>
									</form>
								</div>
								<!--/Data Entry Form/-->
							</div>
							<!--/Animated Clip Text/-->
						</div>
					</div>
				</div>
			</div>
		</div><!--/Content/-->
	</div>
@endsection

@push('scripts')
<script src="{{asset('backend/pages/homepage.js')}}"></script>

@endpush
