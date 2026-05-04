<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\MainCategory;
use App\Http\Services\ModuleService;

return new class extends Migration
{

//  protected $moduleService;

//  public function __construct(ModuleService $moduleService){

//   $this->moduleService = $moduleService;

// }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        // $moduleService = new App\Http\Services\ModuleService;

        // $m_col = $moduleService->responseGetPublic('/api/modules/getcol','maincategory');

     $segment = '/api/modules/getcol';
     $model_name = 'maincategory';

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


  Schema::create('maincategorys', function (Blueprint $table) {
    $table->id();
    $table->string($m_col[1],255)->nullable();
    $table->string($m_col[2],255)->nullable();
    $table->string($m_col[3],255)->nullable();
    $table->string($m_col[4],255)->nullable();
    $table->string($m_col[5],255)->nullable();
    $table->string($m_col[6],255)->nullable();                  
    $table->unsignedInteger($m_col[7]);   
    $table->timestamps();
});

           // curl_close($ch);


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
