<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Frontend Page
Route::get('/','Frontend\FrontendController@index')->name('frontend.home');
Route::get('/blog','Frontend\FrontendController@getBlogs')->name('frontend.blog');
Route::get('/another','Frontend\FrontendController@another')->name('frontend.another');

Route::get('/article/{id}/{title}','Frontend\FrontendController@getArticle')->name('frontend.article');

Route::post('/sentContactFormMessage', 'Frontend\FrontendController@sentContactFormMessage')->name('frontend.sentContactFormMessage');

Auth::routes();

Route::prefix('backend')->group(function(){
	
	//Home Page
	Route::get('/home','Backend\HomePageController@homePage')->name('backend.home')->middleware('auth');
	
	//Homepage Versions
	Route::post('/getHomepageVersion', 'Backend\HomePageController@getHomepageVersion')->name('backend.getHomepageVersion')->middleware('auth');
	Route::post('/saveHomepageVersion', 'Backend\HomePageController@saveHomepageVersion')->name('backend.saveHomepageVersion')->middleware('auth');
	
	//Home Content
	Route::post('/home', 'Backend\UploadController@FileUpload')->name('FileUpload.home')->middleware('auth');
	Route::post('/saveHomeContent', 'Backend\HomePageController@saveHomeContent')->name('backend.saveHomeContent')->middleware('auth');
	Route::post('/getHomeContent', 'Backend\HomePageController@HomeContentbyCategory')->name('backend.getHomeContent')->middleware('auth');
	
	//Animated Clip Text
	Route::post('/saveAnimatedClipText', 'Backend\HomePageController@saveAnimatedClipText')->name('backend.saveAnimatedClipText')->middleware('auth');
	Route::post('/getAnimatedClipText', 'Backend\HomePageController@AnimatedClipTextbyCategory')->name('backend.getAnimatedClipText')->middleware('auth');
	Route::post('/getAnimatedClipTextById', 'Backend\HomePageController@PostById')->name('backend.getAnimatedClipTextById')->middleware('auth');
	Route::post('/AnimatedClipTextDelete', 'Backend\HomePageController@PostDeleteById')->name('backend.AnimatedClipTextDelete')->middleware('auth');
	
	//About Page
	Route::get('/about','Backend\AboutPageController@aboutPage')->name('backend.about')->middleware('auth');
	Route::post('/ImageUpload', 'Backend\UploadController@FileUpload')->name('backend.ImageUpload')->middleware('auth');
	Route::post('/FileAttachment', 'Backend\UploadController@attachmentUpload')->name('backend.FileAttachment')->middleware('auth');
	Route::post('/saveAbout', 'Backend\AboutPageController@saveAbout')->name('backend.saveAbout')->middleware('auth');
	Route::post('/getAboutbyCategory', 'Backend\AboutPageController@AboutbyCategory')->name('backend.getAboutbyCategory')->middleware('auth');
	
	//Education
	Route::post('/saveEducation', 'Backend\AboutPageController@saveEducation')->name('backend.saveEducation')->middleware('auth');
	Route::post('/getEducation', 'Backend\AboutPageController@EducationByCategory')->name('backend.getEducation')->middleware('auth');
	Route::post('/getEducationById', 'Backend\AboutPageController@getEducationById')->name('backend.getEducationById')->middleware('auth');
	Route::post('/deleteEducation', 'Backend\AboutPageController@deleteEducation')->name('backend.deleteEducation')->middleware('auth');
	
	//Experience
	Route::post('/saveExperience', 'Backend\AboutPageController@saveExperience')->name('backend.saveExperience')->middleware('auth');
	Route::post('/getExperience', 'Backend\AboutPageController@ExperienceByCategory')->name('backend.getExperience')->middleware('auth');
	Route::post('/getExperienceById', 'Backend\AboutPageController@getExperienceById')->name('backend.getExperienceById')->middleware('auth');
	Route::post('/deleteExperience', 'Backend\AboutPageController@deleteExperience')->name('backend.deleteExperience')->middleware('auth');
	
	//My Skills
	Route::post('/saveMySkills', 'Backend\AboutPageController@saveMySkills')->name('backend.saveMySkills')->middleware('auth');
	Route::post('/getMySkills', 'Backend\AboutPageController@MySkillsByCategory')->name('backend.getMySkills')->middleware('auth');
	Route::post('/getMySkillsById', 'Backend\AboutPageController@getMySkillsById')->name('backend.getMySkillsById')->middleware('auth');
	Route::post('/deleteMySkills', 'Backend\AboutPageController@deleteMySkills')->name('backend.deleteMySkills')->middleware('auth');
	
	//Portfolio Page
	Route::get('/portfolio','Backend\PortfolioController@portfolioPage')->name('backend.portfolio')->middleware('auth');
	Route::post('/PortfolioImageUpload', 'Backend\UploadController@FileUpload')->name('backend.PortfolioImageUpload')->middleware('auth');
	Route::post('/savePortfolio', 'Backend\PortfolioController@savePortfolio')->name('backend.savePortfolio')->middleware('auth');
	Route::post('/getPortfolioData', 'Backend\PortfolioController@getPortfolioData')->name('backend.getPortfolioData')->middleware('auth');
	Route::post('/getPortfolioById', 'Backend\PortfolioController@getPortfolioById')->name('backend.getPortfolioById')->middleware('auth');
	Route::post('/deletePortfolio', 'Backend\PortfolioController@deletePortfolio')->name('backend.deletePortfolio')->middleware('auth');
	
	//Blog Page
	Route::get('/blog','Backend\BlogController@blogPage')->name('backend.blog')->middleware('auth');
	Route::post('/BlogImageUpload', 'Backend\UploadController@FileUpload')->name('backend.BlogImageUpload')->middleware('auth');
	Route::post('/saveBlog', 'Backend\BlogController@saveBlog')->name('backend.saveBlog')->middleware('auth');
	Route::post('/getBlogData', 'Backend\BlogController@getBlogData')->name('backend.getBlogData')->middleware('auth');
	Route::post('/getBlogById', 'Backend\BlogController@getBlogById')->name('backend.getBlogById')->middleware('auth');
	Route::post('/deleteBlog', 'Backend\BlogController@deleteBlog')->name('backend.deleteBlog')->middleware('auth');
	
	//Contact Page
	Route::get('/contact','Backend\ContactController@ContactPage')->name('backend.contact')->middleware('auth');

	Route::post('/saveContact', 'Backend\ContactController@saveContact')->name('backend.saveContact')->middleware('auth');
	Route::post('/getContactbyCategory', 'Backend\ContactController@ContactbyCategory')->name('backend.getContactbyCategory')->middleware('auth');
		
	//Users and My Profile Page
	Route::get('/users','Backend\UsersController@UsersPage')->name('backend.users')->middleware('auth');
	Route::post('/ProfilePhotoUpload', 'Backend\UploadController@FileUpload')->name('backend.ProfilePhotoUpload')->middleware('auth');
	Route::post('/saveUsers', 'Backend\UsersController@saveUsers')->name('backend.saveUsers')->middleware('auth');
	Route::post('/getUsersData', 'Backend\UsersController@getUsersData')->name('backend.getUsersData')->middleware('auth');
	Route::post('/getUserById', 'Backend\UsersController@getUserById')->name('backend.getUserById')->middleware('auth');
	Route::post('/deleteUser', 'Backend\UsersController@deleteUser')->name('backend.deleteUser')->middleware('auth');
	Route::get('/profile', 'Backend\UsersController@MyProfilePage')->name('backend.profile')->middleware('auth');

	//Settings Page
	Route::get('/settings','Backend\SettingsController@SettingsPage')->name('backend.settings')->middleware('auth');
	Route::post('/getSettingsTable', 'Backend\SettingsController@getSettingsTableData')->name('backend.getSettingsTable')->middleware('auth');
	
	//Global Setting
	Route::post('/LogoUpload', 'Backend\UploadController@FileUpload')->name('backend.LogoUpload')->middleware('auth');
	Route::post('/saveGlobalSetting', 'Backend\SettingsController@saveGlobalSetting')->name('backend.saveGlobalSetting')->middleware('auth');
	
	//Copyright
	Route::post('/saveCopyright', 'Backend\SettingsController@saveCopyright')->name('backend.saveCopyright')->middleware('auth');
	
	//Social Media
	Route::post('/saveSocialMedia', 'Backend\SettingsController@saveSocialMedia')->name('backend.saveSocialMedia')->middleware('auth');
	
	//Meta Tag
	Route::post('/saveMetaTag', 'Backend\SettingsController@saveMetaTag')->name('backend.saveMetaTag')->middleware('auth');
	
	//Theme Color
	Route::post('/saveColor', 'Backend\SettingsController@saveColor')->name('backend.saveColor')->middleware('auth');
	
	//Google reCAPTCHA
	Route::post('/saveGooglereCAPTCHA', 'Backend\SettingsController@saveGooglereCAPTCHA')->name('backend.saveGooglereCAPTCHA')->middleware('auth');
	
	//Contact Form Setting
	Route::post('/saveContactFormSetting', 'Backend\SettingsController@saveContactFormSetting')->name('backend.saveContactFormSetting')->middleware('auth');
	
	//Google Map
	Route::post('/saveGoogleMap', 'Backend\SettingsController@saveGoogleMap')->name('backend.saveGoogleMap')->middleware('auth');
	
	//Langauges Page
	Route::get('/langauges','Backend\LangaugesController@langaugesPage')->name('backend.langauges')->middleware('auth');
	Route::post('/saveLangauge', 'Backend\LangaugesController@saveLangauge')->name('backend.saveLangauge')->middleware('auth');
	Route::post('/getLangaugeData', 'Backend\LangaugesController@getLangaugeData')->name('backend.getLangaugeData')->middleware('auth');
	Route::post('/getLangaugeById', 'Backend\LangaugesController@getLangaugeById')->name('backend.getLangaugeById')->middleware('auth');
	Route::post('/deleteLangauge', 'Backend\LangaugesController@deleteLangauge')->name('backend.deleteLangauge')->middleware('auth');
	
	//Language keyword
	Route::post('/getLanguagekeywordData', 'Backend\LangaugesController@getLanguagekeywordData')->name('backend.getLanguagekeywordData')->middleware('auth');
	Route::post('/getLanguageKeywordById', 'Backend\LangaugesController@getLanguageKeywordById')->name('backend.getLanguageKeywordById')->middleware('auth');
	Route::post('/saveLanguageKeyword', 'Backend\LangaugesController@saveLanguageKeyword')->name('backend.saveLanguageKeyword')->middleware('auth');
	Route::post('/deleteLangaugeKeywords', 'Backend\LangaugesController@deleteLangaugeKeywords')->name('backend.deleteLangaugeKeywords')->middleware('auth');
	
	//Langauge Combo
	Route::post('/getLangaugeCombo', 'Backend\LangaugesController@getLangaugeCombo')->name('backend.getLangaugeCombo')->middleware('auth');
	
});


