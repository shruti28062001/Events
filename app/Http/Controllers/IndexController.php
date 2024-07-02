<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Events;

use Mail;
use Log;
use GuzzleHttp\Client;

class IndexController extends Controller
{
    public function index(){
      
        $meta_title = config('app.name');
        return view('index',compact('meta_title'));
    }
    
    public function events(Request $request)
    {
        $events = Events::get();
        return response()->json($events);
    }

   
    

   

    

    
}