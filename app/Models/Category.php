<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{	

	protected $table = 'categorys';


	protected $fillable = [		
		'category_name'		
	];

	public function getCategorys($options,$m_col_mc,$m_col_c,$m_col_sc)
	{

		// return $m_col_mc[7];		

		return Category::select('categorys.'.$m_col_c[1],'sc.'.$m_col_sc[1],'mc.'.$m_col_mc[1],'mc.'.$m_col_mc[2],'mc.'.$m_col_mc[3])
		->join('subcategorys as sc', 'sc.'.$m_col_sc[3], '=', 'categorys.'.$m_col_c[0])
		->join('maincategorys as mc', 'mc.'.$m_col_mc[7], '=', 'sc.'.$m_col_sc[0])
		->where('mc.'.$m_col_mc[7], $options)
		->get();
		
	}

	
}
