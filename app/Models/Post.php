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

	public function getAllPosts($postid,$subcategoryid,$tema,$m_col_p)
	{
		return Post::select('posts.'.$m_col_p[1],'posts.url_name','posts.id as postid','posts.post_content','posts.price','u.id as userid', 'u.username','u.img','r.rank_name','c.comition_name','p.payment_name','re.revition','t.type_name','t.type_color','u.is_banned','co.country_name','posts.views','mc.maincategory_name','mc.subcategory_id','mc.maincategory_url','posts.created_at','co.country_flag','posts.type_id')      
       ->join('users_posts as up', 'up.post_id', '=', 'posts.id')
       ->join('users as u', 'u.id', '=', 'up.user_id')
       ->join('ranks as r', 'u.rank_id', '=', 'r.id')
       ->join('comitions as c', 'c.id', '=', 'posts.comition_id')
       ->join('payments as p', 'p.id', '=', 'posts.payment_id')
       ->join('revitions as re', 're.id', '=', 'posts.revition_id')
       ->join('types as t', 't.id', '=', 'posts.type_id')
       ->join('countrys as co', 'u.country_id', '=', 'co.id') 
       ->join('maincategorys as mc', 'mc.id', '=', 'posts.maincategory_id')    
       ->where('posts.id', $postid)
       ->where('posts.maincategory_id', $subcategoryid)
       ->where('posts.url_name', $tema)
       ->where('posts.publish', null)      
       ->firstOrFail(); 
	}

	
	
}
