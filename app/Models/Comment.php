<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends MainModel
{	

	protected $table = 'comments';
	

	protected $fillable = [		
		'comment',
		'user_id',
		'post_id',
		'publish'				
	];

	// los modelos siguien un orden para insertar en tablas
	public function __construct()
    {      
        
        // $this->getAccess(); 
        // $this->getTutorial();               

    }	
}
