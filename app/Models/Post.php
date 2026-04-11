<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends MainModel
{

	protected $table = 'posts';


	protected $fillable = [		
		'post_name',
		'url_name',
		'post_content',
		'maincategory_id',
		'type_id',
		'site_id',
		'payment_id',
		'comition_id',	
		'revition_id',
		'publish',
		'views'		
	];

	public function __construct()
	{      

		$this->getAccess(); 
        // $this->getTutorial();               

	}
	

	// public function getLastPosts($options)
	// {
	// 	return Post::select('posts.post_name','posts.url_name','posts.id as postid','mc.maincategory_name','mc.subcategory_id','u.id as userid', 'u.username','u.img','mc.id','mc.maincategory_url','t.type_name','posts.created_at','posts.updated_at','t.type_color')    
	// 	->join('maincategorys as mc', 'mc.id', '=', 'posts.maincategory_id')
	// 	->join('types as t', 't.id', '=', 'posts.type_id')    
	// 	->join('users_posts as up', 'up.post_id', '=', 'posts.id')
	// 	->join('users as u', 'u.id', '=', 'up.user_id')
	// 	->where('mc.subcategory_id', $options)
	// 	->where('posts.publish', null)     
	// 	->orderBy('posts.updated_at', 'desc')    
	// 	->limit(5)
	// 	->get();
	// }

	public function getOneLastPosts($options)
	{
		return Post::select('posts.post_name','posts.url_name','mc.maincategory_name','u.id', 'u.username','posts.updated_at','posts.id as postid','mc.id as maincategory_id')    
		->join('maincategorys as mc', 'mc.id', '=', 'posts.maincategory_id')   
		->join('users_posts as up', 'up.post_id', '=', 'posts.id')
		->join('users as u', 'u.id', '=', 'up.user_id')    
		->where('mc.subcategory_id', $options)
		->where('posts.publish', null)   
		->orderBy('posts.updated_at', 'desc')   
		->first(); 
	}

	
	
}
