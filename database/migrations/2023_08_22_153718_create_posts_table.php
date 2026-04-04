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

        // propiedades digitales tiene 11 categorias
        $post = new Post;
        $post->post_name = 'negocio uno';
        $post->url_name = 'negocio-uno';
        $post->post_content = '<h1>Negocio de Ejemplo</h1><br><p>Detalla cada uno de los requisitos</p><br><p>Evita comunicarte en plataformas externas</p><br><p>Investiga la reputacion del cliente o freelance</p><br><p>Toma de ejemplos los tutoriales en youtube</p><br><p>Procura negociar con clientes o freelance que muestren una imagen real de su persona o de su marca</p><br><p>Solo califica cuando estes seguro y se pueden apelar luego de finalizadas</p>';
        //categoria ejemplo dominios
        $post->maincategory_id = 1;
         // compra es 4 venta es 5
        $post->type_id = 4;
        // Premium 1 Free es 2
        $post->site_id = 1;
        $post->price = 10;
        $post->comition_id = 1;
        $post->payment_id = 1;
        $post->revition_id = 1;                      
        $post->save();

        $post = new Post;
        $post->post_name = 'negocio uno';
        $post->url_name = 'negocio-uno';
        $post->post_content = '<h1>Negocio de Ejemplo</h1><br><p>Detalla cada uno de los requisitos</p><br><p>Evita comunicarte en plataformas externas</p><br><p>Investiga la reputacion del cliente o freelance</p><br><p>Toma de ejemplos los tutoriales en youtube</p><br><p>Procura negociar con clientes o freelance que muestren una imagen real de su persona o de su marca</p><br><p>Solo califica cuando estes seguro y se pueden apelar luego de finalizadas</p>';
        $post->maincategory_id = 1;
        $post->type_id = 5;
        $post->site_id = 2;
        $post->price = 10;
        $post->comition_id = 1;
        $post->payment_id = 1;
        $post->revition_id = 1;                      
        $post->save();

       

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
