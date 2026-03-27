<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calification extends MainModel
{
	use HasFactory;

	protected $table = 'califications';

	// public $timestamps = false;

	protected $fillable = [		
		'calification_name',
		'calification_color',
		'calification_icon'
		// 'url_name'
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
