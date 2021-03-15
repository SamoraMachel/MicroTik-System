<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RouterOS;
use Carbon\Carbon;
use App\Models\Profile;
use Mpesa;

class GuestController extends Controller
{ 
	protected $client;
	 public function __construct(){
		$this->connection();
	 }

   public function welcome(){
    $packages = Profile::all();
    return view('welcome', compact($packages));
   }

   public function connection(){
      $config = new \RouterOS\Config([
          'host' => env('REMOTE_ROUTER_HOST'),
          'user' => env('REMOTE_ROUTER_USER'),
          'pass' => env('REMOTE_ROUTER_PASS'),
          'port' => intval(env('REMOTE_ROUTER_PORT')),
      ]);

      try {
        $this->client = new RouterOS\Client($config);            
       } catch (\Exception $e) {
          return;
      }      
   }

   public function purchase(Request $request){
      $data = $this->validate($request, [
        'phone_number'=>['required','numeric','digits:12','starts_with:254'],
        'id'=>['exists:profiles','required'],
      ]);
      $package = Profile::find($data['id']);
      $amount=$data['amount'];
      $msisdn=$data['phone_number'];     
      $TransactionDesc='Payment for '.$package->name.' package';
      $response = $this->mpesa($amount, $msisdn, $TransactionDesc);
      return $response;

   }

   public function mpesa(int $amount, int $msisdn, $TransactionDesc){
    $response = Mpesa::express(intval($amount), intval($msisdn), $TransactionDesc);    
    if ($response) {
      return "Success";
    }else{
      return "Error";
    }
   }
}

