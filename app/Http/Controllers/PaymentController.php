<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;

/**
* Payemnt Controller
*/
class PaymentController extends Controller
{

    /**
    *
    */
    public function recapitulatif(Request $request){

      if($request->isMethod('post')){
        \Stripe\Stripe::setApiKey("sk_test_9O3WPGxvw9lQG5a12BEph5h8");
        //create a customer for Stripe
        $customer = \Stripe\Customer::create(array(
          "description" => "Customer Julien",
          "email" => Auth::user()->email,
          "source" => $request->stripeToken // obtenu via l'étape précédente
        ));


        $charge = \Stripe\Charge::create(array(
          "amount" => 2000, // En centimes ! 20 € ici
          "currency" => "eur",
          "customer" => "cus_9HZTIrta534EpN" //dynamiqye
        ));

      }




      $somme = 0;
      foreach(session('likes', []) as $key => $value){
        $somme +=  \App\Article::find($key)->price;
      }

      return view('payment/recapitulatif', [
        "somme" => $somme
      ]);
    }
}
