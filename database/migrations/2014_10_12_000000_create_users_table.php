<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {

        if (env('APP_AUTHOR') == 'jonathancastro') {           

            Schema::create('users', function (Blueprint $table) {
                $table->id();
                $table->string('img');
                $table->string('banner');
                $table->string('username')->unique();
                $table->string('email')->unique();
                $table->timestamp('email_verified_at')->nullable();
                $table->string('password');
                $table->string('token')->nullable();
                $table->string('url_patreon')->nullable();
                $table->string('phone_whatsapp')->nullable();
                $table->unsignedInteger('role_id');
                $table->unsignedInteger('country_id');
                $table->unsignedInteger('statu_id');           
                $table->boolean('is_buyer');
                $table->string('theme_color');
                $table->unsignedInteger('rank_id'); 
                $table->timestamp('membership_start')->nullable();
                $table->timestamp('membership_end')->nullable();
                $table->boolean('terms');
                $table->boolean('is_verified');
            // $table->boolean('is_ignored');
                $table->boolean('is_banned');
                $table->unsignedInteger('reason_id');
                $table->string('url_profile')->nullable();
                $table->string('ip_adress');
                $table->string('api_key_factory')->nullable(); 
                $table->rememberToken();
                $table->timestamps();

            });

        //   Schema::create('password_reset_tokens', function (Blueprint $table) {
        //     $table->string('email')->primary();
        //     $table->string('token');
        //     $table->timestamp('created_at')->nullable();
        // });

            Schema::create('sessions', function (Blueprint $table) {
                $table->string('id')->primary();
                $table->foreignId('user_id')->nullable()->index();
                $table->string('ip_address', 45)->nullable();
                $table->text('user_agent')->nullable();
                $table->longText('payload');
                $table->integer('last_activity')->index();
            });

        }


        if (env('APP_ENV') == 'local') {

           $password = password_hash('Test1234',PASSWORD_BCRYPT);           

           $site = new User;      
           $site->img = 'user.png';
           $site->banner = 'userbanner.png';       
           $site->username = 'user';    
           $site->email = 'user@gmail.com';
           $site->email_verified_at = now();         
           $site->password = $password;
           $site->token =  $password;
           $site->role_id = 2;
           $site->country_id = 2; 
           $site->statu_id = 1;
           $site->is_buyer = 1;      
           $site->theme_color = 'black';
           $site->rank_id = 2;
           $site->membership_start = null;
           $site->membership_end = null;
           $site->remember_token = 'pqDjqmL6hQ';
           $site->terms = 1;
           $site->is_verified = 1;      
           $site->is_banned = 0;
           $site->reason_id = 1;
           $site->url_profile = 'https://www.udemy.com/user/jonathan-castro-33/';
           $site->url_patreon = 'foroworkers';
           $site->ip_adress = '127.0.0.1';
            // $site->api_key_factory = 'pk_1234';         
           $site->save();

           $site = new User;      
           $site->img = 'user.png';
           $site->banner = 'userbanner.png';       
           $site->username = 'admin';    
           $site->email = 'admin@gmail.com';
           $site->email_verified_at = now();         
           $site->password = $password;
           $site->token =  $password;
           $site->role_id = 1;
           $site->country_id = 1; 
           $site->statu_id = 1;
           $site->is_buyer = 1;      
           $site->theme_color = 'gray';
           $site->rank_id = 1;
           $site->membership_start = null;
           $site->membership_end = null;
           $site->remember_token = 'pqDjqmL6hQ';
           $site->terms = 1;
           $site->is_verified = 1;      
           $site->is_banned = 0;
           $site->reason_id = 1;
           $site->url_profile = 'https://www.upwork.com/freelancers/~016c272f36ca6d79ee';
           $site->url_patreon = 'foroworkers';
           $site->ip_adress = '127.0.0.1';
           $site->api_key_factory = 'pk_1234';         
           $site->save();

           $site = new User;      
           $site->img = 'user.png';
           $site->banner = 'userbanner.png';       
           $site->username = 'leads';    
           $site->email = 'leads@gmail.com';
           $site->email_verified_at = now();         
           $site->password = $password;
           $site->token =  $password;
           $site->role_id = 3;
           $site->country_id = 2; 
           $site->statu_id = 1;
           $site->is_buyer = 0;      
           $site->theme_color = 'black';
           $site->rank_id = 2;
           $site->membership_start = null;
           $site->membership_end = null;
           $site->remember_token = 'pqDjqmL6hQ';
           $site->terms = 1;
           $site->is_verified = 1;      
           $site->is_banned = 0;
           $site->reason_id = 1;
           $site->url_profile = 'https://www.udemy.com/user/jonathan-castro-33/';
           $site->url_patreon = 'foroworkers';
           $site->ip_adress = '127.0.0.1';
         // $site->api_key_factory = '123456';         
           $site->save();          




       }


   }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
