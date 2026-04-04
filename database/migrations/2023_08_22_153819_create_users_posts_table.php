<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\UserPost;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('post_id');
            $table->unsignedInteger('maincategory_id');
            $table->timestamps();
        });

        
        $userpost = new UserPost;
        $userpost->user_id = 1;
        $userpost->post_id = 1;       
        $userpost->maincategory_id = 1;      
        $userpost->save();

        $userpost = new UserPost;
        $userpost->user_id = 2;
        $userpost->post_id = 2;      
        $userpost->maincategory_id = 2;      
        $userpost->save();

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_posts');
    }
};
