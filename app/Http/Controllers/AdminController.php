<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RouterOS;
use App\Models\Profile;
use \Cookie;


class AdminController extends Controller
{	
    public $client;
    public function connection(){        
        $data = session()->get('router_session');
        $config = new \RouterOS\Config([
            'host' => $data['ip'],
            'user' => $data['username'],
            'pass' => $data['password'],
            'port' => intval($data['port']),
        ]);
        try {
          $this->client = new RouterOS\Client($config);
         } catch (\Exception $e) {
            dd($e);
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
    	$user = $this->client->query($query)->read();

    	return $user;
    }






    // Profile functions
    public function hotspot(){
    	$client = new Client($config);
    	// Build query for details about user profile
    	$query = new Query('/ip/hotspot/user/profile/print');
    	// Add user
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


    public function newProfile(Request $request){
     $data = $this->validate($request,[
       'name'=>'required|string|unique:profiles',
       'shared-users'=>'required|numeric',
       'rate-limit' =>'nullable',
       'price'=>'required|numeric',
       'status-autorefresh'=>'nullable',
       'transparent-proxy'=>'nullable',
     ]);
     //save the profile to router
     $query =
         (new RouterOs\Query('/ip/hotspot/user/profile/add'))
             ->equal('name', $data['name'])
             ->equal('shared-users',$data['shared-users']);
              // Add user
       $this->connection();
       $response =  $this->client->query($query)->read();

       //extend the profile to database
       $newResponse = Profile::create($data);

       return redirect(route('home'))->with('success','Package added successfully');
    }

    public function userProfiles(){
      $query = new RouterOS\Query('/ip/hotspot/user/profile/print');
      $this->connection();      
      $userProfiles = $this->client->query($query)->read();
     return $userProfiles;
   }

   public function ips_connected_to_router(){
    $query = new RouterOs\Query('/ip/arp/print');
    $this->connection();
    $response = $this->client->query($query)->read();
    dd($response);
   }

   public function listProfiles(){
    $profiles = Profile::all();
    return view('admin.profiles.show-profiles', compact('profiles'));
   }

}
