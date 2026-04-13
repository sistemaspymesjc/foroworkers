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

        if (env('APP_ENV') == 'local') {        

            UserPost::insert([
                [
                 'user_id' => 2,
                 'post_id' => 1,
                 'maincategory_id' => 1,             
                 'created_at' => now(),
                 'updated_at' => now()
             ]
             ,
             [
                'user_id' => 2,
                'post_id' => 2,
                'maincategory_id' => 2,             
                'created_at' => now(),
                'updated_at' => now()
            ]
            ,
            [
                'user_id' => 2,
                'post_id' => 3,
                'maincategory_id' => 3,             
                'created_at' => now(),
                'updated_at' => now()
            ]
            ,
        ]);

            }

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
