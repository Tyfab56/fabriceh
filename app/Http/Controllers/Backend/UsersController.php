<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use DataTables;

class UsersController extends Controller
{
	
	//Users page load
    public function UsersPage(){
		// Charger les collections
		$collections = Collection::all();
		dd($collections);
        return view('backend.users',$collections);
    }
	
	//My profile page load
    public function MyProfilePage(){
        return view('backend.profile');
    }
	
	//get data for Users
    public function getUsersData(Request $request){
		
		$data = User::orderBy('id','desc');
		
		$DataList = DataTables()->of($data)->make(true);
		
		return $DataList;
	}
	
	//Save data for Users
    public function saveUsers(Request $request){
		$res = array();
		
		$id = $request->input('Record_UserId');
		$name = $request->input('name');
		$email = $request->input('email');
		$password = $request->input('password');
		$address = $request->input('address');
		$image = $request->input('profile_photo');
		
		$validator_array = array(
			'name' => $request->input('name'),
			'email' => $request->input('email'),
			'password' => $request->input('password'),
			'photo' => $request->input('profile_photo')
		);
		$rId = $id == '' ? '' : ','.$id;
		$validator = Validator::make($validator_array, [
			'name' => 'required|max:191',
			'email' => 'required|max:191|unique:users,email' . $rId,
			'password' => 'required|max:191',
			'photo' => 'required|max:191',
		]);

		$errors = $validator->errors();

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
		
		if($errors->has('password')){
			$res['msgType'] = 'error';
			$res['msg'] = $errors->first('password');
			return response()->json($res);
		}
		
		if($errors->has('photo')){
			$res['msgType'] = 'error';
			$res['msg'] = $errors->first('photo');
			return response()->json($res);
		}
		
		$data = array(
			'name' => $name,
			'email' => $email,
			'password' => Hash::make($password),
			'address' => $address,
			'image' => $image,
			'status' => 1,
			'bactive' => base64_encode($password)
		);

		if($id ==''){
			$response = User::create($data);
			if($response){
				$res['msgType'] = 'success';
				$res['msg'] = __('New Data Added Successfully');
			}else{
				$res['msgType'] = 'error';
				$res['msg'] = __('Data insert failed');
			}
		}else{
			$response = User::where('id', $id)->update($data);
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
	
	//Get data for Users by id
    public function getUserById(Request $request){

		$id = $request->id;
        $data  = User::where('id', $id)->first();
		$data->bactive = base64_decode($data->bactive);
		// Retourner les collections pour le select

		return $data;
	}
	
	//Delete data for Users
	public function deleteUser(Request $request){
		
		$res = array();

		$id = $request->id;
		
		if($id != 0){
			$response = User::where('id', $id)->delete();	
			if($response){
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
