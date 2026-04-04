<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\Comment;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
    	Schema::create('comments', function (Blueprint $table) {
    		$table->id();        
    		$table->longText('comment')->nullable();
    		$table->unsignedInteger('user_id');
    		$table->unsignedInteger('post_id'); 
           $table->boolean('publish')->nullable();              
           $table->timestamps();
       });

    	

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    	Schema::dropIfExists('comments');
    }
};
