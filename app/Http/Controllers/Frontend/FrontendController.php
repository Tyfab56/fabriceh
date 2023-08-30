<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\HomePageModel; 
use App\AboutPageModel;
use App\Portfolio;
use App\Blog;
use App\ContactPageModel;
use App\Setting;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//use App\Mail\SendEmail;

class FrontendController extends Controller
{
	//Get Frontend Data
    public function index()
	{
		
		//Home
		$home_data = HomePageModel::getHomeContentbyCategory('home_content');
	 	if($home_data !=''){
			$home_post_content = $home_data->post_content;
			$postContent = json_decode($home_post_content);
			$data['name'] = $home_data->post_title;
			$data['subtitle'] = $home_data->post_subtitle;
			$data['btntext'] = $home_data->post_btntext;
			$data['your_photo'] = $postContent->your_photo;
			$data['background_image'] = $postContent->background_image;
			$data['video_background'] = $postContent->video_background;
		}else{
			$data['name'] = "Your Name";
			$data['your_photo'] = "";
			$data['background_image'] = "";
			$data['video_background'] = "";
		}

		$data['animated_clip_text'] = HomePageModel::getAnimatedClipTextData('animated_clip_text');

		//About
		$aboutdata = AboutPageModel::getAboutByCategory('about');
		if($aboutdata !=''){
			$post_content = $aboutdata->post_content;
			$data['aboutdata'] = json_decode($post_content);
			$data['about_title'] = $aboutdata->post_title;
		}else{
			$post_content = json_encode(array(
					"description" => "description",
					"name" => "name",
					"email" => "email",
					"skype" => "skype",
					"phone" => "phone",
					"experience" => "experience",
					"address" => "address",
					"hire_me" => "hire me",
					"your_photo" => "",
					"download_cv" => "download cv"
				));
			$data['aboutdata'] = json_decode($post_content);
			$data['about_title'] = "title";
		}

		//Education
		$data['educationdata'] = AboutPageModel::getEducationData('education');
		
		//Experience
		$data['experiencedata'] = AboutPageModel::getExperienceData('experience');
		
		//My Skills
		$data['skillsdata'] = AboutPageModel::getMySkillsData('my_skills');
		
		//Portfolio
		$data['portfolio'] = Portfolio::orderBy('id','desc')->get();
		
		//Blog
		$data['blog'] = DB::table('blogs')
					->join('users', 'blogs.user_id', '=', 'users.id')
					->select('blogs.*', 'users.name')->orderBy('id','desc')
					->skip(0)->take(12)
					->get();
		
		//Contact
		$contact = ContactPageModel::getContactByCategory('contact');
		if($contact !=''){
			$contact_post_content = $contact->post_content;
			$data['contactdata'] = json_decode($contact_post_content);
			$data['contact_title'] = $contact->post_title;
		}else{
			$contact_post_content = json_encode(array(
					"email" => "email",
					"skype" => "skype",
					"phone" => "phone",
					"address" => "address"
				));
			$data['contactdata'] = json_decode($contact_post_content);
			$data['contact_title'] = "title";
		}

        return view('frontend.home', $data);
		
    }
	// Get Another Data
	public function another(){	
		
				return view('frontend.another');
		
    }

	//Get Blog Data
    public function getBlogs(){	
		$data['blog'] = DB::table('blogs')
					->join('users', 'blogs.user_id', '=', 'users.id')
					->select('blogs.*', 'users.name')->orderBy('id','desc')
					->get();
					
        return view('frontend.blog', $data);
		
    }
	
	//Get Article Data
    public function getArticle($id, $title){

		$data['blog'] = DB::table('blogs')
					->join('users', 'blogs.user_id', '=', 'users.id')
					->select('blogs.*', 'users.name')
					->where('blogs.id', $id)
					->get();

		$data['recent_posts'] = DB::table('blogs')
					->join('users', 'blogs.user_id', '=', 'users.id')
					->select('blogs.*', 'users.name')->orderBy('id','desc')
					->skip(0)->take(9)
					->get();
					
		return view('frontend.article', $data);
    }
	
