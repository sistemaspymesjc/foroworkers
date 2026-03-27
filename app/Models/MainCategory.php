<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainCategory extends MainModel
{
	

	protected $table = 'maincategorys';


	protected $fillable = [		
		'maincategory_name',
		'maincategory_url',
		'maincategory_id',
		'promo_url',
		'promo_banner'
		// 'created_at',
		// 'updated_at'
		// 'client_name',
		// 'client_phone',
		// 'client_email',
		// 'client_address',
		// 'project_name'
	];

	public function __construct()
    {      
        
        $this->getAccess(); 
        $this->getTutorial();               

    }

	
}
