@extends('layouts.backend')

@section('title',  __('Settings'))

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
					<div class="card-header">{{ __('Settings') }}</div>
					<div class="card-body tabs-area p-0">
						<ul class="tabs-nav">
							<li><a data-tabid="1" class="link-tab active" href="javascript:void(0);"><i class="fa fa-minus"></i>{{ __('Global Setting') }}</a></li>
							<li><a data-tabid="2" class="link-tab" href="javascript:void(0);"><i class="fa fa-minus"></i>{{ __('Copyright') }}</a></li>
							<li><a data-tabid="3" class="link-tab" href="javascript:void(0);"><i class="fa fa-minus"></i>{{ __('Social Media') }}</a></li>
							<li><a data-tabid="4" class="link-tab" href="javascript:void(0);"><i class="fa fa-minus"></i>{{ __('SEO') }}</a></li>
							<li><a data-tabid="5" class="link-tab" href="javascript:void(0);"><i class="fa fa-minus"></i>{{ __('Color') }}</a></li>
							<li><a data-tabid="6" class="link-tab" href="javascript:void(0);"><i class="fa fa-minus"></i>{{ __('Google reCAPTCHA') }}</a></li>
							<li><a data-tabid="7" class="link-tab" href="javascript:void(0);"><i class="fa fa-minus"></i>{{ __('Contact Form Setting') }}</a></li>
							<li><a data-tabid="8" class="link-tab" href="javascript:void(0);"><i class="fa fa-minus"></i>{{ __('Google Map') }}</a></li>
							<li><a data-tabid="9" class="link-tab" href="javascript:void(0);"><i class="fa fa-minus"></i>Tets</a></li>
						</ul>
						<div class="tabs-body">
							<!--Route for Settings Table Data-->
							<input id="SettingsTableId" type="text" class="display-none" value="{{ route('backend.getSettingsTable') }}"/>
							
							<!--Global Setting-->
							<div id="tabId-1" class="tab-link-content tabshow">
								<form novalidate="" data-validate="parsley" id="DataEntry_formId_1">
									<div class="row">
										<div class="col-md-8">
											<div class="row">
												<div class="col-md-12">
													<div class="form-group">
														<label for="site_title"><span class="red">*</span> {{ __('Site Title') }}</label>
														<input type="text" name="site_title" id="site_title" class="form-control parsley-validated" data-required="true">
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
													<div class="form-group">
														<label for="favicon"><span class="red">*</span> {{ __('Favicon') }}</label>
														<div class="errorMgs display-none" id="favicon_errorMgs"></div>
														<div class="file_up">
															<input type="text" name="favicon" id="favicon" class="form-control parsley-validated" data-required="true" readonly>
															<div class="file_browse_box">
																<input type="file" name="load_favicon" id="load_favicon" class="file_browse">
																<label for="load_favicon" class="file_browse_icon"><i class="fa fa-window-restore"></i>{{ __('Browse') }}</label>
															</div>
														</div>
														<small class="form-text text-muted">{{ __('favicon.ico 32x32 pixels') }}. <a target="_blank" href="https://www.favicon-generator.org/">Favicon Generator</a></small>
														<div class="file_up_box favicon-w" id="favicon_show"></div>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
													<div class="form-group">
														<label for="front_logo"><span class="red">*</span> {{ __('Front Logo') }}</label>
														<div class="errorMgs display-none" id="front_logo_errorMgs"></div>
														<div class="file_up">
															<input type="text" name="front_logo" id="front_logo" class="form-control parsley-validated" data-required="true" readonly>
															<div class="file_browse_box">
																<input type="file" name="load_front_logo" id="load_front_logo" class="file_browse">
																<label for="load_front_logo" class="file_browse_icon"><i class="fa fa-window-restore"></i>{{ __('Browse') }}</label>
															</div>
														</div>
														<small class="form-text text-muted">{{ __('Front logo size 100x35 pixels') }}</small>
														<div class="file_up_box logo-w" id="front_logo_show"></div>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
													<div class="form-group">
														<label for="back_logo"><span class="red">*</span> {{ __('Back Logo') }}</label>
														<div class="errorMgs display-none" id="back_logo_errorMgs"></div>
														<div class="file_up">
															<input type="text" name="back_logo" id="back_logo" class="form-control parsley-validated" data-required="true" readonly>
															<div class="file_browse_box">
																<input type="file" name="load_back_logo" id="load_back_logo" class="file_browse">
																<label for="load_back_logo" class="file_browse_icon"><i class="fa fa-window-restore"></i>{{ __('Browse') }}</label>
															</div>
														</div>
														<small class="form-text text-muted">{{ __('Back logo size 100x35 pixels') }}</small>
														<div class="file_up_box logo-w" id="back_logo_show"></div>
													</div>
												</div>
											</div>
										</div>
										<div class="col-md-4"></div>
									</div>
									<div class="tabs-footer">
										<input id="public_path" type="text" class="display-none" value="{{ asset('public') }}"/>
										<!--route-->
										<input id="FileUploadId" type="text" class="display-none" value="{{ route('backend.LogoUpload') }}"/>
										<input id="saveGlobalSettingId" type="text" class="display-none" value="{{ route('backend.saveGlobalSetting') }}"/>
										<a data-submitformid="1" class="btn green-btn mr-10 submit-form-class" href="javascript:void(0);">{{ __('Save') }}</a>
									</div>
								</form>
							</div>
							<!--/Global Setting/-->
							<!--Copyright-->
							<div id="tabId-2" class="tab-link-content tabhide">
								<form novalidate="" data-validate="parsley" id="DataEntry_formId_2">
									<div class="row">
										<div class="col-md-8">
											<div class="row">
												<div class="col-md-12">
													<div class="form-group">
														<label for="copyright"><span class="red">*</span> {{ __('Copyright') }}</label>
														<input type="text" name="copyright" id="copyright" class="form-control parsley-validated" data-required="true">
													</div>
												</div>
											</div>
										</div>
										<div class="col-md-4"></div>
									</div>
									<div class="tabs-footer">
										<!--route-->
										<input id="saveCopyrightId" type="text" class="display-none" value="{{ route('backend.saveCopyright') }}"/>
										<a data-submitformid="2" class="btn green-btn mr-10 submit-form-class" href="javascript:void(0);">{{ __('Save') }}</a>
									</div>
								</form>
							</div>
							<!--/Copyright/-->
							<!--Social Media-->
							<div id="tabId-3" class="tab-link-content tabhide">
								<form novalidate="" data-validate="parsley" id="DataEntry_formId_3">
									<div class="row">
										<div class="col-md-8">
											<div class="row">
												<div class="col-md-12">
													<div class="form-group">
														<label for="twitter">{{ __('Twitter') }}</label>
														<input type="text" name="twitter" id="twitter" class="form-control">
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
													<div class="form-group">
														<label for="facebook">{{ __('Facebook') }}</label>
														<input type="text" name="facebook" id="facebook" class="form-control">
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
													<div class="form-group">
														<label for="linkedin">{{ __('Linkedin') }}</label>
														<input type="text" name="linkedin" id="linkedin" class="form-control">
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
													<div class="form-group">
														<label for="github">{{ __('Github') }}</label>
														<input type="text" name="github" id="github" class="form-control">
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
													<div class="form-group">
														<label for="instagram">{{ __('Instagram') }}</label>
														<input type="text" name="instagram" id="instagram" class="form-control">
													</div>
												</div>
											</div>
										</div>
										<div class="col-md-4"></div>
									</div>
									<div class="tabs-footer">
										<!--route-->
										<input id="saveSocialMediaId" type="text" class="display-none" value="{{ route('backend.saveSocialMedia') }}"/>
										<a data-submitformid="3" class="btn green-btn mr-10 submit-form-class" href="javascript:void(0);">{{ __('Save') }}</a>
									</div>
								</form>
							</div>
							<!--/Social Media/-->
							
							<!--SEO-->
							<div id="tabId-4" class="tab-link-content tabhide">
								<form novalidate="" data-validate="parsley" id="DataEntry_formId_4">
									<div class="row">
										<div class="col-md-8">
											<div class="row">
												<div class="col-md-12">
													<div class="form-group">
														<label for="seo_site_name"><span class="red">*</span> {{ __('Site Name (Maximum 70 Characters)') }}</label>
														<input type="text" name="seo_site_name" id="seo_site_name" class="form-control parsley-validated" data-required="true">
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
													<div class="form-group">
														<label for="seo_keywords"><span class="red">*</span> {{ __('Keywords (Separate with commas)') }}</label>
														<textarea name="seo_keywords" id="seo_keywords" class="form-control parsley-validated" data-required="true" rows="4"></textarea>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
													<div class="form-group">
														<label for="seo_description"><span class="red">*</span> {{ __('Description (Maximum 150 Characters)') }}</label>
														<textarea name="seo_description" id="seo_description" class="form-control parsley-validated" data-required="true" rows="4"></textarea>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
													<div class="form-group">
														<label for="seo_url"><span class="red">*</span> {{ __('Site URL') }}</label>
														<input type="url" name="seo_url" id="seo_url" class="form-control parsley-validated" data-required="true" placeholder="http://domainname.com">
														<small class="form-text text-muted">e.g. <strong>http://domainname.com</strong></small>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
													<div class="form-group">
														<label for="seo_app_id">Fb:app_id (<a target="_blank" href="https://developers.facebook.com/docs/apps/">Generator App Id</a>)</label>
														<input type="text" name="seo_app_id" id="seo_app_id" class="form-control" placeholder="123419926288445">
														<small class="form-text text-muted">e.g. <strong>App Id: 123419926288445</strong></small>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
													<div class="form-group">
														<label for="seo_twitter_site">Twitter:site (<a target="_blank" href="https://twitter.com">Twitter</a>)</label>
														<input type="text" name="seo_twitter_site" id="seo_twitter_site" class="form-control" placeholder="@yourname">
														<small class="form-text text-muted">e.g. <strong>@yourname</strong></small>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
													<div class="form-group">
														<label for="seo_cover_image"><span class="red">*</span> {{ __('SEO Cover Image') }}</label>
														<div class="errorMgs display-none" id="seo_cover_image_errorMgs"></div>
														<div class="file_up">
															<input type="text" name="seo_cover_image" id="seo_cover_image" class="form-control parsley-validated" data-required="true" readonly>
															<div class="file_browse_box">
																<input type="file" name="load_seo_cover_image" id="load_seo_cover_image" class="file_browse">
																<label for="load_seo_cover_image" class="file_browse_icon"><i class="fa fa-window-restore"></i>{{ __('Browse') }}</label>
															</div>
														</div>
														<small class="form-text text-muted">{{ __('SEO cover image size 600x315 pixels') }}</small>
														<div class="file_up_box logo-w" id="seo_cover_image_show"></div>
													</div>
												</div>
											</div>
										</div>
										<div class="col-md-4"></div>
									</div>
									<div class="tabs-footer">
										<!--route-->
										<input id="saveMetaTagId" type="text" class="display-none" value="{{ route('backend.saveMetaTag') }}"/>
										<a data-submitformid="4" class="btn green-btn mr-10 submit-form-class" href="javascript:void(0);">{{ __('Save') }}</a>
									</div>
								</form>
							</div>
							<!--/SEO/-->
							
							<!--Color-->
							<div id="tabId-5" class="tab-link-content tabhide">
								<form novalidate="" data-validate="parsley" id="DataEntry_formId_5">
									<div class="row">
										<div class="col-md-8">
											<div class="row">
												<div class="col-md-12">
													<div class="tpdivider">{{ __('Frontend Theme Color') }}</div>

													<div class="form-group">
														<label><span class="red">*</span> {{ __('Background Color') }}</label>
														<div class="input-group tw-picker" id="themeBackgroundColor">
															<input name="theme_background_color" id="theme_background_color" type="text" value="#111111" class="form-control"/>
															<span class="input-group-addon"><i></i></span>
														</div>
													</div>
													<div class="form-group">
														<label><span class="red">*</span> {{ __('Text Color') }}</label>
														<div class="input-group tw-picker" id="themeTextColor">
															<input name="theme_text_color" id="theme_text_color" type="text" value="#a6a6a6" class="form-control"/>
															<span class="input-group-addon"><i></i></span>
														</div>
													</div>
													<div class="form-group">
														<label><span class="red">*</span> {{ __('Hover Color') }}</label>
														<div class="input-group tw-picker" id="themeHoverColor">
															<input name="theme_hover_color" id="theme_hover_color" type="text" value="#ffffff" class="form-control"/>
															<span class="input-group-addon"><i></i></span>
														</div>
													</div>
													<div class="form-group">
														<label><span class="red">*</span> {{ __('Heading Color') }}</label>
														<div class="input-group tw-picker" id="themeHeadingColor">
															<input name="theme_heading_color" id="theme_heading_color" type="text" value="#dddddd" class="form-control"/>
															<span class="input-group-addon"><i></i></span>
														</div>
													</div>
													
													<div class="form-group">
														<label><span class="red">*</span> {{ __('Home and Portfolio Background Color') }}</label>
														<div class="input-group tw-picker" id="hpBackgroundColor">
															<input name="hp_background_color" id="hp_background_color" type="text" value="rgba(0, 0, 0, 0.8)" class="form-control"/>
															<span class="input-group-addon"><i></i></span>
														</div>
													</div>
													
													<div class="form-group">
														<label><span class="red">*</span> {{ __('Avater Image Border Color') }}</label>
														<div class="input-group tw-picker" id="avaterBorderColor">
															<input name="avater_border_color" id="avater_border_color" type="text" value="rgba(255, 255, 255, 0.2)" class="form-control"/>
															<span class="input-group-addon"><i></i></span>
														</div>
													</div>
													
													<div class="form-group">
														<label><span class="red">*</span> {{ __('Progress bar fill color') }}</label>
														<div class="input-group tw-picker" id="fillColor">
															<input name="fill_color" id="fill_color" type="text" value="#4f4f4f" class="form-control"/>
															<span class="input-group-addon"><i></i></span>
														</div>
													</div>
													<div class="tpdivider">{{ __('Backend Theme Color') }}</div>
													
													<div class="form-group">
														<label><span class="red">*</span> {{ __('Background Color') }}</label>
														<div class="input-group tw-picker" id="backendBackgroundColor">
															<input name="backend_background_color" id="backend_background_color" type="text" value="#111111" class="form-control"/>
															<span class="input-group-addon"><i></i></span>
														</div>
													</div>
													<div class="form-group">
														<label><span class="red">*</span> {{ __('Text Color') }}</label>
														<div class="input-group tw-picker" id="backendTextColor">
															<input name="backend_text_color" id="backend_text_color" type="text" value="#a6a6a6" class="form-control"/>
															<span class="input-group-addon"><i></i></span>
														</div>
													</div>
													
												</div>
											</div>
										</div>
										<div class="col-md-4"></div>
									</div>
									<div class="tabs-footer">
										<!--route-->
										<input id="saveColorId" type="text" class="display-none" value="{{ route('backend.saveColor') }}"/>
										<a data-submitformid="5" class="btn green-btn mr-10 submit-form-class" href="javascript:void(0);">{{ __('Save') }}</a>
									</div>
								</form>
							</div>
							<!--/Color/-->
							
							<!--Google reCAPTCHA-->
							<div id="tabId-6" class="tab-link-content tabhide">
								<form novalidate="" data-validate="parsley" id="DataEntry_formId_6">
									<div class="row">
										<div class="col-md-8">
											<div class="row">
												<div class="col-md-12">
													<div class="tw_checkbox checkbox_group">
														<input id="recaptcha" name="recaptcha" type="checkbox">
														<label for="recaptcha">{{ __('Enable/Disable') }}</label>
														<span></span>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
													<div class="form-group">
														<label for="sitekey"><span class="red">*</span> {{ __('Site Key') }}</label>
														<input type="text" name="sitekey" id="sitekey" class="form-control parsley-validated" data-required="true">
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
													<div class="form-group">
														<label for="secretkey"><span class="red">*</span> {{ __('Secret Key') }}</label>
														<input type="text" name="secretkey" id="secretkey" class="form-control parsley-validated" data-required="true">
														<small class="form-text text-muted"><a target="_blank" href="https://www.google.com/recaptcha/admin/create">Create Google reCAPTCHA v2</a></small>
													</div>
												</div>
											</div>
										</div>
										<div class="col-md-4"></div>
									</div>
									<div class="tabs-footer">
										<!--route-->
										<input id="saveGooglereCAPTCHAId" type="text" class="display-none" value="{{ route('backend.saveGooglereCAPTCHA') }}"/>
										<a data-submitformid="6" class="btn green-btn mr-10 submit-form-class" href="javascript:void(0);">{{ __('Save') }}</a>
									</div>
								</form>
							</div>
							<!--/Google reCAPTCHA/-->
							
							<!--Contact Form Setting-->
							<div id="tabId-7" class="tab-link-content tabhide">
								<form novalidate="" data-validate="parsley" id="DataEntry_formId_7">
									<div class="row">
										<div class="col-md-12">
											<div class="row">
												<div class="col-md-12">
													<div class="tw_checkbox checkbox_group">
														<input id="ismail" name="ismail" type="checkbox">
														<label for="ismail">{{ __('Enable/Disable') }}</label>
														<span></span>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<label for="fromname"><span class="red">*</span> {{ __('From Name') }}</label>
														<input type="text" name="fromname" id="fromname" class="form-control parsley-validated" data-required="true">
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label for="frommailaddress"><span class="red">*</span> {{ __('From Mail Address') }}</label>
														<input type="text" name="frommailaddress" id="frommailaddress" class="form-control parsley-validated" data-required="true">
														<small class="form-text text-muted">The mail address must be a webmail address. e.g. <strong>admin@companyname.com</strong></small>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<label for="toname"><span class="red">*</span> {{ __('To Name') }}</label>
														<input type="text" name="toname" id="toname" class="form-control parsley-validated" data-required="true">
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label for="tomailaddress"><span class="red">*</span> {{ __('To Mail Address') }}</label>
														<input type="text" name="tomailaddress" id="tomailaddress" class="form-control parsley-validated" data-required="true">
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="tabs-footer">
										<!--route-->
										<input id="saveContactFormSettingId" type="text" class="display-none" value="{{ route('backend.saveContactFormSetting') }}"/>
										<a data-submitformid="7" class="btn green-btn mr-10 submit-form-class" href="javascript:void(0);">{{ __('Save') }}</a>
									</div>
								</form>
							</div>
							<!--/Contact Form Setting/-->
							
							<!--Google Map-->
							<div id="tabId-8" class="tab-link-content tabhide">
								<form novalidate="" data-validate="parsley" id="DataEntry_formId_8">
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
							<!--/Google Map/-->
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
<script src="{{asset('backend/pages/settingspage.js')}}"></script>
@endpush
