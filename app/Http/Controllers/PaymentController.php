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

      $somme = 0;
      foreach(session('likes', []) as $key => $value){
        $somme +=  \App\Article::find($key)->price;
      }


      // Si on a soumit le formulaire
      if($request->isMethod('post')){

        // Clefs privée pour que mon serveur se connecte à mon compte Stripe
        \Stripe\Stripe::setApiKey("sk_test_9O3WPGxvw9lQG5a12BEph5h8");

        // Create a customer pour Stripe
        $customer = \Stripe\Customer::create(array(
          "description" =>  Auth::user()->prenom ." " .Auth::user()->nom,
          "email" => Auth::user()->email,
          "source" => $request->stripeToken // Champc caché obtenu via le formulaire
        ));

        // créer une charge
        \Stripe\Charge::create([
          "amount" => ($somme + $somme  * 0.20) * 100, // En centimes ! 20 € ici
          "currency" => "eur",
          "customer" => $customer->id
        ]);


      return redirect()->route('recapitulatif') // redirige vers la page media
        ->with('success', "Vous avez bien été débité de ".$somme + $somme  * 0.20);
      }


      return view('payment/recapitulatif', [
        "somme" => $somme
      ]);
    }
}
