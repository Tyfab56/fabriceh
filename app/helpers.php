<?php

use App\Setting;
use App\User;
use App\Langauge;

function gSettings(){
	
	locale();
	
	$count = User::get()->count();
	if($count == 0){
		$password = 'admin123456';
		$data = array(
			'name' => 'Admin',
			'email' => 'admin@themeposh.com',
			'password' => Hash::make($password),
			'status' => 1,
			'bactive' => base64_encode($password)
		);
		User::create($data);
	}
	
	$data = array();
	
	//Setting
	$setting_data = Setting::where('bactive', 1)->get();
	$id = '';
	foreach ($setting_data as $row){
		$id = $row['id'];
	}
	if($id != ''){
		$sData = json_decode($setting_data);
		$data['site_title'] = $sData[0]->site_title;
		$data['home_page'] = $sData[0]->home_page;
		$data['front_logo'] = $sData[0]->front_logo;
		$data['back_logo'] = $sData[0]->back_logo;
		$data['favicon'] = $sData[0]->favicon;
		$data['copyright'] = $sData[0]->copyright;
		$data['recaptcha'] = $sData[0]->recaptcha;
		$data['sitekey'] = $sData[0]->sitekey;
		$data['secretkey'] = $sData[0]->secretkey;
		$data['is_gmap'] = $sData[0]->is_gmap;
		if($sData[0]->social_media !=''){
			$data['social_media'] = json_decode($sData[0]->social_media);
		}else{
			$data['social_media'] = json_decode(json_encode(array(
				"twitter" => "#",
				"facebook" => "#",
				"linkedin" => "#",
				"github" => "#",
				"instagram" => "#"
			)));
		}
		if($sData[0]->metatag !=''){
			$data['metatag'] = json_decode($sData[0]->metatag);
		}else{
			$data['metatag'] = json_decode(json_encode(array(
				"site_name" => "exp",
				"keywords" => "",
				"description" => "",
				"url" => "",
				"app_id" => "",
				"twitter_site" => "",
				"cover_image" => ""
			)));
		}
		
		if($sData[0]->theme_color !=''){
			$data['color'] = json_decode($sData[0]->theme_color);
		}else{
			$data['color'] = json_decode(json_encode(array(
				"theme_background_color" => "#111111",
				"theme_text_color" => "#a6a6a6",
				"theme_hover_color" => "#ffffff", 
				"theme_heading_color" => "#dddddd", 
				"hp_background_color" => "rgba(0,0,0,0.8)",
				"avater_border_color" => "rgba(255,255,255,0.2)",
				"fill_color" => "#4f4f4f",
				"backend_background_color" => "#111111",
				"backend_text_color" => "#a6a6a6"
			)));
		}
		
		if($sData[0]->gmap !=''){
			$data['gmap'] = json_decode($sData[0]->gmap);
		}else{
			$data['gmap'] = json_decode(json_encode(array(
				"Latitude" => "",
				"Longitude" => "",
				"zoom" => "", 
				"api_key" => ""
			)));
		}
		
	}else{
		$data['site_title'] = 'Personal Portfolio Laravel';
		$data['home_page'] = 'image_background';
		$data['front_logo'] = '';
		$data['favicon'] = '';
		$data['back_logo'] = '';
		$data['copyright'] = '<a href="#">EXP</a> &copy; 2020 All Rights Reserved.';
		$data['recaptcha'] = 0;
		$data['sitekey'] = '';
		$data['secretkey'] = '';
		$data['is_gmap'] = 0;
		$data['color'] = json_decode(json_encode(array(
			"theme_background_color" => "#111111",
			"theme_text_color" => "#a6a6a6",
			"theme_hover_color" => "#ffffff", 
			"theme_heading_color" => "#dddddd", 
			"hp_background_color" => "rgba(0,0,0,0.8)",
			"avater_border_color" => "rgba(255,255,255,0.2)",
			"fill_color" => "#4f4f4f",
			"backend_background_color" => "#111111",
			"backend_text_color" => "#a6a6a6"
		)));
		$data['social_media'] = json_decode(json_encode(array(
			"twitter" => "#",
			"facebook" => "#",
			"linkedin" => "#",
			"github" => "#",
			"instagram" => "#"
		)));
		$data['metatag'] = json_decode(json_encode(array(
			"site_name" => "exp",
			"keywords" => "",
			"description" => "",
			"url" => "",
			"app_id" => "",
			"twitter_site" => "",
			"cover_image" => ""
		)));
		
		$data['gmap'] = json_decode(json_encode(array(
			"Latitude" => "",
			"Longitude" => "",
			"zoom" => "", 
			"api_key" => ""
		)));		
	}

	return $data;
}

//Get data for Langauge locale
function locale(){
	$data = Langauge::where('language_default', 1)->get();
	$language_code = '';
	foreach ($data as $row){
		$language_code = $row['language_code'];
	}
	if($language_code != ''){
		$locale = $language_code;
	}else{
		$locale = 'en';
	}
	
	App::setLocale($locale);
	//store the locale in session so that the middleware can register it
	session()->put('locale', $locale);
}
	
function str_slug($str) {

	$str_slug = Str::slug($str, "-");
	
	return $str_slug;
}
