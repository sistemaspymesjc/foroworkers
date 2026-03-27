<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Setting;
use App\Models\Forum;

class MainModel extends Model
{

	// protected $userAccess = '1';   	

	public function __construct()
	{
		// parent::__construct();   

		// $this->$userAccess = $this->getAccess();
	}

	public function getAccess()
	{		

		 $data = Setting::select('phrase')   
		->where('app_email', env("APP_EMAIL")) 
		->firstOrFail();

		return $this->verifyPhrase($data->phrase);

	}

	public function getTutorial()
	{		

		 $forum = Forum::select('forums.forum_name','forums.forum_tittle','forums.forum_description')
      ->where('id', 1)
      ->first();
  

       if (empty($forum) || env('APP_ENV') == 'local') {

        return redirect('/course/foroworkers/post-questions-and-answers');

      }

	}

	public function verifyPhrase($phrase)
	{
		$success = password_verify(env("APP_AUTHOR"). env("APP_COPYRIGHT"), $phrase);

		if ($success) {

		} else {

			exit;
		}		
		

	}

	
}
