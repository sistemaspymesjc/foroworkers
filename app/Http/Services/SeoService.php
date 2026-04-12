<?php

// namespace App\Services;

namespace App\Http\Services;

use GuzzleHttp\Client;

class SeoService
{

    // protected $categorys;

    protected $clients;

  // protected $userService;

    public function __construct(Client $clients){
    // $this->categorys = new Category();

        $this->clients = $clients;
    }

    public function getModuleSeo($api_key_factory,$website,$user_id,$software_id)
    {
       // $endpoint = env('APP_ENDPOINT_FACTORY').'/api/modules/seo?api_key='.$user->api_key_factory.'&website='.$website.'&user_id='.$forum->user_id; 

        $endpoint = env('APP_ENDPOINT_FACTORY').'/api/modules/seo?api_key='.$api_key_factory.'&website='.$website.'&user_id='.$user_id.'&software_id='.$software_id;      

     // $client = new \GuzzleHttp\Client(); 

       // $response = $client->request('GET', $endpoint);

       $response = $this->clients->request('GET', $endpoint);

       // $ms_contents = json_decode($response->getBody()->getContents());

       return  $ms_contents = json_decode($response->getBody()->getContents());

       // $m_seo = $ms_contents;

       // print_r($contents);

       // exit;


   }


}
