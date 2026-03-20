<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends MainModel
{
	use HasFactory;

	protected $table = 'posts';

	// public $timestamps = false;

	protected $fillable = [		
		'post_name',
		'url_name',
		'post_content',
		'maincategory_id',
		'type_id',
		'site_id',
		'payment_id',
		'comition_id',
		// 'condition_id',
		'revition_id',
		'publish',
		'views'
		// 'comment_id'
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

    }

	
}
