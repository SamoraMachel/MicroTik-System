<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RouterOS\Client;
use RouterOS\Config;
use RouterOS\Query;
use Carbon\Carbon;

class GuestController extends Controller
{ 
	protected $client;
	// public function __construct(){
	// 	$this->connection();
	// }

   public function packages(){
   	//get packages from the db
   	
   }

   public function connection(){
      //dd(env('REMOTE_ROUTER_HOST'));
      $config = (new Config())
      ->set('host', env('REMOTE_ROUTER_HOST'))
      ->set('user', env('REMOTE_ROUTER_USER'))
      ->set('pass', env('REMOTE_ROUTER_PASS'))
      ->set('port', intval(env('REMOTE_ROUTER_PORT')));
   	try {
   	  $this->client = new Client($config);            
   	 } catch (\Exception $e) {   	   
         $this->client = "null"; 
         print "Error connecting to RouterOS";
         die;   
   	}
   }

   public function userProfiles(){
      $query = new Query('/ip/hotspot/user/profile/print');

      // Add user
      return $this->client->query($query)->read();
   }

   public function access_token()
   {
      $consumer_key= env('CONSUMER_KEY'); //messed up for security when it lands on github
        $consumer_secret=env('CONSUMER_SECRET'); //messed up for security when it lands on github
        $credentials = base64_encode($consumer_key.":".$consumer_secret);
        $url = "https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials";
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Authorization: Basic ".$credentials));
        curl_setopt($curl, CURLOPT_HEADER,false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $curl_response = curl_exec($curl);
        $access_token=json_decode($curl_response);
        return $access_token->access_token;
   }

   

   public function lipaNaMpesaPassword()
   {
      $lipa_time = Carbon::rawParse('now')->format('YmdHms');
      $passkey = "bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919";
      $BusinessShortCode = env('BUSINESS_NUMBER');      

      $lipa_na_mpesa_password = base64_encode($BusinessShortCode.$passkey.$lipa_time);
      return $lipa_na_mpesa_password;
   }
}






// $config = Config([
//     'host' => env('REMOTE_HOST'),
//     'user' => env('REMOTE_USER'),
//     'pass' => env('REMOTE_PASS'),
//     'port' => env('REMOTE_PORT'),
//  ]);
// $client = new Client($config);
// $this->client =  $client;