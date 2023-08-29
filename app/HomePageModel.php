<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class HomePageModel extends Model
{
	
	public static function getHomeContentbyCategory($category=0){

		$data = DB::table('tp_posts')->where('category', $category)->first();
		
		return $data;
	}
	
	public static function insertUpdateData($data){

		$value = DB::table('tp_posts')->where('category', $data['category'])->get();
		
		if($value->count() == 0){
			DB::table('tp_posts')->insert($data);
			return 1;
		}elseif($value->count()>0){
			DB::table('tp_posts')->where('category', $data['category'])->update($data);			
			return 2;
		}else{
			return 0;
		}
	}
	
	public static function getAnimatedClipTextData($category=0){

		$data = DB::table('tp_posts')->where('category', $category)->orderBy('id', 'DESC')->get(); 

		return $data;
	}
	
	public static function AnimatedClipTextInsertUpdate($data){

		$value = DB::table('tp_posts')->where('id', $data['id'])->get();
		
		if($value->count() == 0){
			DB::table('tp_posts')->insert($data);
			return 1;
		}elseif($value->count()>0){
			DB::table('tp_posts')->where('id', $data['id'])->update($data);			
			return 2;
		}else{
			return 0;
		}
	}
	
	public static function getPostById($id=0){

		$data = DB::table('tp_posts')->where('id', $id)->first();
		
		return $data;
	}
	
	public static function PostDeleteById($id){
		
		$affected = DB::table('tp_posts')->where('id', '=', $id)->delete(); 
		
		if($affected){
			return 1;
		}else{
			return 0;
		}
	}
}
