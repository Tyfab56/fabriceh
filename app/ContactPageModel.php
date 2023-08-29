<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ContactPageModel extends Model
{
	public static function insertUpdateContactData($data){

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
	
	public static function getContactByCategory($category=0){

		$data = DB::table('tp_posts')->where('category', $category)->first();
		
		return $data;
	}
}
