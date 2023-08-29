<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Setting;

class SettingsController extends Controller
{
	//Settings page load
    public function SettingsPage(){
        return view('backend.settings');
    }

	//get data for Settings Table
    public function getSettingsTableData(Request $request){

        $data  = Setting::where('bactive', 1)->get();
		
		return $data;
	}
	
	//Save data for Global Setting
	public function saveGlobalSetting(Request $request){
		
		$res = array();
		
		$bactive = 1;
		$site_title = $request->input('site_title');
		$favicon = $request->input('favicon');
		$front_logo = $request->input('front_logo');
		$back_logo = $request->input('back_logo');
		
		$data  = Setting::where('bactive', $bactive)->get();
		$id = '';
		foreach ($data as $row){
			$id = $row['id'];
		}

		$validator_array = array(
			'site_title' => $request->input('site_title'),
			'favicon' => $request->input('favicon'),
			'front_logo' => $request->input('front_logo'),
			'back_logo' => $request->input('back_logo')
		);
		
		$validator = Validator::make($validator_array, [
			'site_title' => 'required',
			'favicon' => 'required',
			'front_logo' => 'required',
			'back_logo' => 'required'
		]);
		
		$errors = $validator->errors();
		
		if($errors->has('site_title')){
			$res['msgType'] = 'error';
			$res['msg'] = $errors->first('site_title');
			return response()->json($res);
		}
		
		if($errors->has('favicon')){
			$res['msgType'] = 'error';
			$res['msg'] = $errors->first('favicon');
			return response()->json($res);
		}
		
		if($errors->has('front_logo')){
			$res['msgType'] = 'error';
			$res['msg'] = $errors->first('front_logo');
			return response()->json($res);
		}
		
		if($errors->has('back_logo')){
			$res['msgType'] = 'error';
			$res['msg'] = $errors->first('back_logo');
			return response()->json($res);
		}

		$data = array(
			'bactive' => $bactive,
			'site_title' => $site_title,
			'favicon' => $favicon,
			'front_logo' => $front_logo,
			'back_logo' => $back_logo
		);
		
		if($id == ''){
			$response = Setting::create($data);
			if($response){
				$res['msgType'] = 'success';
				$res['msg'] = __('New Data Added Successfully');
			}else{
				$res['msgType'] = 'error';
				$res['msg'] = __('Data insert failed');
			}
		}else{
			$response = Setting::where('id', $id)->update($data);
			if($response){
				$res['msgType'] = 'success';
				$res['msg'] = __('Data Updated Successfully');
			}else{
				$res['msgType'] = 'error';
				$res['msg'] = __('Data update failed');
			}
		}

		return response()->json($res);
	}
	
	//Save data for Copyright
	public function saveCopyright(Request $request){
		
		$res = array();
		
		$bactive = 1;
		$copyright = $request->input('copyright');
		
		$data  = Setting::where('bactive', $bactive)->get();
		$id = '';
		foreach ($data as $row){
			$id = $row['id'];
		}

		$validator_array = array(
			'copyright' => $request->input('copyright')
		);
		
		$validator = Validator::make($validator_array, [
			'copyright' => 'required'
		]);
		
		$errors = $validator->errors();
		
		if($errors->has('copyright')){
			$res['msgType'] = 'error';
			$res['msg'] = $errors->first('copyright');
			return response()->json($res);
		}

		$data = array(
			'bactive' => $bactive,
			'copyright' => $copyright
		);
		
		if($id == ''){
			$response = Setting::create($data);
			if($response){
				$res['msgType'] = 'success';
				$res['msg'] = __('New Data Added Successfully');
			}else{
				$res['msgType'] = 'error';
				$res['msg'] = __('Data insert failed');
			}
		}else{
			$response = Setting::where('id', $id)->update($data);
			if($response){
				$res['msgType'] = 'success';
				$res['msg'] = __('Data Updated Successfully');
			}else{
				$res['msgType'] = 'error';
				$res['msg'] = __('Data update failed');
			}
		}

		return response()->json($res);
	}
	
