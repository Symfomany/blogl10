<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Tchat;

class TchatController extends Controller
{


    /**
    * Add Tchat  message in database
    */
    public function add(Request $request){

        $tchat = new Tchat();
        $tchat->content = $request->content;
        $tchat->save(); // created_at at now()
    }


}