	//sent Contact Form Message
	public function sentContactFormMessage(Request $request){
		$res = array();

		//Setting
		$setting_data = Setting::where('bactive', 1)->get();
		$id = '';
		foreach ($setting_data as $row){
			$id = $row['id'];
		}
		
		if($id != ''){
			$sData = json_decode($setting_data);
			$recaptcha = $sData[0]->recaptcha;
			$sitekey = $sData[0]->sitekey;
			$secretkey = $sData[0]->secretkey;
			$ismail = $sData[0]->ismail;
			$fromname = $sData[0]->fromname;
			$frommailaddress = $sData[0]->frommailaddress;
			$toname = $sData[0]->toname;
			$tomailaddress = $sData[0]->tomailaddress;
			$site_title = $sData[0]->site_title;
		}else{
			$recaptcha = 0;
			$sitekey = '';
			$secretkey = '';
			$ismail = 0;
			$fromname = '';
			$frommailaddress = '';
			$toname = '';
			$tomailaddress = '';
			$site_title = '';
		}

		$name = $request->input('name');
		$email = $request->input('email');
		$subject = $request->input('subject');
		$message = $request->input('message');
		
		$validator_array = array(
			'name' => $request->input('name'),
			'email' => $request->input('email'),
			'subject' => $request->input('subject'),
			'message' => $request->input('message')
		);

		$validator = Validator::make($validator_array, [
			'name' => 'required',
			'email' => 'required',
			'subject' => 'required',
			'message' => 'required'
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
		
		if($errors->has('subject')){
			$res['msgType'] = 'error';
			$res['msg'] = $errors->first('subject');
			return response()->json($res);
		}
		
		if($errors->has('message')){
			$res['msgType'] = 'error';
			$res['msg'] = $errors->first('message');
			return response()->json($res);
		}
		
		if($recaptcha == 1){
			$captcha = $request->input('g-recaptcha-response');
			if(!$captcha){
				$res['msgType'] = 'error';
				$res['msg'] = __('Please check the captcha');
				return response()->json($res);
			}

			$ip = $_SERVER['REMOTE_ADDR'];
			$url = 'https://www.google.com/recaptcha/api/siteverify?secret='.urlencode($secretkey).'&response='.urlencode($captcha).'&remoteip'.$ip;
			$response = file_get_contents($url);
			$responseKeys = json_decode($response, true);
			if($responseKeys["success"] == false) {
				$res['msgType'] = 'error';
				$res['msg'] = __('reCAPTCHA is not valid. Please try again!');
				return response()->json($res);
			}
		}
			
		if($ismail == 1){
			
			require 'vendor/autoload.php';
			
			$mail = new PHPMailer(true);

			try {
				$mail->setFrom($frommailaddress, $fromname);
				$mail->addAddress($tomailaddress, $toname);
				$mail->isHTML(true);
				$mail->CharSet = "utf-8";
				$mail->Subject = $subject;
				$mail->Body = "<table style='background-color:#edf2f7;color:#111111;padding:40px 0px;line-height:24px;font-size:14px;' border='0' cellpadding='0' cellspacing='0' width='100%'>	
								<tr>
									<td>
										<table style='background-color:#fff;max-width:600px;margin:0 auto;padding:30px;' border='0' cellpadding='0' cellspacing='0' width='100%'>
											<tr><td style='padding-bottom:7px;'><strong>Name: </strong>".$name."</td></tr>
											<tr><td style='padding-bottom:7px;'><strong>Email: </strong>".$email."</td></tr>
											<tr><td style='padding-bottom:7px;'><strong>Subject: </strong>".$subject."</td></tr>
											<tr><td style='padding-bottom:50px;'><strong>Message: </strong>".$message."</td></tr>
											<tr><td style='padding-top:10px;'>Thank you!</td></tr>
											<tr><td style='padding-top:5px;padding-bottom:40px;'><strong>".$site_title."</strong></td></tr>
											<tr><td style='padding-top:10px;border-top:1px solid #ddd;'>Mail from ".$site_title." contact form</td></tr>
										</table>
									</td>
								</tr>
							</table>";
				$mail->send();
				
				$res['msgType'] = 'success';
				$res['msg'] = __('Your message has been delivered');
				return response()->json($res);
				
			} catch (Exception $e) {
				$res['msgType'] = 'error';
				$res['msg'] = __('Oops! Message could not be sent. Please try again.');
				return response()->json($res);
			}
		}else{
			$res['msgType'] = 'error';
			$res['msg'] = __('Oops! Message could not be sent. Please try again.');
			return response()->json($res);
		}
	}
}
