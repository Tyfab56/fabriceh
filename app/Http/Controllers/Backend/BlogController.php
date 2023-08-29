<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DataTables;
use App\Blog;

class BlogController extends Controller
{
	//Blog page load
    public function blogPage(){
        return view('backend.blog');
    }
	
	//get data for Blog
    public function getBlogData(Request $request){

		$data = Blog::orderBy('id','desc');
		
		$DataList = DataTables()->of($data)->make(true);
		
		return $DataList;
	}
	
	//Save data for Blog
    public function saveBlog(Request $request){
		$res = array();

		$id = $request->input('Record_BlogId');
		$title = $request->input('blog_title');
		$description = $request->input('blog_description');
		$image = $request->input('blog_image');
		$user_id = $request->input('user_id');
		$seo_keywords = $request->input('seo_keywords');
		$seo_desc = $request->input('seo_desc');

		$validator_array = array(
			'title' => $request->input('blog_title'),
			'description' => $request->input('blog_description'),
			'blog_image' => $request->input('blog_image')
		);

		$validator = Validator::make($validator_array, [
			'title' => 'required',
			'description' => 'required',
			'blog_image' => 'required'
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
		
		if($errors->has('blog_image')){
			$res['msgType'] = 'error';
			$res['msg'] = $errors->first('blog_image');
			return response()->json($res);
		}
		
		$data = array(
			'user_id' => $user_id,
			'title' => $title,
			'description' => $description,
			'image' => $image,
			'seo_keywords' => $seo_keywords,
			'seo_desc' => $seo_desc
		);

		if($id ==''){
			$response = Blog::create($data);
			if($response){
				$res['msgType'] = 'success';
				$res['msg'] = __('New Data Added Successfully');
			}else{
				$res['msgType'] = 'error';
				$res['msg'] = __('Data insert failed');
			}
		}else{
			$response = Blog::where('id', $id)->update($data);
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
	
	//Get data for Blog by id
    public function getBlogById(Request $request){
		$Data = array();
		
		$id = $request->id;
        $Data['data']  = Blog::where('id', $id)->first();

		return $Data;
	}
	
	//Delete data for Blog
	public function deleteBlog(Request $request){
		
		$res = array();

		$id = $request->id;
		
		if($id != 0){
			$response = Blog::where('id', $id)->delete();	
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
