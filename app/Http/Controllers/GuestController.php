<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RouterOS;
use Carbon\Carbon;
use App\Models\Profile;
use App\Helpers\Mpesa;
use App\Models\Mpesaresponse;

class GuestController extends Controller
{ 
	protected $client;
	 public function __construct(){
		$this->connection();
	 }

   public function welcome(){
    $packages = Profile::all();
    return view('welcome', compact('packages'));
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
      $amount=$package->price;
      $msisdn=$data['phone_number'];     
      $TransactionDesc='Payment for '.$package->name.' package';
      $newTrial = new Mpesa;
      $response = $newTrial->sendSTKPush($amount, $msisdn, $TransactionDesc);
      return $response;

   }   
   public function responseFromMpesa(Request $request){
      $body= $request->getContent();
      $data = json_decode($body);
      $newreponse = new Mpesaresponse;
      $newreponse->body = $data->body;
      $newreponse->save();
      return;
   }

   public function trial(){
    $res = Mpesaresponse::find(2);
    $data = json_decode($res->body, true);
    dd($data->stkCallback);
}
}

