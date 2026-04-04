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
