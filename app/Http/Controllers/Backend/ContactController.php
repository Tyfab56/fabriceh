<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use App\ContactPageModel;
use Carbon\Carbon;

class ContactController extends Controller
{
	
	//Contact page load
    public function ContactPage(){
        return view('backend.contact');
    }
	
	//Save data for Contact
	public function saveContact(Request $request){
		
		$res = array();
		
		$user_id = $request->input('user_id');
		$currentDataTime = Carbon::now();
		$category = $request->input('category_contact');
		
		$title = $request->input('contact_title');
		$email = $request->input('contact_email');
		$skype = $request->input('contact_skype');
		$phone = $request->input('contact_phone');
		$address = $request->input('contact_address');
		
		$validator_array = array(
			'email' => $request->input('contact_email'),
			'skype' => $request->input('contact_skype'),
			'phone' => $request->input('contact_phone'),
			'address' => $request->input('contact_address')
		);

		$validator = Validator::make($validator_array, [
			'email' => 'required',
			'skype' => 'required',
			'phone' => 'required',
			'address' => 'required'
		]);

		$errors = $validator->errors();		
		
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
			
		$data = array(
			'user_id' => $user_id,
			'category' => $category,
			'status_id' => 1,
			'post_title' => $title,
			"post_content" => json_encode(array(
				'email' => $email,
				'skype' => $skype,
				'phone' => $phone,
				'address' => $address
			)),
			'created_at' => $currentDataTime,
			'updated_at' => $currentDataTime
		);

		$value = ContactPageModel::insertUpdateContactData($data);
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
	
	//get data for Contact
    public function ContactbyCategory(Request $request){
		
		$category = $request->category;

		$Data['data'] = ContactPageModel::getContactByCategory($category);

		return $Data;
	}	
}
