<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
			$table->text('site_title')->nullable();
			$table->text('site_url')->nullable();
			$table->string('home_page')->nullable();
			$table->string('front_logo', 255)->nullable();
			$table->string('back_logo', 255)->nullable();
			$table->string('favicon', 255)->nullable();
			$table->longText('theme_font')->nullable();
			$table->longText('theme_color')->nullable();
			$table->longText('social_media')->nullable();
			$table->longText('metatag')->nullable();
			$table->text('copyright')->nullable();			
			$table->tinyInteger('bactive')->nullable();
			$table->tinyInteger('recaptcha')->nullable();
			$table->text('sitekey')->nullable();
			$table->text('secretkey')->nullable();
			$table->tinyInteger('ismail')->nullable();
			$table->text('fromname')->nullable();
			$table->text('frommailaddress')->nullable();
			$table->text('toname')->nullable();
			$table->text('tomailaddress')->nullable();
			$table->tinyInteger('is_multi_language')->nullable();
			$table->tinyInteger('is_gmap')->nullable();
			$table->text('gmap')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
