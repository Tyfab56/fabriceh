<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Portfolio;
use DataTables;

class PortfolioController extends Controller
{
	
	//Portfolio page load
    public function portfolioPage(){
        return view('backend.portfolio');
    }
	
	//get data for Portfolio
    public function getPortfolioData(Request $request){
		
		$data = Portfolio::orderBy('id','desc');
		
		$DataList = DataTables()->of($data)->make(true);
		
		return $DataList;
	}
	
	//Save data for Portfolio
    public function savePortfolio(Request $request){
		$res = array();

		$id = $request->input('Record_PortfolioId');
		$title = $request->input('portfolio_title');
		$image = $request->input('portfolio_image');
		$url = $request->input('portfolio_url');

		$validator_array = array(
			'title' => $request->input('portfolio_title'),
			'portfolio_image' => $request->input('portfolio_image')
		);

		$validator = Validator::make($validator_array, [
			'title' => 'required',
			'portfolio_image' => 'required'
		]);

		$errors = $validator->errors();		
		
		if($errors->has('title')){
			$res['msgType'] = 'error';
			$res['msg'] = $errors->first('title');
			return response()->json($res);
		}
		
		if($errors->has('portfolio_image')){
			$res['msgType'] = 'error';
			$res['msg'] = $errors->first('portfolio_image');
			return response()->json($res);
		}
		
		$data = array(
			'title' => $title,
			'image' => $image,
			'url' => $url
		);

		if($id ==''){
			$response = Portfolio::create($data);
			if($response){
				$res['msgType'] = 'success';
				$res['msg'] = __('New Data Added Successfully');
			}else{
				$res['msgType'] = 'error';
				$res['msg'] = __('Data insert failed');
			}
		}else{
			$response = Portfolio::where('id', $id)->update($data);
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
	
	//Get data for Portfolio by id
    public function getPortfolioById(Request $request){
		$Data = array();
		
		$id = $request->id;
        $Data['data']  = Portfolio::where('id', $id)->first();

		return $Data;
	}

	//Delete data for Portfolio
	public function deletePortfolio(Request $request){
		
		$res = array();

		$id = $request->id;
		
		if($id != 0){
			$response = Portfolio::where('id', $id)->delete();	
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
