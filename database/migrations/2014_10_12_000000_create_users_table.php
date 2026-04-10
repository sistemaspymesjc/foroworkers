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

         User::insert([
            [
             'img' => 'user.png',
             'banner' => 'userbanner.png',
             'username' => 'user',
             'email' => 'user@gmail.com',
             'email_verified_at' => now(),
             'password' => $password,
             'token' => $password,
             'role_id' => 2,
             'country_id' => 2,
             'statu_id' => 1,
             'is_buyer' => 1,
             'theme_color' => 'black',
             'rank_id' => 2,
             'membership_start' => null,
             'membership_end' => null,
             'remember_token' => 'pqDjqmL6hQ',
             'terms' => 1,
             'is_verified' => 1,
             'is_banned' => 0,
             'reason_id' => 1,
             'url_profile' => 'https://www.upwork.com/freelancers/~016c272f36ca6d79ee',
             'url_patreon' => 'foroworkers',
             'ip_adress' => '127.0.0.1',
             'created_at' => now(),
             'updated_at' => now()
         ]
         ,
         [
            'img' => 'admin.png',
             'banner' => 'userbanner.png',
             'username' => 'admin',
             'email' => 'admin@gmail.com',
             'email_verified_at' => now(),
             'password' => $password,
             'token' => $password,
             'role_id' => 1,
             'country_id' => 1,
             'statu_id' => 1,
             'is_buyer' => 1,
             'theme_color' => 'gray',
             'rank_id' => 2,
             'membership_start' => null,
             'membership_end' => null,
             'remember_token' => 'pqDjqmL6hQ',
             'terms' => 1,
             'is_verified' => 1,
             'is_banned' => 0,
             'reason_id' => 1,
             'url_profile' => 'https://www.workana.com/freelancer/bc85b1df7df61ffb748ee88bf2a14905',
             'url_patreon' => 'foroworkers',
             'ip_adress' => '127.0.0.1',
             'created_at' => now(),
             'updated_at' => now()
         ]
         ,
     ]);     








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
