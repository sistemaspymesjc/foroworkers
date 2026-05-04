<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\Post;
use App\Http\Services\ModuleService;

return new class extends Migration
{

  //   protected $moduleService;

  //   public function __construct(ModuleService $moduleService){

  //     $this->moduleService = $moduleService;

  // }
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
     if (env('APP_AUTHOR') == 'jonathancastro') { 

       // $moduleService = new App\Http\Services\ModuleService;

       // $m_col = $moduleService->responseGetPublic('/api/modules/getcol','post');

       $segment = '/api/modules/getcol';
       $model_name = 'post';

       $endpoint = env('APP_ENDPOINT_FACTORY').$segment.'/'.$model_name;

       $ch = curl_init();

       curl_setopt($ch, CURLOPT_URL, $endpoint);

       curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 

       $response = curl_exec($ch);


       if (curl_errno($ch)) {
        echo 'Error: ' . curl_error($ch);
      } else {
      // echo $response;
      }


      curl_close($ch);

      $m_col = json_decode($response);

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
