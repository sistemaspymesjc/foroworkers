<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\MainCategory;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maincategorys', function (Blueprint $table) {
            $table->id();
            $table->string('maincategory_icon',255)->nullable();
            $table->string('maincategory_name',255)->nullable();
            $table->string('maincategory_url',255)->nullable();
            $table->string('promo_url',255)->nullable();
            $table->string('promo_banner',255)->nullable();
            $table->string('promo_video',255)->nullable();                  
            $table->unsignedInteger('subcategory_id');   
            $table->timestamps();
        });

         if (env('APP_ENV') == 'local') {        

            MainCategory::insert([
            [
               'maincategory_icon' => 'fa-solid fa-house',
               'maincategory_name' => 'Domains',
               'maincategory_url' => 'domains',
               'subcategory_id' => 1,             
               'created_at' => now(),
               'updated_at' => now()
           ]
           ,
           [
           'maincategory_icon' => 'fa-solid fa-palette',
               'maincategory_name' => 'Developers',
               'maincategory_url' => 'developers',
               'subcategory_id' => 2,             
               'created_at' => now(),
               'updated_at' => now()
        ]
        ,
         [
           'maincategory_icon' => 'fa-solid fa-code',
               'maincategory_name' => 'Laravel',
               'maincategory_url' => 'laravel',
               'subcategory_id' => 3,             
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
        Schema::dropIfExists('maincategorys');
    }
};
