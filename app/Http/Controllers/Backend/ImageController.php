<?php

namespace App\Http\Controllers\Backend;
use App\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class ImageController extends Controller
{

    public function index()
    {
        // Affiche la liste des images depuis la base de données
        $images = Image::all();
        return view('backend.images.index', compact('images'));
    }

    public function create()
    {
        // Affiche le formulaire de création d'une nouvelle image
        return view('backend.images.create');
    }

    public function store(Request $request)
    {
        // Valide et enregistre la nouvelle image dans la base de données
        // Vous devrez gérer le téléchargement de fichiers ici
        // Redirige ensuite vers la liste des images
    }

    public function edit($id)
    {
        // Affiche le formulaire d'édition d'une image existante
        $image = Image::find($id);
        return view('backend.images.edit', compact('image'));
    }

    public function update(Request $request, $id)
    {
        // Valide et met à jour l'image dans la base de données
        // Redirige ensuite vers la liste des images
    }

    public function destroy($id)
    {
        // Supprime l'image de la base de données
        // Redirige ensuite vers la liste des images
    }
    //Blog page load
    public function blogPage(){
        return view('backend.users'); 
    }

    //Get data for Image by id
    public function getImageById(Request $request){

        $id = $request->id;
        $data  = Image::where('id', $id)->first();
	
		return $data;
        }
    //get data for Image
    public function getImageData(Request $request){

		$data = Image::orderBy('id','desc');
		
		$DataList = DataTables()->of($data)->make(true);
		
		return $DataList;
	}

    //Save data for Image
    public function saveImage(Request $request){
		
        $res = array();

		$id = $request->input('Record_ImageId');
		$title = $request->input('image_title');
		$description = $request->input('image_description');
		$image = $request->input('image_image');
		

		$validator_array = array(
			'title' => $request->input('image_title'),
			'description' => $request->input('image_description'),
			'image_image' => $request->input('image_image')
		);

		$validator = Validator::make($validator_array, [
			'title' => 'required',
			'description' => 'required',
			'image_image' => 'required'
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
		
		if($errors->has('image_image')){
			$res['msgType'] = 'error';
			$res['msg'] = $errors->first('image_image');
			return response()->json($res);
		}
		
		$data = array(
			
			'titre' => $title,
			'description' => $description,
			'fichier' => $image
			
		);
        dd($id);
		if($id ==''){
			$response = Image::create($data);
			if($response){
				$res['msgType'] = 'success';
				$res['msg'] = __('New Data Added Successfully');
			}else{
				$res['msgType'] = 'error';
				$res['msg'] = __('Data insert failed');
			}
		}else{
			$response = Image::where('id', $id)->update($data);
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

    //Delete data for image
	public function deleteImage(Request $request){
		
		$res = array();

		$id = $request->id;
		
		if($id != 0){
			$response = Image::where('id', $id)->delete();	
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