	//Save data for Social Media
	public function saveSocialMedia(Request $request){
		
		$res = array();
		
		$bactive = 1;
		$twitter = $request->input('twitter');
		$facebook = $request->input('facebook');
		$linkedin = $request->input('linkedin');
		$github = $request->input('github');
		$instagram = $request->input('instagram');
		
		$data  = Setting::where('bactive', $bactive)->get();
		$id = '';
		foreach ($data as $row){
			$id = $row['id'];
		}
		
		$social_media = array(
			'twitter' => $twitter,
			'facebook' => $facebook,
			'linkedin' => $linkedin,
			'github' => $github,
			'instagram' => $instagram
		);
		
		$data = array(
			'bactive' => $bactive,
			'social_media' => json_encode($social_media)
		);
		
		if($id == ''){
			$response = Setting::create($data);
			if($response){
				$res['msgType'] = 'success';
				$res['msg'] = __('New Data Added Successfully');
			}else{
				$res['msgType'] = 'error';
				$res['msg'] = __('Data insert failed');
			}
		}else{
			$response = Setting::where('id', $id)->update($data);
			if($response){
				$res['msgType'] = 'success';
				$res['msg'] = __('Data Updated Successfully');
			}else{
				$res['msgType'] = 'error';
				$res['msg'] = __('Data update failed');
			}
		}

		return response()->json($res);
	}
	
	//Save data for Meta Tag
	public function saveMetaTag(Request $request){
		
		$res = array();
		
		$bactive = 1;
		$site_name = $request->input('seo_site_name');
		$keywords = $request->input('seo_keywords');
		$description = $request->input('seo_description');
		$url = $request->input('seo_url');
		$app_id = $request->input('seo_app_id');
		$twitter_site = $request->input('seo_twitter_site');
		$cover_image = $request->input('seo_cover_image');
		
		$data  = Setting::where('bactive', $bactive)->get();
		$id = '';
		foreach ($data as $row){
			$id = $row['id'];
		}

		$validator_array = array(
			'site_name' => $request->input('seo_site_name'),
			'keywords' => $request->input('seo_keywords'),
			'description' => $request->input('seo_description'),
			'site_url' => $request->input('seo_url'),
			'seo_cover_image' => $request->input('seo_cover_image')
		);
		
		$validator = Validator::make($validator_array, [
			'site_name' => 'required',
			'keywords' => 'required',
			'description' => 'required',
			'site_url' => 'required',
			'seo_cover_image' => 'required'
		]);
		
		$errors = $validator->errors();
		
		if($errors->has('site_name')){
			$res['msgType'] = 'error';
			$res['msg'] = $errors->first('site_name');
			return response()->json($res);
		}
		
		if($errors->has('keywords')){
			$res['msgType'] = 'error';
			$res['msg'] = $errors->first('keywords');
			return response()->json($res);
		}
		
		if($errors->has('description')){
			$res['msgType'] = 'error';
			$res['msg'] = $errors->first('description');
			return response()->json($res);
		}
		
		if($errors->has('site_url')){
			$res['msgType'] = 'error';
			$res['msg'] = $errors->first('site_url');
			return response()->json($res);
		}
		
		if($errors->has('seo_cover_image')){
			$res['msgType'] = 'error';
			$res['msg'] = $errors->first('seo_cover_image');
			return response()->json($res);
		}
		
		$metatag = array(
			'site_name' => $site_name,
			'keywords' => $keywords,
			'description' => $description,
			'url' => $url,
			'app_id' => $app_id,
			'twitter_site' => $twitter_site,
			'cover_image' => $cover_image
		);
		
		$data = array(
			'bactive' => $bactive,
			'metatag' => json_encode($metatag)
		);
		
		if($id == ''){
			$response = Setting::create($data);
			if($response){
				$res['msgType'] = 'success';
				$res['msg'] = __('New Data Added Successfully');
			}else{
				$res['msgType'] = 'error';
				$res['msg'] = __('Data insert failed');
			}
		}else{
			$response = Setting::where('id', $id)->update($data);
			if($response){
				$res['msgType'] = 'success';
				$res['msg'] = __('Data Updated Successfully');
			}else{
				$res['msgType'] = 'error';
				$res['msg'] = __('Data update failed');
			}
		}

		return response()->json($res);
	}
	
