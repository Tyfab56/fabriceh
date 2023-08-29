@extends('layouts.backend')

@section('title',  __('About Page'))

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
					<div class="card-header">{{ __('About Page') }}</div>
					<div class="card-body tabs-area p-0">
						<ul class="tabs-nav">
							<li><a data-tabid="1" class="link-tab active" href="javascript:void(0);"><i class="fa fa-minus"></i>{{ __('About') }}</a></li>
							<li><a data-tabid="2" class="link-tab" href="javascript:void(0);"><i class="fa fa-minus"></i>{{ __('Education') }}</a></li>
							<li><a data-tabid="3" class="link-tab" href="javascript:void(0);"><i class="fa fa-minus"></i>{{ __('Experience') }}</a></li>
							<li><a data-tabid="4" class="link-tab" href="javascript:void(0);"><i class="fa fa-minus"></i>{{ __('My Skills') }}</a></li>
						</ul>
						<div class="tabs-body">
							<!--About-->
							<div id="tabId-1" class="tab-link-content tabshow">
								<form novalidate="" data-validate="parsley" id="DataEntry_formId_1">
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label for="about_title"><span class="red">*</span> {{ __('Title') }}</label>
												<input type="text" name="about_title" id="about_title" class="form-control parsley-validated" data-required="true">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group tpeditor">
												<label for="about_description"><span class="red">*</span> {{ __('Description') }}</label>
												<textarea name="about_description" id="about_description" class="form-control parsley-validated" data-required="true" rows="5"></textarea>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label for="about_name"><span class="red">*</span> {{ __('Name') }}</label>
												<input type="text" name="about_name" id="about_name" class="form-control parsley-validated" data-required="true">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label for="about_email"><span class="red">*</span> {{ __('Email') }}</label>
												<input type="email" name="about_email" id="about_email" class="form-control parsley-validated" data-required="true">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label for="about_skype"><span class="red">*</span> {{ __('Skype') }}</label>
												<input type="text" name="about_skype" id="about_skype" class="form-control parsley-validated" data-required="true">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label for="about_phone"><span class="red">*</span> {{ __('Phone') }}</label>
												<input type="text" name="about_phone" id="about_phone" class="form-control parsley-validated" data-required="true">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label for="about_experience">{{ __('Experience') }}</label>
												<input type="text" name="about_experience" id="about_experience" class="form-control">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label for="about_address"><span class="red">*</span> {{ __('Address') }}</label>
												<input type="text" name="about_address" id="about_address" class="form-control parsley-validated" data-required="true">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label for="about_hire_me">{{ __('URL (For Hire Me)') }}</label>
												<input type="url" name="about_hire_me" id="about_hire_me" class="form-control">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
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
												<small class="form-text text-muted">{{ __('Your photo size 540x650 pixels') }}</small>
												<div class="file_up_box tp-image-w" id="your_photo_show"></div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label for="download_cv"><span class="red">*</span> {{ __('Upload your CV') }}</label>
												<div class="errorMgs display-none" id="download_cv_errorMgs"></div>
												<div class="file_up">
													<input type="text" name="download_cv" id="download_cv" class="form-control parsley-validated" data-required="true" readonly>
													<div class="file_browse_box">
														<input type="file" name="load_download_cv" id="load_download_cv" class="file_browse">
														<label for="load_download_cv" class="file_browse_icon"><i class="fa fa-window-restore"></i>{{ __('Browse') }}</label>
													</div>
												</div>
												<div class="file_up_box" id="download_cv_show"></div>
											</div>
										</div>
									</div>

									<div class="tabs-footer">
										<input id="category_about" name="category_about" type="text" class="display-none" value="about"/>
										<input name="user_id" type="text" class="display-none" value="{{ Auth::user()->id }}"/>
										<input id="public_path" type="text" class="display-none" value="{{ asset('public') }}"/>
										<!--route-->
										<input id="FileUploadId" type="text" class="display-none" value="{{ route('backend.ImageUpload') }}"/>
										<input id="FileAttachmentId" type="text" class="display-none" value="{{ route('backend.FileAttachment') }}"/>
										<input id="saveAboutId" type="text" class="display-none" value="{{ route('backend.saveAbout') }}"/>
										<input id="AboutId" type="text" class="display-none" value="{{ route('backend.getAboutbyCategory') }}"/>
										<a data-submitformid="1" class="btn green-btn mr-10 submit-form-class" href="javascript:void(0);">{{ __('Save') }}</a>
									</div>
								</form>
							</div>
							<!--/About/-->
							<!--Education-->
							<div id="tabId-2" class="tab-link-content tabhide">
								<div class="tabs-head">
									<h4>{{ __('Education') }}</h4>
									<a onclick="onFormPanel(2)" href="javascript:void(0);" class="btn green-btn btn-form float-right"><i class="fa fa-plus"></i> {{ __('Add New') }}</a>
									<a onclick="onListPanel(2)" href="javascript:void(0);" class="btn warning-btn btn-list float-right display-none"><i class="fa fa-reply"></i> {{ __('Back to List') }}</a>
								</div>
								<!--Data grid-->
								<div id="list-panel-tabid-2">
									<div class="row">
										<div class="col-lg-12">
											<div class="table-responsive">									
												<table id="DataTable_EducationId" class="table table-striped table-bordered">
													<thead>
														<tr>
															<th class="text-center">{{ __('SL.') }}</th>
															<th class="text-left">{{ __('Education Title') }}</th>
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
											<div class="col-md-8">
												<div class="form-group">
													<label for="education_title"><span class="red">*</span> {{ __('Education Title') }}</label>
													<input type="text" name="education_title" id="education_title" class="form-control parsley-validated" data-required="true">
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label for="education_year"><span class="red">*</span> {{ __('Education Year') }}</label>
													<input type="text" name="education_year" id="education_year" class="form-control parsley-validated" data-required="true">
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
													<label for="education_description"><span class="red">*</span> {{ __('Education Description') }}</label>
													<textarea name="education_description" id="education_description" class="form-control parsley-validated" data-required="true" rows="3"></textarea>
												</div>
											</div>
										</div>
										<div class="tabs-footer">
											<input id="Record_educationId" name="Record_educationId" type="text" class="display-none"/>
											<input id="category_education" name="category_education" type="text" class="display-none" value="education"/>
											<input name="user_id" type="text" class="display-none" value="{{ Auth::user()->id }}"/>
											<!--route-->
											<input id="saveEducationId" type="text" class="display-none" value="{{ route('backend.saveEducation') }}"/>
											<input id="getEducationId" type="text" class="display-none" value="{{ route('backend.getEducation') }}"/>
											<input id="EducationById" type="text" class="display-none" value="{{ route('backend.getEducationById') }}"/>
											<input id="deleteEducationId" type="text" class="display-none" value="{{ route('backend.deleteEducation') }}"/>
											
											<a data-submitformid="2" class="btn green-btn mr-10 submit-form-class" href="javascript:void(0);">{{ __('Save') }}</a>
											<a onClick="onListPanel(2)" class="btn danger-btn btn-list" href="javascript:void(0);">{{ __('Cancel') }}</a>
										</div>
									</form>
								</div>
								<!--/Data Entry Form/-->
							</div>
							<!--/Education/-->
							<!--Experience-->
							<div id="tabId-3" class="tab-link-content tabhide">
								<div class="tabs-head">
									<h4>{{ __('Experience') }}</h4>
									<a onclick="onFormPanel(3)" href="javascript:void(0);" class="btn green-btn btn-form float-right"><i class="fa fa-plus"></i> {{ __('Add New') }}</a>
									<a onclick="onListPanel(3)" href="javascript:void(0);" class="btn warning-btn btn-list float-right display-none"><i class="fa fa-reply"></i> {{ __('Back to List') }}</a>
								</div>
								<!--Data grid-->
								<div id="list-panel-tabid-3">
									<div class="row">
										<div class="col-lg-12">
											<div class="table-responsive">									
												<table id="DataTable_ExperienceId" class="table table-striped table-bordered">
													<thead>
														<tr>
															<th class="text-center">{{ __('SL.') }}</th>
															<th class="text-left">{{ __('Experience Title') }}</th>
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
											<div class="col-md-8">
												<div class="form-group">
													<label for="experience_title"><span class="red">*</span> {{ __('Experience Title') }}</label>
													<input type="text" name="experience_title" id="experience_title" class="form-control parsley-validated" data-required="true">
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label for="experience_year"><span class="red">*</span> {{ __('Experience Year') }}</label>
													<input type="text" name="experience_year" id="experience_year" class="form-control parsley-validated" data-required="true">
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
													<label for="experience_description"><span class="red">*</span> {{ __('Experience Description') }}</label>
													<textarea name="experience_description" id="experience_description" class="form-control parsley-validated" data-required="true" rows="3"></textarea>
												</div>
											</div>
										</div>
										<div class="tabs-footer">
											<input id="Record_ExperienceId" name="Record_ExperienceId" type="text" class="display-none"/>
											<input id="category_experience" name="category_experience" type="text" class="display-none" value="experience"/>
											<input name="user_id" type="text" class="display-none" value="{{ Auth::user()->id }}"/>
											<!--route-->
											<input id="saveExperienceId" type="text" class="display-none" value="{{ route('backend.saveExperience') }}"/>
											<input id="getExperienceId" type="text" class="display-none" value="{{ route('backend.getExperience') }}"/>
											<input id="ExperienceById" type="text" class="display-none" value="{{ route('backend.getExperienceById') }}"/>
											<input id="deleteExperienceId" type="text" class="display-none" value="{{ route('backend.deleteExperience') }}"/>
											
											<a data-submitformid="3" class="btn green-btn mr-10 submit-form-class" href="javascript:void(0);">{{ __('Save') }}</a>
											<a onClick="onListPanel(3)" class="btn danger-btn btn-list" href="javascript:void(0);">{{ __('Cancel') }}</a>
										</div>
									</form>
								</div>
								<!--/Data Entry Form/-->
							</div>
							<!--/Experience/-->
							<!--My Skills-->
							<div id="tabId-4" class="tab-link-content tabhide">
								<div class="tabs-head">
									<h4>{{ __('My Skills') }}</h4>
									<a onclick="onFormPanel(4)" href="javascript:void(0);" class="btn green-btn btn-form float-right"><i class="fa fa-plus"></i> {{ __('Add New') }}</a>
									<a onclick="onListPanel(4)" href="javascript:void(0);" class="btn warning-btn btn-list float-right display-none"><i class="fa fa-reply"></i> {{ __('Back to List') }}</a>
								</div>
								<!--Data grid-->
								<div id="list-panel-tabid-4">
									<div class="row">
										<div class="col-lg-12">
											<div class="table-responsive">									
												<table id="DataTable_MySkillsId" class="table table-striped table-bordered">
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
								<div id="form-panel-tabid-4" class="display-none">
									<form novalidate="" data-validate="parsley" id="DataEntry_formId_4">						
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label for="skill_title"><span class="red">*</span> {{ __('Title') }}</label>
													<input type="text" name="skill_title" id="skill_title" class="form-control parsley-validated" data-required="true">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label for="skill_percentage"><span class="red">*</span> {{ __('Percentage') }}</label>
													<input type="number" name="skill_percentage" id="skill_percentage" class="form-control parsley-validated" data-required="true">
												</div>
											</div>
										</div>
										<div class="tabs-footer">
											<input id="Record_MySkillsId" name="Record_MySkillsId" type="text" class="display-none"/>
											<input id="category_MySkills" name="category_MySkills" type="text" class="display-none" value="my_skills"/>
											<input name="user_id" type="text" class="display-none" value="{{ Auth::user()->id }}"/>
											<!--route-->
											<input id="saveMySkillsId" type="text" class="display-none" value="{{ route('backend.saveMySkills') }}"/>
											<input id="getMySkillsId" type="text" class="display-none" value="{{ route('backend.getMySkills') }}"/>
											<input id="MySkillsById" type="text" class="display-none" value="{{ route('backend.getMySkillsById') }}"/>
											<input id="deleteMySkillsId" type="text" class="display-none" value="{{ route('backend.deleteMySkills') }}"/>
											
											<a data-submitformid="4" class="btn green-btn mr-10 submit-form-class" href="javascript:void(0);">{{ __('Save') }}</a>
											<a onClick="onListPanel(4)" class="btn danger-btn btn-list" href="javascript:void(0);">{{ __('Cancel') }}</a>
										</div>
									</form>
								</div>
								<!--/Data Entry Form/-->
							</div>
							<!--/My Skills/-->
						</div>
					</div>
				</div>
			</div>
		</div><!--/Content/-->
	</div>
@endsection

@push('scripts')
<script src="{{asset('public/backend/pages/aboutpage.js')}}"></script>
@endpush
