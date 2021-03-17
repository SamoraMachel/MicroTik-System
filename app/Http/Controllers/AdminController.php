<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RouterOS;
use App\Models\Profile;
use \Cookie;
use App\Models\MicroTik;

class AdminController extends Controller
{	
    public $client;
    public $current_microtik_id;
    public $session_data;
    public function connection(){        
        $data = session()->get('router_session');
        $this->session_data = $data;
        $config = new \RouterOS\Config([
            'host' => $data['ip'],
            'user' => $data['username'],
            'pass' => $data['password'],
            'port' => intval($data['port']),
        ]);
        try {
          $this->client = new RouterOS\Client($config);
          $this->discover_microtik();      

         } catch (\Exception $e) {
            dd($e);
        }      
     }

     public function discover_microtik(){
      $data = session()->get('router_session');
      $router = MicroTik::where('ip', $data['ip'])->first();
      if ($router) {
        return $this->current_microtik_id = $router->id;        
      }      
     }

	// Add user to the router os 
    public function user($mac_address){
    	// Build query
    	$query =
    	    (new Query('/ip/hotspot/ip-binding/add'))
    	        ->equal('mac-address', $mac_address)
    	        ->equal('type', 'bypassed')
    	        ->equal('comment', 'testcomment');

    	// Add user
      $this->connection();
    	$out = $this->client->query($query)->read();
    	return $out;
    }



    public function remove_user($mac_address){  	
    	$user = $this->get_user($mac);
    	if (!empty($user[0]['.id'])) {
    	    $userId     = $user[0]['.id'];

    	    // Remove MACa address
    	    $query =
    	        (new Query('/ip/hotspot/ip-binding/remove'))
    	            ->equal('.id', $userId);

    	    // Remove user from RouterOS
          $this->connection();
    	    $removeUser = $this->client->query($query)->read();
    	    return $remove_user;
    	}else{
    		return "User not Found";
    	}
    }




    /*
    Get a user using their mac adrress from router OS
    */
    public function get_user($mac_address){
    	$query =
    	    (new Query('/ip/hotspot/ip-binding/print'))
    	        ->where('mac-address', $mac_address);

    	// Get user from RouterOS by query
      $this->connection();
    	$user = $this->client->query($query)->read();

    	return $user;
    }






    // Profile functions
    public function hotspot(){
    	$client = new Client($config);
    	// Build query for details about user profile
    	$query = new Query('/ip/hotspot/user/profile/print');
    	// Add user
      $this->connection();
    	$out = $client->query($query)->read();
    	return $out;
    }


    /*
        show form for creating profile
    */
    public function showForm(){
        $profiles = $this->userProfiles();        
        return view('admin.profiles.create-profile');
    }

// Create and save a profile to router and database
 public function newProfile(Request $request){
     $data = $this->validate($request,[
       'name'=>'required|string|unique:profiles',
       'shared-users'=>'required|numeric',
       'rate-limit' =>'nullable',
       'price'=>'required|numeric',
       'description'=>'nullable',
     ]);

    $descrip = explode(";", $data['description']);
    $descripJSON = json_encode($descrip);
     //save the profile to router
     $query =
         (new RouterOs\Query('/ip/hotspot/user/profile/add'))
             ->equal('name', $data['name'])
             ->equal('shared-users',$data['shared-users'])
             ->equal('rate-limit', $data['rate-limit']);
              // Add user
       $this->connection();
       $response =  $this->client->query($query)->read();
       $microtik = 

    //    dd($descripJSON);
       //extend the profile to database
       $newResponse = Profile::create([
           'name'=>$data['name'],
           'shared-users'=>$data['shared-users'],
           'rate-limit'=>$data['rate-limit'],
           'price'=>$data['price'],
           'micro_tik_id'=>$microtic,
           'description'=>$descripJSON
       ]);

       return redirect(route('home'))->with('success','Package added successfully');
    }

  // Get Connected Devices in the router
   public function ips_connected_to_router(){
    $query = new RouterOs\Query('/ip/arp/print');
    $this->connection();
    $response = $this->client->query($query)->read();
    dd($response);
   }

   // Get Hotspot Profiles In the router
   public function listProfiles(){
    $query = new RouterOS\Query('/ip/hotspot/user/profile/print');
    $this->connection();      
    $profiles = $this->client->query($query)->read();
    dd($profiles);
    return view('admin.profiles.show-profiles', compact('profiles'));
   }   

   // Get users existing in hotspot
   public function hotspot_users(){
     $query = new RouterOS\Query('/ip/hotspot/user/print'); 
     $this->connection();        
     $userProfiles = $this->client->query($query)->read(); 
     return $userProfiles;
   }

   public function logs(){
    $query = new RouterOS\Query('/log/print'); 
    $this->connection();        
    $logs = $this->client->query($query)->read(); 
    return $logs;
   }

   public function active_hotspot_users(){
    $query = new RouterOS\Query('/ip/hotspot/active/print'); 
    $this->connection();        
    $active_hotspot_users = $this->client->query($query)->read(); 
    return $active_hotspot_users;
   }

   public function interfaces(){
    $query = new RouterOS\Query('/interface/getall'); 
    $this->connection();        
    $interfaces = $this->client->query($query)->read(); 
    return $interfaces;
   }



}