	//Save data for Theme Color
	public function saveColor(Request $request){
		
		$res = array();
		
		$bactive = 1;
		$theme_background_color = $request->input('theme_background_color');
		$theme_text_color = $request->input('theme_text_color');
		$theme_hover_color = $request->input('theme_hover_color');
		$theme_heading_color = $request->input('theme_heading_color');
		$hp_background_color = $request->input('hp_background_color');
		$avater_border_color = $request->input('avater_border_color');
		$fill_color = $request->input('fill_color');
		$backend_background_color = $request->input('backend_background_color');
		$backend_text_color = $request->input('backend_text_color');
		
		$data  = Setting::where('bactive', $bactive)->get();
		$id = '';
		foreach ($data as $row){
			$id = $row['id'];
		}

		$validator_array = array(
			'background_color' => $request->input('theme_background_color'),
			'text_color' => $request->input('theme_text_color'),
			'hover_color' => $request->input('theme_hover_color'),
			'heading_color' => $request->input('theme_heading_color'),
			'home_and_portfolio_background_color' => $request->input('hp_background_color'),
			'avater_border_color' => $request->input('avater_border_color'),
			'fill_color' => $request->input('fill_color'),
			'backend_background_color' => $request->input('backend_background_color'),
			'backend_text_color' => $request->input('backend_text_color')
		);
		
		$validator = Validator::make($validator_array, [
			'background_color' => 'required',
			'text_color' => 'required',
			'hover_color' => 'required',
			'heading_color' => 'required',
			'home_and_portfolio_background_color' => 'required',
			'avater_border_color' => 'required',
			'fill_color' => 'required',
			'backend_background_color' => 'required',
			'backend_text_color' => 'required'
		]);
		
		$errors = $validator->errors();
		
		if($errors->has('background_color')){
			$res['msgType'] = 'error';
			$res['msg'] = $errors->first('background_color');
			return response()->json($res);
		}
		
		if($errors->has('text_color')){
			$res['msgType'] = 'error';
			$res['msg'] = $errors->first('text_color');
			return response()->json($res);
		}
		
		if($errors->has('hover_color')){
			$res['msgType'] = 'error';
			$res['msg'] = $errors->first('hover_color');
			return response()->json($res);
		}
		
		if($errors->has('heading_color')){
			$res['msgType'] = 'error';
			$res['msg'] = $errors->first('heading_color');
			return response()->json($res);
		}
		
		if($errors->has('home_and_portfolio_background_color')){
			$res['msgType'] = 'error';
			$res['msg'] = $errors->first('home_and_portfolio_background_color');
			return response()->json($res);
		}
		
		if($errors->has('avater_border_color')){
			$res['msgType'] = 'error';
			$res['msg'] = $errors->first('avater_border_color');
			return response()->json($res);
		}
		
		if($errors->has('fill_color')){
			$res['msgType'] = 'error';
			$res['msg'] = $errors->first('fill_color');
			return response()->json($res);
		}
		
		if($errors->has('backend_background_color')){
			$res['msgType'] = 'error';
			$res['msg'] = $errors->first('backend_background_color');
			return response()->json($res);
		}
		
		if($errors->has('backend_text_color')){
			$res['msgType'] = 'error';
			$res['msg'] = $errors->first('backend_text_color');
			return response()->json($res);
		}
		
		$theme_color = array(
			'theme_background_color' => $theme_background_color,
			'theme_text_color' => $theme_text_color,
			'theme_hover_color' => $theme_hover_color,
			'theme_heading_color' => $theme_heading_color,
			'hp_background_color' => $hp_background_color,
			'avater_border_color' => $avater_border_color,
			'fill_color' => $fill_color,
			'backend_background_color' => $backend_background_color,
			'backend_text_color' => $backend_text_color
		);
		
		$data = array(
			'bactive' => $bactive,
			'theme_color' => json_encode($theme_color)
		);
		
		if($id == ''){
			$response = Setting::create($data);
			if($response){
				$res['msgType'] = 'success';
				$res['msg'] = __('New Data Added Successfully');
			}else{
				$res['msgType'] = 'error';
				$res['msg'] = __('Data insert failed');
			}
		}else{
			$response = Setting::where('id', $id)->update($data);
			if($response){
				$res['msgType'] = 'success';
				$res['msg'] = __('Data Updated Successfully');
			}else{
				$res['msgType'] = 'error';
				$res['msg'] = __('Data update failed');
			}
		}

		return response()->json($res);
	}
	
