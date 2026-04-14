<?php

// namespace App\Services;

namespace App\Http\Services;

use GuzzleHttp\Client;

// las interfaces no se pueden usar adentro de http
// use App\Http\ModuleInterface as ModuleInterface;

use App\Interfaces\ModuleInterface as ModuleInterface;

class ModuleService implements ModuleInterface
{


	protected $clients;


	public function __construct(Client $clients){ 

		$this->clients = $clients;
	}

	public function responseGet($segment,$api_key_factory,$website,$user_id,$software_id)
	{        

		$endpoint = env('APP_ENDPOINT_FACTORY').$segment.'?api_key='.$api_key_factory.'&website='.$website.'&user_id='.$user_id.'&software_id='.$software_id;        

		$response = $this->clients->request('GET', $endpoint);      

		return  $ms_contents = json_decode($response->getBody()->getContents());
	}

	public function responsePost($segment,$api_key_factory,$website,$user_id,$software_id)
	{      

		// $endpoint = env('APP_ENDPOINT_FACTORY').'/api/modules/seo?api_key='.$api_key_factory.'&website='.$website.'&user_id='.$user_id.'&software_id='.$software_id;        

		// $response = $this->clients->request('GET', $endpoint);      

		// return  $ms_contents = json_decode($response->getBody()->getContents());
	}


}
