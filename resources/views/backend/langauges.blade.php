@extends('layouts.backend')

@section('title',  __('Langauges'))

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
					<div class="card-header">{{ __('Langauges') }}</div>
					<div class="card-body tabs-area p-0">
						<ul class="tabs-nav">
							<li><a data-tabid="1" class="link-tab active" href="javascript:void(0);"><i class="fa fa-minus"></i>{{ __('Langauges') }}</a></li>
							<li><a data-tabid="2" class="link-tab" href="javascript:void(0);"><i class="fa fa-minus"></i>{{ __('Language Keywords') }}</a></li>
						</ul>
						<div class="tabs-body">
							<!--Langauges-->
							<div id="tabId-1" class="tab-link-content tabshow">
								<div class="tabs-head">
									<h4>{{ __('Langauges') }}</h4>
									<a onclick="onFormPanel(1)" href="javascript:void(0);" class="btn green-btn btn-form float-right"><i class="fa fa-plus"></i> {{ __('Add New') }}</a>
									<a onclick="onListPanel(1)" href="javascript:void(0);" class="btn warning-btn btn-list float-right display-none"><i class="fa fa-reply"></i> {{ __('Back to List') }}</a>
								</div>
								<!--Data grid-->
								<div id="list-panel-tabid-1">
									<div class="row">
										<div class="col-lg-12">
											<div class="table-responsive">
												<table id="DataTable_LangaugeId" class="table table-striped table-bordered">
													<thead>
														<tr>
															<th class="text-center">{{ __('SL.') }}</th>
															<th class="text-left">{{ __('Language Code') }}</th>
															<th class="text-left">{{ __('Language Name') }}</th>
															<th class="text-left">{{ __('Active Language') }}</th>
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
											<div class="col-md-6">
												<div class="form-group">
													<label for="language_code"><span class="red">*</span> {{ __('Language Code') }}</label>
													<input type="text" name="language_code" id="language_code" class="form-control parsley-validated" data-required="true">
													<small class="form-text text-muted">Example: af, bn, en, fr, pt (<a target="_blank" href="https://en.wikipedia.org/wiki/List_of_ISO_639-1_codes">List of Langauges name and Codes</a>) </small>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label for="language_name"><span class="red">*</span> {{ __('Language Name') }}</label>
													<input type="text" name="language_name" id="language_name" class="form-control parsley-validated" data-required="true">
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<div class="tw_checkbox checkbox_group">
													<input id="language_default" name="language_default" type="checkbox">
													<label for="language_default">{{ __('Active Language') }}</label>
													<span></span>
												</div>
											</div>
										</div>
										<div class="tabs-footer">
											<input id="old_language_code" name="old_language_code" type="text" class="display-none"/>
											<input id="RecordId" name="RecordId" type="text" class="display-none"/>
											<input name="user_id" type="text" class="display-none" value="{{ Auth::user()->id }}"/>
											<!--route-->
											<input id="saveLangaugeId" type="text" class="display-none" value="{{ route('backend.saveLangauge') }}"/>
											<input id="getLangaugeDataId" type="text" class="display-none" value="{{ route('backend.getLangaugeData') }}"/>
											<input id="LangaugeById" type="text" class="display-none" value="{{ route('backend.getLangaugeById') }}"/>
											<input id="deleteLangaugeId" type="text" class="display-none" value="{{ route('backend.deleteLangauge') }}"/>
											
											<a data-submitformid="1" class="btn green-btn mr-10 submit-form-class" href="javascript:void(0);">{{ __('Save') }}</a>
											<a onClick="onListPanel(1)" class="btn danger-btn btn-list" href="javascript:void(0);">{{ __('Cancel') }}</a>
										</div>
									</form>
								</div>
								<!--/Data Entry Form/-->
							</div>
							<!--/Langauges/-->
							
							<!--Language Keywords-->
							<div id="tabId-2" class="tab-link-content tabhide">
								<div class="tabs-head">
									<div class="row">
										<div class="col-md-3">
											<div class="form-group mb-10 filter">
												<select name="LangaugeComboId" id="LangaugeComboId" class="form-control">
												</select>
												<input id="getLangaugeComboId" type="text" class="display-none" value="{{ route('backend.getLangaugeCombo') }}"/>
											</div>
										</div>
										<div class="col-md-9">
											<a onclick="onFormPanel(2)" href="javascript:void(0);" class="btn green-btn btn-form float-right"><i class="fa fa-plus"></i> {{ __('Add New') }}</a>
											<a onclick="onListPanel(2)" href="javascript:void(0);" class="btn warning-btn btn-list float-right display-none mb-10"><i class="fa fa-reply"></i> {{ __('Back to List') }}</a>
										</div>
									</div>
								</div>
								<!--Data grid-->
								<div id="list-panel-tabid-2">
									<div class="row">
										<div class="col-lg-12">
											<div class="table-responsive">
												<table id="DataTable_LangaugeKeywordsId" class="table table-striped table-bordered">
													<thead>
														<tr>
															<th class="text-center">{{ __('SL.') }}</th>
															<th class="text-left">{{ __('Language Keyword') }}</th>
															<th class="text-left">{{ __('Language Text') }}</th>
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
													<label for="language_keywords"><span class="red">*</span> {{ __('Language Keyword') }}</label>
													<input type="text" name="language_keywords" id="language_keywords" class="form-control parsley-validated" data-required="true">
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
													<label for="language_text"><span class="red">*</span> {{ __('Language Text') }}</label>
													<input type="text" name="language_text" id="language_text" class="form-control parsley-validated" data-required="true">
												</div>
											</div>
										</div>
										<div class="tabs-footer">
											<input id="LanguagekeywordId" name="LanguagekeywordId" type="text" class="display-none"/>
											<!--route-->
											<input id="getLanguagekeywordDataId" type="text" class="display-none" value="{{ route('backend.getLanguagekeywordData') }}"/>
											<input id="LanguageKeywordById" type="text" class="display-none" value="{{ route('backend.getLanguageKeywordById') }}"/>
											<input id="saveLanguageKeywordId" type="text" class="display-none" value="{{ route('backend.saveLanguageKeyword') }}"/>
											<input id="deleteLangaugeKeywordsId" type="text" class="display-none" value="{{ route('backend.deleteLangaugeKeywords') }}"/>
										
											<a data-submitformid="2" class="btn green-btn mr-10 submit-form-class" href="javascript:void(0);">{{ __('Save') }}</a>
											<a onClick="onListPanel(2)" class="btn danger-btn btn-list" href="javascript:void(0);">{{ __('Cancel') }}</a>
										</div>
									</form>
								</div>
								<!--/Data Entry Form/-->
							</div>
							<!--/Language Keywords/-->
						</div>
					</div>
				</div>
			</div>
		</div><!--/Content/-->
	</div>
@endsection

@push('scripts')
<script src="{{asset('public/backend/pages/langaugespage.js')}}"></script>
@endpush
