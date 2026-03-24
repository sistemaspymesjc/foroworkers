<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\Forum;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {

        if (env('APP_AUTHOR') == 'jonathancastro') {  

    	Schema::create('forums', function (Blueprint $table) {
    		$table->id();        
    		$table->string('forum_name');
    		$table->string('forum_tittle');
    		$table->string('forum_description');
    		$table->unsignedInteger('user_id');    		            
    		$table->timestamps();
    	});

        }

         if (env('APP_ENV') == 'local') {    

    	$reply = new Forum;
    	$reply->forum_name = 'Foroworkers';
    	$reply->forum_tittle = 'Foro de SEO, WebMasters en Español';
    	$reply->forum_description = 'Foro de SEO en Español, Webmasters, Negocios, Emprendedores, Compra y Venta de Servicios Online, Ofertas, Promociones en foroworkers.com';
    	$reply->user_id = 1;    	       
    	$reply->save();

         }
         
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    	Schema::dropIfExists('forums');
    }
};
