<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTpPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tp_posts', function (Blueprint $table) {
            $table->id();
			$table->integer('user_id');
			$table->string('category');
			$table->text('post_title')->nullable();
			$table->longText('post_content')->nullable();
			$table->tinyInteger('status_id');			
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
        Schema::dropIfExists('tp_posts');
    }
}