	//Save data for Google reCAPTCHA
	public function saveGooglereCAPTCHA(Request $request){
		
		$res = array();
		
		$bactive = 1;
		$sitekey = $request->input('sitekey');
		$secretkey = $request->input('secretkey');
		
		$reCaptcha = $request->input('recaptcha');
        if ($reCaptcha == 'true' || $reCaptcha == 'on') {
            $recaptcha = 1;
        } else {
            $recaptcha = 0;
        }
		
		$data  = Setting::where('bactive', $bactive)->get();
		$id = '';
		foreach ($data as $row){
			$id = $row['id'];
		}

		$validator_array = array(
			'sitekey' => $request->input('sitekey'),
			'secretkey' => $request->input('secretkey')
		);
		
		$validator = Validator::make($validator_array, [
			'sitekey' => 'required',
			'secretkey' => 'required'
		]);
		
		$errors = $validator->errors();
		
		if($errors->has('sitekey')){
			$res['msgType'] = 'error';
			$res['msg'] = $errors->first('sitekey');
			return response()->json($res);
		}
		
		if($errors->has('secretkey')){
			$res['msgType'] = 'error';
			$res['msg'] = $errors->first('secretkey');
			return response()->json($res);
		}
		
		$data = array(
			'bactive' => $bactive,
			'recaptcha' => $recaptcha,
			'sitekey' => $sitekey,
			'secretkey' => $secretkey
		);
		
		if($id == ''){
			$response = Setting::create($data);
			if($response){
				$res['msgType'] = 'success';
				$res['msg'] = __('New Data Added Successfully');
			}else{
				$res['msgType'] = 'error';
				$res['msg'] = __('Data insert failed');
			}
		}else{
			$response = Setting::where('id', $id)->update($data);
			if($response){
				$res['msgType'] = 'success';
				$res['msg'] = __('Data Updated Successfully');
			}else{
				$res['msgType'] = 'error';
				$res['msg'] = __('Data update failed');
			}
		}

		return response()->json($res);
	}
	
