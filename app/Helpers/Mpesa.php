<?php

namespace App\Helpers;

use Carbon\Carbon;
use App\Models\MpesaTransaction;

/**
 * 
 */
class Mpesa
{
	public $short_code;
	public $consumer_secret;
	public $consumer_key;
	public $env;
	public $access_token;
	public $passkey;	
	public $url;

	public function __construct(){
		 $this->short_code = env('TILL_NUMBER',null);
		 $this->consumer_secret = env('CONSUMER_SECRET',null);
		 $this->consumer_key = env('CONSUMER_KEY',null);
		 $this->env = env('MPESA_ENV',null);
		 $this->url = 'https://e24de1f87f7b.ngrok.io/mpesa_response';
		 $this->access_token = $this->getAccessToken();		 
		 $this->passkey = env('PASS_KEY');
	}

	public function getAccessToken(){		
		$consumer_key=$this->consumer_key;
		$consumer_secret=$this->consumer_secret;
		$credentials = base64_encode($consumer_key.":".$consumer_secret);
		$env = $this->env;
		if ($env == 'sandbox') {
			$url = "https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials";
		}else{
			$url = "https://api.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials";
		}
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array("Authorization: Basic ".$credentials));
		curl_setopt($curl, CURLOPT_HEADER,false);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		$curl_response = curl_exec($curl);
		$access_token=json_decode($curl_response);
		if ($access_token) {			
			return $this->access_token = $access_token->access_token;
		}else{
			return false;
		}
		
	}

	public function getLipaNaMpesapassword(){
		$lipa_time = Carbon::rawParse('now')->format('YmdHms');
		$passkey = $this->passkey;
		$BusinessShortCode = $this->short_code;
		$timestamp =$lipa_time;
		$lipa_na_mpesa_password = base64_encode($BusinessShortCode.$passkey.$timestamp);
		//dd($lipa_na_mpesa_password);
		return $lipa_na_mpesa_password;
	}

	public function sendSTKPush($amount, $phone_number, $TransactionDesc){
		if ($this->env == 'sandbox') {
			$url = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
		}else{
			$url = 'https://api.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
		}
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.$this->access_token));
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		$curl_post_data = [
		         //Fill in the request parameters with valid values
		    'BusinessShortCode' => $this->short_code,
		    'Password' => $this->getLipaNaMpesapassword(),
		    'Timestamp' => Carbon::rawParse('now')->format('YmdHms'),
		    'TransactionType' => 'CustomerBuyGoodsOnline',
		    'Amount' => intval($amount),
		    'PartyA' => intval($phone_number), // replace this with your phone number
		    'PartyB' => $this->short_code,
		    'PhoneNumber' => $phone_number, // replace this with your phone number
		    'CallBackURL' => $this->url,
		    'AccountReference' => "Package Purchase",
		    'TransactionDesc' => $TransactionDesc,
		     ];
		     $data_string = json_encode($curl_post_data);
		     curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		     curl_setopt($curl, CURLOPT_POST, true);
		     curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
		     $curl_response = curl_exec($curl);
		     return $curl_response;
	}
	
	       /**
	        * M-pesa Transaction confirmation method, we save the transaction in our databases
	        */
	public function mpesaConfirmation(Request $request){
		dd("Called");
	    $content=json_decode($request->getContent());
	    $mpesa_transaction = new MpesaTransaction();
	    $mpesa_transaction->TransactionType = $content->TransactionType;
	    $mpesa_transaction->TransID = $content->TransID;
	    $mpesa_transaction->TransTime = $content->TransTime;
	    $mpesa_transaction->TransAmount = $content->TransAmount;
	    $mpesa_transaction->BusinessShortCode = $content->BusinessShortCode;
	    $mpesa_transaction->BillRefNumber = $content->BillRefNumber;
	    $mpesa_transaction->InvoiceNumber = $content->InvoiceNumber;
	    $mpesa_transaction->OrgAccountBalance = $content->OrgAccountBalance;
	    $mpesa_transaction->ThirdPartyTransID = $content->ThirdPartyTransID;
	    $mpesa_transaction->MSISDN = $content->MSISDN;
	    $mpesa_transaction->FirstName = $content->FirstName;
	    $mpesa_transaction->MiddleName = $content->MiddleName;
	    $mpesa_transaction->LastName = $content->LastName;
	    $mpesa_transaction->save();
	           // Responding to the confirmation request
	    $response = new Response();
	    $response->headers->set("Content-Type","text/xml; charset=utf-8");
	    $response->setContent(json_encode(["C2BPaymentConfirmationResult"=>"Success"]));
	           return $response;
	}
}