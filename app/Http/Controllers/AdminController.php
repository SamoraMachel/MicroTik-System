<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RouterOS\Client;
use RouterOS\Config;
use RouterOS\Query;

class AdminController extends Controller
{	
	// Add user to the router os 
    public function user($mac_address){
    	// Build query
    	$query =
    	    (new Query('/ip/hotspot/ip-binding/add'))
    	        ->equal('mac-address', $mac_address)
    	        ->equal('type', 'bypassed')
    	        ->equal('comment', 'testcomment');

    	// Add user
    	$out = $client->query($query)->read();
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
    	    $removeUser = $client->query($query)->read();
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
    	$user = $client->query($query)->read();

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

}
