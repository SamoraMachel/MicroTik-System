<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RouterOS;
use Carbon\Carbon;
use App\Models\Profile;
use App\Helpers\Mpesa;
use App\Models\Mpesaresponse;
use App\Models\MpesaTransaction;

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
      $newreponse = Mpesaresponse::create([
        'body'=>$body
      ]);
      $this->create_subscription($newreponse->id);
      return;
   }

   public function create_subscription($id){
    $res = Mpesaresponse::find($id);
    $data = json_decode($res->body, true);
    $body = $data['Body'];
    $stkCallback=$body['stkCallback'];
    $ResultCode =$stkCallback['ResultCode']; 
    if ($ResultCode == 0) {
      $CallbackMetadata = $stkCallback['CallbackMetadata'];
      $Items = $CallbackMetadata['Item'];
      $amount = $Items[0]['Value'];
      $MpesaReceiptNumber = $Items[1]['Value'];      
      $TransactionDate = strval($Items[2]['Value']);
      $PhoneNumber = strval($Items[3]['Value']);

      $create_transaction = new MpesaTransaction;
      $create_transaction->amount= $amount;
      $create_transaction->MpesaReceiptNumber=$MpesaReceiptNumber;
      $create_transaction->TransactionDate=$TransactionDate;
      $create_transaction->PhoneNumber=$PhoneNumber;

      //get a profile from router with price 100
      $profile = Profile::where('price', $amount)->first();
      if ($profile) {
        //create a user
        $this->create_user($PhoneNumber, $MpesaReceiptNumber, $profile->name);
        $create_transaction->status = "Conected To Network SuccessFully";
      }
      else{
        $create_transaction->status = "Not Conected To Network, Error! Missing Profile ";
      }

      $create_transaction->save();
      return;

    } 
    else{
      return;
    }
  }

  public function create_user($name, $password, $profile){
    $query = (new RouterOs\Query('/ip/hotspot/user/add'))
      ->equal('name', $name)
      ->equal('password',$password)
      ->equal('profile', $profile);
    $response = $this->client->query($query)->read();
   return;

  }

}