	//Save data for Contact Form Setting
	public function saveContactFormSetting(Request $request){
		
		$res = array();
		
		$bactive = 1;
		$fromname = $request->input('fromname');
		$frommailaddress = $request->input('frommailaddress');
		$toname = $request->input('toname');
		$tomailaddress = $request->input('tomailaddress');
		
		$is_mail = $request->input('ismail');
        if ($is_mail == 'true' || $is_mail == 'on') {
            $ismail = 1;
        } else {
            $ismail = 0;
        }
		
		$data  = Setting::where('bactive', $bactive)->get();
		$id = '';
		foreach ($data as $row){
			$id = $row['id'];
		}

		$validator_array = array(
			'fromname' => $request->input('fromname'),
			'frommailaddress' => $request->input('frommailaddress'),
			'toname' => $request->input('toname'),
			'tomailaddress' => $request->input('tomailaddress')
		);
		
		$validator = Validator::make($validator_array, [
			'fromname' => 'required',
			'frommailaddress' => 'required',
			'toname' => 'required',
			'tomailaddress' => 'required'
		]);
		
		$errors = $validator->errors();
		
		if($errors->has('fromname')){
			$res['msgType'] = 'error';
			$res['msg'] = $errors->first('fromname');
			return response()->json($res);
		}
		
		if($errors->has('frommailaddress')){
			$res['msgType'] = 'error';
			$res['msg'] = $errors->first('frommailaddress');
			return response()->json($res);
		}
		
		if($errors->has('toname')){
			$res['msgType'] = 'error';
			$res['msg'] = $errors->first('toname');
			return response()->json($res);
		}
		
		if($errors->has('tomailaddress')){
			$res['msgType'] = 'error';
			$res['msg'] = $errors->first('tomailaddress');
			return response()->json($res);
		}
		
		$data = array(
			'bactive' => $bactive,
			'ismail' => $ismail,
			'fromname' => $fromname,
			'frommailaddress' => $frommailaddress,
			'toname' => $toname,
			'tomailaddress' => $tomailaddress
		);
		
		if($id == ''){
			$response = Setting::create($data);
			if($response){
				$res['msgType'] = 'success';
				$res['msg'] = __('New Data Added Successfully');
			}else{
				$res['msgType'] = 'error';
				$res['msg'] = __('Data insert failed');
			}
		}else{
			$response = Setting::where('id', $id)->update($data);
			if($response){
				$res['msgType'] = 'success';
				$res['msg'] = __('Data Updated Successfully');
			}else{
				$res['msgType'] = 'error';
				$res['msg'] = __('Data update failed');
			}
		}

		return response()->json($res);
	}
	
	//Save data for Google Map
	public function saveGoogleMap(Request $request){
		
		$res = array();
		
		$bactive = 1;
		$api_key = $request->input('api_key');
		$Latitude = $request->input('Latitude');
		$Longitude = $request->input('Longitude');
		$zoom = $request->input('zoom');
		
		$isgmap = $request->input('is_gmap');
        if ($isgmap == 'true' || $isgmap == 'on') {
            $is_gmap = 1;
        } else {
            $is_gmap = 0;
        }
		
		$data  = Setting::where('bactive', $bactive)->get();
		$id = '';
		foreach ($data as $row){
			$id = $row['id'];
		}

		$validator_array = array(
			'api_key' => $request->input('api_key'),
			'Latitude' => $request->input('Latitude'),
			'Longitude' => $request->input('Longitude'),
			'zoom' => $request->input('zoom')
		);
		
		$validator = Validator::make($validator_array, [
			'api_key' => 'required',
			'Latitude' => 'required',
			'Longitude' => 'required',
			'zoom' => 'required'
		]);
		
		$errors = $validator->errors();
		
		if($errors->has('api_key')){
			$res['msgType'] = 'error';
			$res['msg'] = $errors->first('api_key');
			return response()->json($res);
		}
		
		if($errors->has('Latitude')){
			$res['msgType'] = 'error';
			$res['msg'] = $errors->first('Latitude');
			return response()->json($res);
		}
		
		if($errors->has('Longitude')){
			$res['msgType'] = 'error';
			$res['msg'] = $errors->first('Longitude');
			return response()->json($res);
		}
		
		if($errors->has('zoom')){
			$res['msgType'] = 'error';
			$res['msg'] = $errors->first('zoom');
			return response()->json($res);
		}
		
		$gmap = array(
			'api_key' => $api_key,
			'Latitude' => $Latitude,
			'Longitude' => $Longitude,
			'zoom' => $zoom
		);
		
		$data = array(
			'bactive' => $bactive,
			'is_gmap' => $is_gmap,
			'gmap' => json_encode($gmap)
		);
		
		if($id == ''){
			$response = Setting::create($data);
			if($response){
				$res['msgType'] = 'success';
				$res['msg'] = __('New Data Added Successfully');
			}else{
				$res['msgType'] = 'error';
				$res['msg'] = __('Data insert failed');
			}
		}else{
			$response = Setting::where('id', $id)->update($data);
			if($response){
				$res['msgType'] = 'success';
				$res['msg'] = __('Data Updated Successfully');
			}else{
				$res['msgType'] = 'error';
				$res['msg'] = __('Data update failed');
			}
		}

		return response()->json($res);
	}	
}
