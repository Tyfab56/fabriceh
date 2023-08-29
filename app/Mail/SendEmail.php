<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Setting;

class SendEmail extends Mailable
{
    use Queueable, SerializesModels;
	
	public $details;
	
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
		//Setting
		$setting_data = Setting::where('bactive', 1)->get();
		$id = '';
		foreach ($setting_data as $row){
			$id = $row['id'];
		}
		if($id != ''){
			$sData = json_decode($setting_data);
			$site_title = $sData[0]->site_title;
		}else{
			$site_title = 'EXP';
		}
	
        return $this->subject('Mail from '.$site_title.' contact form')->view('mail.send_mail');
    }
}
