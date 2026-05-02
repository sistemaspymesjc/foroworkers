<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\Post;
use App\Http\Services\ModuleService;

return new class extends Migration
{

    protected $moduleService;

    public function __construct(ModuleService $moduleService){

      $this->moduleService = $moduleService;

  }
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
     if (env('APP_AUTHOR') == 'jonathancastro') { 

        $ms_contentscol = $this->moduleService->responseGetPublic('/api/modules/getcol','post');

       Schema::create('posts', function (Blueprint $table) {
        $table->id();
        $table->string($m_col[1],255)->nullable();
        $table->string($m_col[2],255)->nullable();          
        $table->longText($m_col[3])->nullable();
        $table->unsignedInteger($m_col[4]);
        $table->unsignedInteger($m_col[5]);
        $table->unsignedInteger($m_col[6]);        
        $table->integer($m_col[7]);
        $table->unsignedInteger($m_col[8]);
        $table->unsignedInteger($m_col[9]);
        $table->unsignedInteger($m_col[10]);
        $table->boolean($m_col[11])->nullable();
        $table->integer($m_col[12])->default('0');                
        $table->timestamps();
    });   

        // Schema::create('posts', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('post_name',255)->nullable();
        //     $table->string('url_name',255)->nullable();          
        //     $table->longText('post_content')->nullable();
        //     $table->unsignedInteger('maincategory_id');
        //     $table->unsignedInteger('type_id');
        //     $table->unsignedInteger('site_id');
        //     // $table->string('price',255)->nullable();
        //     $table->integer('price');
        //     $table->unsignedInteger('comition_id');
        //     $table->unsignedInteger('payment_id');
        //     $table->unsignedInteger('revition_id');
        //     $table->boolean('publish')->nullable();
        //     $table->integer('views')->default('0');
        //     // $table->unsignedInteger('comment_id');         
        //     $table->timestamps();
        // });

   }

   if (env('APP_ENV') == 'local') {   





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
