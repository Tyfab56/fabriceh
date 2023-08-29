<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AboutPageModel extends Model
{
	
	public static function insertUpdateAboutData($data){

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
	
	public static function getAboutByCategory($category=0){

		$data = DB::table('tp_posts')->where('category', $category)->first();
		
		return $data;
	}
	
	public static function getEducationData($category=0){

		$data = DB::table('tp_posts')->where('category', $category)->orderBy('id', 'ASC')->get(); 

		return $data;
	}
	
	public static function educationInsertUpdate($data){

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
	
	public static function getExperienceData($category=0){

		$data = DB::table('tp_posts')->where('category', $category)->orderBy('id', 'ASC')->get(); 

		return $data;
	}
	
	public static function experienceInsertUpdate($data){

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
	
	public static function getMySkillsData($category=0){

		$data = DB::table('tp_posts')->where('category', $category)->orderBy('id', 'ASC')->get(); 

		return $data;
	}	
	
	public static function mySkillsInsertUpdate($data){

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
