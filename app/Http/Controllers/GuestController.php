<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RouterOS\Client;
use RouterOS\Config;
use RouterOS\Query;

class GuestController extends Controller
{ 
	public $client;
	public function __construct(){
		$config = Config([
		    'host' => env('REMOTE_HOST'),
		    'user' => env('REMOTE_USER'),
		    'pass' => env('REMOTE_PASS'),
		    'port' => env('REMOTE_PORT'),
		 ]);
		$client = new Client($config);
		$this->client =  $client;
	}
   public function packages(){
   	//get packages from the db
   	
   }
}
