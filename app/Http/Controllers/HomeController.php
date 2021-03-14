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
    public function index(Request $request)
    {   
        // $data  = session('router_session');
        // dd($data->config);
        if($request->session()->exists('router_session')){
            $logged_in_to_router =true;
        }else{
            $logged_in_to_router =true;
        }
        //if you logged in to router 
        if ($logged_in_to_router) {
            return view('home');
        }else{
            return redirect(route('router_login'));
            //return view('home');
        }
        //else redirect to router login page
    }

    public function routerLogin(Request $request){
        if($request->session()->exists('router_session')){
            return redirect(route('home'));
        }
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
            'port' => intval($data['port']),
        ]);

        try {
          $client = new RouterOS\Client($config);            
         } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Hello '.auth()->user()->name.', For Some reason, We Could not login you  to the router');
        }        
        session(['router_session' => $data]);
        return redirect(route('home'));

    }
}
