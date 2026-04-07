<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Forum extends MainModel
{
	
	protected $table = 'forums';


	protected $fillable = [		
		'forum_name',
		'forum_tittle',
		'forum_description',
		'forum_content',
		'user_id',
		'is_digitalp',
		'is_services',
		'is_community',
		'software_id'		
	];	

	
}
