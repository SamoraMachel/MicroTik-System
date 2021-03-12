<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \RouterOS;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $logged_in_to_router =false;
        //if you logged in to router 
        if ($logged_in_to_router) {
            return view('home');
        }else{
            return redirect(route('router_login'));
        }
        //else redirect to router login page
    }

    public function routerLogin(){
        return view('microtik.login');
    }

    public function init(Request $request){
        //verify data
        $data = $this->validate($request, [
            'ip'=>'required|ip',
            'username'=>'required|alpha_dash',
            'password'=>'required|min:6',
            'port'=>'required|numeric',
        ]);

        //try to login to router
        $config = new \RouterOS\Config([
            'host' => $data['ip'],
            'user' => $data['username'],
            'pass' => $data['password'],
            'port' => $data['port'],
        ]);
        $client = new \RouterOS\Client($config);

        dd($config);

    }
}
