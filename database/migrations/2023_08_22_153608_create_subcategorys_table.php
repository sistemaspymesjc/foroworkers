<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\SubCategory;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subcategorys', function (Blueprint $table) {
            $table->id();
            $table->string('subcategory_name',255)->nullable(); 
            $table->string('subcategory_url',255)->nullable();             
            $table->unsignedInteger('category_id');   
            $table->timestamps();
        });

       

        $subcategory = new SubCategory;
        $subcategory->subcategory_name = 'Business';
        $subcategory->category_id = 1;
        $subcategory->save();

        $subcategory = new SubCategory;
        $subcategory->subcategory_name = 'Services';
        $subcategory->category_id = 2;
        $subcategory->save();

        $subcategory = new SubCategory;
        $subcategory->subcategory_name = 'Community';
        $subcategory->category_id = 3;
        $subcategory->save();

        // $subcategory = new SubCategory;
        // $subcategory->subcategory_name = 'Posicionamiento Web';
        // $subcategory->category_id = 1;
        // $subcategory->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subcategorys');
    }
};
