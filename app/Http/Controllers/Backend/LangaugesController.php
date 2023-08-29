<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Langauge;
use App\Languagekeyword;
use DataTables;
use File;
use App;

class LangaugesController extends Controller
{
	//Langauges page load
    public function langaugesPage(){
        return view('backend.langauges');
    }

	//get data for Langauge
    public function getLangaugeData(Request $request){
		
		$data = Langauge::orderBy('id','desc');
		
		$DataList = DataTables()->of($data)->make(true);
		
		return $DataList;
	}
	
	//Save data for Langauge
    public function saveLangauge(Request $request){
		$res = array();

		$id = $request->input('RecordId');
		$old_language_code = $request->input('old_language_code');
		$language_code = $request->input('language_code');
		$language_name = $request->input('language_name');
		
		$languageDefault = $request->input('language_default');
        if ($languageDefault == 'true' || $languageDefault == 'on') {
            $language_default = 1;
        } else {
            $language_default = 0;
        }

		$validator_array = array(
			'language_code' => $request->input('language_code'),
			'language_name' => $request->input('language_name')
		);

		$rId = $id == '' ? '' : ','.$id;
		$validator = Validator::make($validator_array, [
			'language_code' => 'required|max:100|unique:langauges,language_code' . $rId,
			'language_name' => 'required|max:190|unique:langauges,language_name' . $rId
		]);

		$errors = $validator->errors();		
		
		if($errors->has('language_code')){
			$res['msgType'] = 'error';
			$res['msg'] = $errors->first('language_code');
			return response()->json($res);
		}
		
		if($errors->has('language_name')){
			$res['msgType'] = 'error';
			$res['msg'] = $errors->first('language_name');
			return response()->json($res);
		}
		
		$data = array(
			'language_code' => $language_code,
			'language_name' => $language_name,
			'language_default' => $language_default
		);
		
		if($language_default == 1){
			DB::update('update langauges set language_default = "0"');
		}
		
		if($id ==''){
			$response = Langauge::create($data);
			if($response){
				$res['msgType'] = 'success';
				$res['msg'] = __('New Data Added Successfully');
				
				self::languagekeywordsInsert($language_code);
				
				self::saveJSONFile($language_code);
				
			}else{
				$res['msgType'] = 'error';
				$res['msg'] = __('Data insert failed');
			}
		}else{

			$response = Langauge::where('id', $id)->update($data);
			if($response){
				
				DB::update('update languagekeywords set language_code = "'.$language_code.'" where language_code = ?', [$old_language_code]);
				
				$count = Languagekeyword::where('language_code','=', $language_code)->count();
				if($count == 0){
					self::languagekeywordsInsert($language_code);
					self::saveJSONFile($language_code);
				}
				
				$defaultCount = Langauge::where('language_default','=','1')->count();
				if($defaultCount == 0){
					DB::update('update langauges set language_default = 1 where language_code = ?', ['en']);
				}
				
				$res['msgType'] = 'success';
				$res['msg'] = __('Data Updated Successfully');
			}else{
				$res['msgType'] = 'error';
				$res['msg'] = __('Data update failed');
			}
		}
		
		return response()->json($res);
    }
	
	//Get data for Langauge by id
    public function getLangaugeById(Request $request){
		$Data = array();
		
		$id = $request->id;
        $Data['data']  = Langauge::where('id', $id)->first();

		return $Data;
	}
	
	//Delete data for Langauge
	public function deleteLangauge(Request $request){
		
		$res = array();

		$id = $request->id;
		$language_code = $request->language_code;
		
		if($id != 0){
			Languagekeyword::where('language_code', $language_code)->delete();	
			$response = Langauge::where('id', $id)->delete();
			if($response){
				
				$locale = session()->get('locale');
				if($locale == $language_code){
					$count = Langauge::where('language_default','=','1')->count();
					if($count == 0){
						DB::update('update langauges set language_default = 1 where language_code = ?', ['en']);
					}
					
					App::setLocale('en');
					session()->put('locale', 'en');
				}
				
				self::deleteJSONFile($language_code);
				
				$res['msgType'] = 'success';
				$res['msg'] = __('Data Removed Successfully');
			}else{
				$res['msgType'] = 'error';
				$res['msg'] = __('Data remove failed');
			}
		}
		
		return response()->json($res);
	}
	
