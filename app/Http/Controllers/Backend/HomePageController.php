<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\HomePageModel;
use App\Setting;
use Carbon\Carbon;
use DataTables;

class HomePageController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        $this->middleware('auth');
    }

    //Home page load
    public function homePage(){
        return view('backend.home');
    }

    public function getHomepageVersion(Request $request){

        $data  = Setting::where('bactive', 1)->get();
		
		return $data;
	}
	
	public function saveHomepageVersion(Request $request){
		
		$res = array();
		
		$bactive = 1;
		$home_page = $request->input('home_page');
		$currentDataTime = Carbon::now();
		
		$data  = Setting::where('bactive', $bactive)->get();
		$id = '';
		foreach ($data as $row){
			$id = $row['id'];
		}

		$validator_array = array(
			'homepage_versions' => $request->input('home_page')
		);
		
		$validator = Validator::make($validator_array, [
			'homepage_versions' => 'required'
		]);
		
		$errors = $validator->errors();
		if($errors->has('homepage_versions')){
			$res['msgType'] = 'error';
			$res['msg'] = $errors->first('homepage_versions');
			return response()->json($res);
		}

		$data = array(
			'bactive' => $bactive,
			'home_page' => $home_page,
			'created_at' => $currentDataTime,
			'updated_at' => $currentDataTime
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

	public function saveHomeContent(Request $request){
		
		$res = array();
		
		$name = $request->input('name');
		$category_Home_Content = $request->input('category_Home_Content');
		$your_photo = $request->input('your_photo');
		$background_image = $request->input('background_image');
		$video_background = $request->input('video_background');
		$user_id = $request->input('user_id');
		$currentDataTime = Carbon::now();
		
		$validator_array = array(
			'name' => $request->input('name'),
			'your_photo' => $request->input('your_photo'),
			'background_image' => $request->input('background_image'),
			'video_background' => $request->input('video_background')
		);

		$validator = Validator::make($validator_array, [
			'name' => 'required',
			'your_photo' => 'required',
			'background_image' => 'required',
			'video_background' => 'required'
		]);

		$errors = $validator->errors();		
		
		if($errors->has('name')){
			$res['msgType'] = 'error';
			$res['msg'] = $errors->first('name');
			return response()->json($res);
		}
		
		if($errors->has('your_photo')){
			$res['msgType'] = 'error';
			$res['msg'] = $errors->first('your_photo');
			return response()->json($res);
		}
		
		if($errors->has('background_image')){
			$res['msgType'] = 'error';
			$res['msg'] = $errors->first('background_image');
			return response()->json($res);
		}
		
		if($errors->has('video_background')){
			$res['msgType'] = 'error';
			$res['msg'] = $errors->first('video_background');
			return response()->json($res);
		}
			
		$data = array(
			'user_id' => $user_id,
			'category' => $category_Home_Content,
			'status_id' => 1,
			'post_title' => $name,
			"post_content" => json_encode(array(
				'your_photo' => $your_photo,
				'background_image' => $background_image,
				'video_background' => $video_background
			)),
			'created_at' => $currentDataTime,
			'updated_at' => $currentDataTime
		);

		$value = HomePageModel::insertUpdateData($data);
		if($value == 1){
			$res['msgType'] = 'success';
			$res['msg'] = __('New Data Added Successfully');
		}elseif($value == 2){
			$res['msgType'] = 'success';
			$res['msg'] = __('Data Updated Successfully');
		}else{
			$res['msgType'] = 'error';
			$res['msg'] = __('Data insert failed');
		}

		return response()->json($res);
	}

    public function HomeContentbyCategory(Request $request){
		
		$category = $request->category;

		$Data['data'] = HomePageModel::getHomeContentbyCategory($category);

		return $Data;
	}
	
	public function saveAnimatedClipText(Request $request){
		
		$res = array();
		
		$id = $request->input('Record_AnimatedClipTextId') == '' ? NULL : $request->input('Record_AnimatedClipTextId');
		$clip_text = $request->input('clip_text');
		$category = $request->input('category_animated_clip_text');
		$user_id = $request->input('user_id');
		$currentDataTime = Carbon::now();
		
		$validator_array = array(
			'clip_text' => $request->input('clip_text')
		);
		
		$validator = Validator::make($validator_array, [
			'clip_text' => 'required'
		]);

		$errors = $validator->errors();
		
		if($errors->has('clip_text')){
			$res['msgType'] = 'error';
			$res['msg'] = $errors->first('clip_text');
			return response()->json($res);
		}
			
		$data = array(
			'id' => $id,
			'user_id' => $user_id,
			'category' => $category,
			'status_id' => 1,
			'post_title' => $clip_text,
			"post_content" => NULL,
			'created_at' => $currentDataTime,
			'updated_at' => $currentDataTime
		);

		$value = HomePageModel::AnimatedClipTextInsertUpdate($data);
		if($value == 1){
			$res['msgType'] = 'success';
			$res['msg'] = __('New Data Added Successfully');
		}elseif($value == 2){
			$res['msgType'] = 'success';
			$res['msg'] = __('Data Updated Successfully');
		}else{
			$res['msgType'] = 'error';
			$res['msg'] = __('Data insert failed');
		}

		return response()->json($res);
	}	
	
    public function AnimatedClipTextbyCategory(Request $request){
		
		$category = $request->category;

		$data = HomePageModel::getAnimatedClipTextData($category);
		$DataList = DataTables()->of($data)->make(true);
		
		return $DataList;
	}
	
    public function PostById(Request $request){
		
		$id = $request->id;

		$Data['data'] = HomePageModel::getPostById($id);

		return $Data;
	}

	public function PostDeleteById(Request $request){
		
		$res = array();

		$id = $request->id;
		
		if($id != 0){
			$value = HomePageModel::PostDeleteById($id);
			
			if($value == 1){
				$res['msgType'] = 'success';
				$res['msg'] = __('Data Removed Successfully');
			}else{
				$res['msgType'] = 'error';
				$res['msg'] = __('Data remove failed');
			}
		}
		
		return response()->json($res);
	}
}
