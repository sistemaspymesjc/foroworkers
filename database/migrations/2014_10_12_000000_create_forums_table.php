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
              $table->string('forum_name')->unique();
              $table->string('forum_tittle');
              $table->string('forum_description');
              $table->longText('forum_content')->nullable();
            // $table->longText('course_body')->nullable();
              $table->unsignedInteger('user_id')->unique();
              $table->boolean('is_digitalp'); 
              $table->boolean('is_services'); 
              $table->boolean('is_community');
              $table->integer('software_id')->default('1');
          // $table->string('forum_api_key')->nullable();     		            
              $table->timestamps();
          });

       }

       if (env('APP_ENV') == 'local') {    

           $reply = new Forum;
           $reply->forum_name = 'Foroworkers';
           $reply->forum_tittle = 'Foro de SEO, WebMasters en Español';
           $reply->forum_description = 'Foro de SEO en Español, Webmasters, Negocios, Emprendedores, Compra y Venta de Servicios Online, Ofertas, Promociones en foroworkers.com';
           $reply->forum_content = '<h1 class="h1">Foro de SEO, WebMasters en Español</h1>
           <hr>
           <ul>
           <li><b>Foro de Negocios</b></li>
           <li>Compra y Venta de Servicios Online</li>
           <li>Gana dinero como Freelance con tu Talento</li>
           <li>Descubre ofertas de trabajos diariamente o mensualmente</li>
           <li>Negocios Seguros, siguiendo las recomendaciones</li>
           <li>Recursos Premium y Gratis</li>
           </ul>';
           $reply->user_id = 2;
           $reply->is_digitalp = 1;
           $reply->is_services = 1;
           $reply->is_community = 1;       
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