	//Insert for Langauge keywords
	public function languagekeywordsInsert($language_code){
		
		$currentDataTime = Carbon::now();
		
		DB::insert("INSERT INTO languagekeywords(language_code, language_keywords, language_text, created_at, updated_at) 
		SELECT '".$language_code."', language_keywords, language_text, '".$currentDataTime."', '".$currentDataTime."'
		FROM languagekeywords WHERE language_code = 'en'");
	}
	
	//get data for Language keyword
    public function getLanguagekeywordData(Request $request){

		$language_code = $request->language_code;

		$data = Languagekeyword::where('language_code', $language_code)->orderBy('language_keywords','asc');

		$DataList = DataTables()->of($data)->make(true);
		
		return $DataList;
	}
	
	//Get data for Language Keyword by id
    public function getLanguageKeywordById(Request $request){
		$Data = array();
		
		$id = $request->id;
        $Data['data']  = Languagekeyword::where('id', $id)->first();

		return $Data;
	}
	
	//Save data for Language Keyword
    public function saveLanguageKeyword(Request $request){
		$res = array();

		$id = $request->input('LanguagekeywordId');
		$language_code = $request->input('language_code');
		$language_keywords = $request->input('language_keywords');
		$language_text = $request->input('language_text');

		$validator_array = array(
			'language_keywords' => $request->input('language_keywords'),
			'language_text' => $request->input('language_text'),
			'language_code' => $request->input('language_code')
		);
		
		$validator = Validator::make($validator_array, [
			'language_keywords' => 'required',
			'language_text' => 'required',
			'language_code' => 'required'
		]);

		$errors = $validator->errors();		
		
		if($errors->has('language_keywords')){
			$res['msgType'] = 'error';
			$res['msg'] = $errors->first('language_keywords');
			return response()->json($res);
		}
		
		if($errors->has('language_text')){
			$res['msgType'] = 'error';
			$res['msg'] = $errors->first('language_text');
			return response()->json($res);
		}
		
		if($errors->has('language_code')){
			$res['msgType'] = 'error';
			$res['msg'] = $errors->first('language_code');
			return response()->json($res);
		}
		
		$data = array(
			'language_keywords' => $language_keywords,
			'language_text' => $language_text,
			'language_code' => $language_code
		);
		
		if($id ==''){
			$response = Languagekeyword::create($data);
			if($response){
				$res['msgType'] = 'success';
				$res['msg'] = __('New Data Added Successfully');

				self::saveJSONFile($language_code);
				
			}else{
				$res['msgType'] = 'error';
				$res['msg'] = __('Data insert failed');
			}
		}else{
			$response = Languagekeyword::where('id', $id)->update($data);
			if($response){
				$res['msgType'] = 'success';
				$res['msg'] = __('Data Updated Successfully');
				self::saveJSONFile($language_code);
			}else{
				$res['msgType'] = 'error';
				$res['msg'] = __('Data update failed');
			}
		}
		
		return response()->json($res);
    }
	
	//Delete data for Langauge Keywords
	public function deleteLangaugeKeywords(Request $request){
		
		$res = array();

		$id = $request->id;
		$language_code = $request->language_code;
		
		if($id != 0){
			$response = Languagekeyword::where('id', $id)->delete();
			if($response){
				
				self::saveJSONFile($language_code);
				
				$res['msgType'] = 'success';
				$res['msg'] = __('Data Removed Successfully');
			}else{
				$res['msgType'] = 'error';
				$res['msg'] = __('Data remove failed');
			}
		}
		
		return response()->json($res);
	}
	
	//Get data for Langauge combo
    public function getLangaugeCombo(Request $request){
		$Data = array();

        $Data['data']  = Langauge::all();

		return $Data;
	}

    private function saveJSONFile($language_code){
        
		if(File::exists(base_path('resources/lang/'.$language_code.'.json'))){
			File::delete(base_path('resources/lang/'.$language_code.'.json'));
        }
		
		$data = array();
		$lanList = Languagekeyword::where('language_code', $language_code)->get();
		foreach ($lanList as $row){
			$data[$row['language_keywords']] = $row['language_text'];
		}
	
        ksort($data);

        $jsonData = json_encode($data, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);

        file_put_contents(base_path('resources/lang/'.$language_code.'.json'), stripslashes($jsonData));
    }
	
    private function deleteJSONFile($language_code){
        
		if(File::exists(base_path('resources/lang/'.$language_code.'.json'))){
			File::delete(base_path('resources/lang/'.$language_code.'.json'));
        }
    }
}
