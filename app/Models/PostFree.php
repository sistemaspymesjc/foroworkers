<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostFree extends MainModel
{

	protected $table = 'posts_free';

	protected $fillable = [		
		'post_name',
		'url_name',
		'post_content',
		'maincategory_id',
		'content_id',		
		'publish',
		'views'		
	];

	public function __construct()
	{      

		$this->getAccess(); 
        // $this->getTutorial();               

	}

	public function getLastPosts($options)
	{
		return PostFree::select('posts_free.post_name','posts_free.url_name','posts_free.id as postid','mc.maincategory_name','mc.subcategory_id','u.id as userid', 'u.username','u.img','mc.id','mc.maincategory_url','posts_free.created_at','posts_free.updated_at','cont.content_name','cont.content_color')    
		->join('maincategorys as mc', 'mc.id', '=', 'posts_free.maincategory_id')
		->join('contents as cont', 'cont.id', '=', 'posts_free.content_id')     
		->join('users_posts_free as up', 'up.post_id', '=', 'posts_free.id')
		->join('users as u', 'u.id', '=', 'up.user_id')
		->where('mc.subcategory_id', $options)
		->where('posts_free.publish', null)   
		->orderBy('posts_free.updated_at', 'desc')    
		->limit(5)
		->get();
	}

	public function getOneLastPosts($options)
	{
		return PostFree::select('posts_free.post_name','posts_free.url_name','mc.maincategory_name','u.id', 'u.username','posts_free.updated_at','posts_free.id as postid','mc.id as maincategory_id','sc.subcategory_url','mc.maincategory_url')       
		->join('maincategorys as mc', 'mc.id', '=', 'posts_free.maincategory_id')
		->join('subcategorys as sc', 'sc.id', '=', 'mc.subcategory_id') 
		->join('users_posts_free as up', 'up.post_id', '=', 'posts_free.id')
		->join('users as u', 'u.id', '=', 'up.user_id')    
		->where('mc.subcategory_id', $options)
		->where('posts_free.publish', null)    
		->orderBy('posts_free.updated_at', 'desc')   
		->first();
	}

	public function getAllPosts($postid,$subcategoryid,$tema,$m_col_p,$mytable)
	{

		// return $mytable[55];

		// // return $mytable[55].'Tables_in_'.$mydb;

		// exit;


		// 55
		return PostFree::select('posts_free.'.$m_col_p[1],'posts_free.'.$m_col_p[2],'posts_free.id as postid','posts_free.'.$m_col_p[3],'u.id as userid', 'u.username','u.img','r.rank_name','u.is_banned','co.country_name','posts_free.'.$m_col_p[8],'mc.maincategory_name','mc.subcategory_id','mc.maincategory_url','posts_free.'.$m_col_p[10],'mc.promo_url','posts_free.'.$m_col_p[5],'co.country_flag','mc.promo_banner','u.url_patreon','mc.id as maincategoryid','posts_free.'.$m_col_p[6],'cont.content_name','cont.content_color','posts_free.'.$m_col_p[4],'sc.subcategory_url','mc.maincategory_url')  
		->join($mytable[55].' as up', 'up.post_id', '=', 'posts_free.'.$m_col_p[0])
		->join($mytable[48].' as u', 'u.id', '=', 'up.user_id')
		->join($mytable[35].' as r', 'u.rank_id', '=', 'r.id')
		->join($mytable[10].' as cont', 'cont.id', '=', 'posts_free.'.$m_col_p[6])   
		->join($mytable[11].' as co', 'u.country_id', '=', 'co.id') 
		->join('maincategorys as mc', 'mc.id', '=', 'posts_free.'.$m_col_p[5])
		->join('subcategorys as sc', 'sc.id', '=', 'mc.subcategory_id')     
		->where('posts_free.'.$m_col_p[0], $postid)
		->where('posts_free.'.$m_col_p[5], $subcategoryid)
		->where('posts_free.'.$m_col_p[2], $tema)
		->where('posts_free.'.$m_col_p[7], null)
		// ->join($mytable[45]->Tables_in_factory.' as sc', 'sc.id', '=', 'mc.subcategory_id')     
		// ->where($mytable[32]->Tables_in_factory.'.'.$m_col_p[0], $postid)
		// ->where($mytable[48]->Tables_in_factory.'.'.$m_col_p[5], $subcategoryid)
		// ->where($mytable[48]->Tables_in_factory.'.'.$m_col_p[2], $tema)
		// ->where($mytable[48]->Tables_in_factory.'.'.$m_col_p[7], null)        
		->firstOrFail();
	}


}
