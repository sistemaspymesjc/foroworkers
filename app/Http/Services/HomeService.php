<?php

// namespace App\Services;

namespace App\Http\Services;

use GuzzleHttp\Client;

class HomeService
{

    // protected $categorys;

	protected $clients;

  // protected $userService;

	public function __construct(Client $clients){
    // $this->categorys = new Category();

		$this->clients = $clients;
	}

	public function getModuleHome($api_key_factory,$website,$user_id,$software_id)
	{

		$endpoint = env('APP_ENDPOINT_FACTORY').'/api/modules/home?api_key='.$api_key_factory.'&website='.$website.'&user_id='.$user_id.'&software_id='.$software_id;       

		$response = $this->clients->request('GET', $endpoint);     

		return  $ms_contents = json_decode($response->getBody()->getContents());     


	}


}
