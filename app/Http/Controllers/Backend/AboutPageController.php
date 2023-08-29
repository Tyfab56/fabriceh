<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use App\AboutPageModel;
use Carbon\Carbon;
use DataTables;

class AboutPageController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        $this->middleware('auth');
    }

    //About page load
    public function aboutPage(){
        return view('backend.about');
    }
	
	//Save data for About
	public function saveAbout(Request $request){
		
		$res = array();
		
		$user_id = $request->input('user_id');
		$currentDataTime = Carbon::now();
		$title = $request->input('about_title');
		$category = $request->input('category_about');
		$description = $request->input('about_description');
		$name = $request->input('about_name');
		$email = $request->input('about_email');
		$skype = $request->input('about_skype');
		$phone = $request->input('about_phone');
		$experience = $request->input('about_experience');
		$address = $request->input('about_address');
		$hire_me = $request->input('about_hire_me');
		$your_photo = $request->input('your_photo');
		$download_cv = $request->input('download_cv');
		
		$validator_array = array(
			'title' => $request->input('about_title'),
			'description' => $request->input('about_description'),
			'name' => $request->input('about_name'),
			'email' => $request->input('about_email'),
			'skype' => $request->input('about_skype'),
			'phone' => $request->input('about_phone'),
			'address' => $request->input('about_address'),
			'your_photo' => $request->input('your_photo'),
			'upload_your_cv' => $request->input('download_cv')
		);

		$validator = Validator::make($validator_array, [
			'title' => 'required',
			'description' => 'required',
			'name' => 'required',
			'email' => 'required',
			'skype' => 'required',
			'phone' => 'required',
			'address' => 'required',
			'your_photo' => 'required',
			'upload_your_cv' => 'required'
		]);

		$errors = $validator->errors();		
		
		if($errors->has('title')){
			$res['msgType'] = 'error';
			$res['msg'] = $errors->first('title');
			return response()->json($res);
		}
		
		if($errors->has('description')){
			$res['msgType'] = 'error';
			$res['msg'] = $errors->first('description');
			return response()->json($res);
		}
		
		if($errors->has('name')){
			$res['msgType'] = 'error';
			$res['msg'] = $errors->first('name');
			return response()->json($res);
		}
		
		if($errors->has('email')){
			$res['msgType'] = 'error';
			$res['msg'] = $errors->first('email');
			return response()->json($res);
		}
		
		if($errors->has('skype')){
			$res['msgType'] = 'error';
			$res['msg'] = $errors->first('skype');
			return response()->json($res);
		}
		
		if($errors->has('phone')){
			$res['msgType'] = 'error';
			$res['msg'] = $errors->first('phone');
			return response()->json($res);
		}
		
		if($errors->has('address')){
			$res['msgType'] = 'error';
			$res['msg'] = $errors->first('address');
			return response()->json($res);
		}
		
		if($errors->has('your_photo')){
			$res['msgType'] = 'error';
			$res['msg'] = $errors->first('your_photo');
			return response()->json($res);
		}
		
		if($errors->has('upload_your_cv')){
			$res['msgType'] = 'error';
			$res['msg'] = $errors->first('upload_your_cv');
			return response()->json($res);
		}
			
		$data = array(
			'user_id' => $user_id,
			'category' => $category,
			'status_id' => 1,
			'post_title' => $title,
			"post_content" => json_encode(array(
				'description' => $description,
				'name' => $name,
				'email' => $email,
				'skype' => $skype,
				'phone' => $phone,
				'experience' => $experience,
				'address' => $address,
				'hire_me' => $hire_me,
				'your_photo' => $your_photo,
				'download_cv' => $download_cv
			)),
			'created_at' => $currentDataTime,
			'updated_at' => $currentDataTime
		);

		$value = AboutPageModel::insertUpdateAboutData($data);
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
	
	//get data for About
    public function AboutbyCategory(Request $request){
		
		$category = $request->category;

		$Data['data'] = AboutPageModel::getAboutByCategory($category);

		return $Data;
	}
	
	//get data for Education
    public function EducationByCategory(Request $request){
		
		$category = $request->category;

		$data = AboutPageModel::getEducationData($category);
		$DataList = DataTables()->of($data)->make(true);
		
		return $DataList;
	}
	
	//Save data for Education
	public function saveEducation(Request $request){
		
		$res = array();
		
		$id = $request->input('Record_educationId') == '' ? NULL : $request->input('Record_educationId');
		$education_title = $request->input('education_title');
		$category_education = $request->input('category_education');
		$year = $request->input('education_year');
		$description = $request->input('education_description');
		$user_id = $request->input('user_id');
		$currentDataTime = Carbon::now();
		
		$validator_array = array(
			'education_title' => $request->input('education_title'),
			'education_year' => $request->input('education_year'),
			'education_description' => $request->input('education_description')
		);

		$validator = Validator::make($validator_array, [
			'education_title' => 'required',
			'education_year' => 'required',
			'education_description' => 'required'
		]);

		$errors = $validator->errors();		
		
		if($errors->has('education_title')){
			$res['msgType'] = 'error';
			$res['msg'] = $errors->first('education_title');
			return response()->json($res);
		}
		
		if($errors->has('education_year')){
			$res['msgType'] = 'error';
			$res['msg'] = $errors->first('education_year');
			return response()->json($res);
		}
		
		if($errors->has('education_description')){
			$res['msgType'] = 'error';
			$res['msg'] = $errors->first('education_description');
			return response()->json($res);
		}
					
		$data = array(
			'id' => $id,
			'user_id' => $user_id,
			'category' => $category_education,
			'status_id' => 1,
			'post_title' => $education_title,
			"post_content" => json_encode(array(
				'year' => $year,
				'description' => $description
			)),
			'created_at' => $currentDataTime,
			'updated_at' => $currentDataTime
		);

		$value = AboutPageModel::educationInsertUpdate($data);
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
	
	//Get data for Education by id
    public function getEducationById(Request $request){
		
		$id = $request->id;

		$Data['data'] = AboutPageModel::getPostById($id);

		return $Data;
	}
	
	//Delete data for Education
	public function deleteEducation(Request $request){
		
		$res = array();

		$id = $request->id;
		
		if($id != 0){
			$value = AboutPageModel::PostDeleteById($id);
			
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
	
	//get data for Experience
    public function ExperienceByCategory(Request $request){
		
		$category = $request->category;

		$data = AboutPageModel::getExperienceData($category);
		$DataList = DataTables()->of($data)->make(true);
		
		return $DataList;
	}

	//Save data for Experience
	public function saveExperience(Request $request){
		
		$res = array();
		
		$id = $request->input('Record_ExperienceId') == '' ? NULL : $request->input('Record_ExperienceId');
		$category_experience = $request->input('category_experience');
		$experience_title = $request->input('experience_title');
		$year = $request->input('experience_year');
		$description = $request->input('experience_description');
		$user_id = $request->input('user_id');
		$currentDataTime = Carbon::now();

		$validator_array = array(
			'experience_title' => $request->input('experience_title'),
			'experience_year' => $request->input('experience_year'),
			'experience_description' => $request->input('experience_description')
		);

		$validator = Validator::make($validator_array, [
			'experience_title' => 'required',
			'experience_year' => 'required',
			'experience_description' => 'required'
		]);

		$errors = $validator->errors();		
		
		if($errors->has('experience_title')){
			$res['msgType'] = 'error';
			$res['msg'] = $errors->first('experience_title');
			return response()->json($res);
		}
		
		if($errors->has('experience_year')){
			$res['msgType'] = 'error';
			$res['msg'] = $errors->first('experience_year');
			return response()->json($res);
		}
		
		if($errors->has('experience_description')){
			$res['msgType'] = 'error';
			$res['msg'] = $errors->first('experience_description');
			return response()->json($res);
		}
					
		$data = array(
			'id' => $id,
			'user_id' => $user_id,
			'category' => $category_experience,
			'status_id' => 1,
			'post_title' => $experience_title,
			"post_content" => json_encode(array(
				'year' => $year,
				'description' => $description
			)),
			'created_at' => $currentDataTime,
			'updated_at' => $currentDataTime
		);

		$value = AboutPageModel::experienceInsertUpdate($data);
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
	
	//Get data for Experience by id
    public function getExperienceById(Request $request){
		
		$id = $request->id;

		$Data['data'] = AboutPageModel::getPostById($id);

		return $Data;
	}
	
	//Delete data for Experience
	public function deleteExperience(Request $request){
		
		$res = array();

		$id = $request->id;
		
		if($id != 0){
			$value = AboutPageModel::PostDeleteById($id);
			
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
	
	//get data for My Skills
    public function MySkillsByCategory(Request $request){
		
		$category = $request->category;

		$data = AboutPageModel::getMySkillsData($category);
		$DataList = DataTables()->of($data)->make(true);
		
		return $DataList;
	}

	//Save data for My Skills
	public function saveMySkills(Request $request){
		
		$res = array();
		
		$id = $request->input('Record_MySkillsId') == '' ? NULL : $request->input('Record_MySkillsId');
		$category = $request->input('category_MySkills');
		$title = $request->input('skill_title');
		$percentage = $request->input('skill_percentage');
		$title_alias = str_replace(' ', '', trim($title));
		$alias = Str::lower($title_alias);
		$user_id = $request->input('user_id');
		$currentDataTime = Carbon::now();
		
		$validator_array = array(
			'title' => $request->input('skill_title'),
			'percentage' => $request->input('skill_percentage')
		);

		$validator = Validator::make($validator_array, [
			'title' => 'required',
			'percentage' => 'required'
		]);

		$errors = $validator->errors();		
		
		if($errors->has('title')){
			$res['msgType'] = 'error';
			$res['msg'] = $errors->first('title');
			return response()->json($res);
		}
		
		if($errors->has('percentage')){
			$res['msgType'] = 'error';
			$res['msg'] = $errors->first('percentage');
			return response()->json($res);
		}
					
		$data = array(
			'id' => $id,
			'user_id' => $user_id,
			'category' => $category,
			'status_id' => 1,
			'post_title' => $title,
			"post_content" => json_encode(array(
				'percentage' => $percentage,
				'alias' => $alias
			)),
			'created_at' => $currentDataTime,
			'updated_at' => $currentDataTime
		);

		$value = AboutPageModel::mySkillsInsertUpdate($data);
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
	
	//Get data for My Skills by id
    public function getMySkillsById(Request $request){
		
		$id = $request->id;

		$Data['data'] = AboutPageModel::getPostById($id);

		return $Data;
	}
	
	//Delete data for My Skills
	public function deleteMySkills(Request $request){
		
		$res = array();

		$id = $request->id;
		
		if($id != 0){
			$value = AboutPageModel::PostDeleteById($id);
			
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
