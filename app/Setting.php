<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
	
	protected $table = 'settings';
	
    protected $fillable = [
        'site_title','site_url','home_page','front_logo','back_logo','favicon','theme_font','theme_color','social_media','copyright','bactive','metatag','recaptcha','sitekey','secretkey','ismail','fromname','frommailaddress','toname','tomailaddress','is_gmap','gmap'
    ];
}