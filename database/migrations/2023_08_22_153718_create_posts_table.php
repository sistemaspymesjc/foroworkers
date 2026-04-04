<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\Post;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         if (env('APP_AUTHOR') == 'jonathancastro') {    

        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('post_name',255)->nullable();
            $table->string('url_name',255)->nullable();          
            $table->longText('post_content')->nullable();
            $table->unsignedInteger('maincategory_id');
            $table->unsignedInteger('type_id');
            $table->unsignedInteger('site_id');
            // $table->string('price',255)->nullable();
            $table->integer('price');
            $table->unsignedInteger('comition_id');
            $table->unsignedInteger('payment_id');
            $table->unsignedInteger('revition_id');
            $table->boolean('publish')->nullable();
            $table->integer('views')->default('0');
            // $table->unsignedInteger('comment_id');         
            $table->timestamps();
        });

         }

          if (env('APP_ENV') == 'local') {   

       

       

         }






    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
};
