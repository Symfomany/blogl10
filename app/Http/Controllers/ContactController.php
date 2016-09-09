<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Validator;
use App\Contact;

/**
* Un controlleur contrôle les données d'une ou plusieurs pages
*/
class ContactController extends Controller
{

  /**
  * 1 Methode de controlleur = 1 Page
  * Page Contact
  * Request $request: un objet représentant ma Requete
  * $request contient toutes les données en POST
  * de maniere sécurisée
  */
  public function contact(Request $request)
  {
    // récupérer mes données en POST de ma Requete
    // controller les données de mon formulaire...
    $validator = Validator::make($request->all(), [
         'nom' => 'required|regex:/[a-z\-\ ]{3,}/i',
         'email' => 'required|email',
         'message' => 'required|min:5|max:400',
         'site' => 'active_url',
         'sujet' => 'required|in:contact,article,demande,autre',
         'gender' => 'required|in:masculin,feminin',
         'cgu' => 'required'
     ]);
     // si mon formulaire a été envoyé|soumit
     // et qu'il a échoué au niveau des validations
     if ($validator->fails() && $request->isMethod('post')){

       return redirect()->route('contact') //redirige vers nom de la route "contact"
              ->withErrors($validator) //avec erreurs
              ->withInput(); // avec champs remplis

     } else if ($request->isMethod('post')){
       // formulaire est soumis et valide
       // enregistrer en bdd le contact

       // créer un nouveau concat en bdd
       $contact = new Contact();
       $contact->genre = $request->gender;
       $contact->nom = $request->nom;
       $contact->sujet = $request->sujet;
       $contact->email = $request->email;
       $contact->site  = $request->site;
       $contact->message = $request->message;
       $contact->save();

       // redirection avec message de success
       return redirect()->route('contact') //redirige vers nom de la route "contact"
          ->with('success',
          'Votre formulaire de contact a bien été envoyé');
     }




    // GET : affichage du formulaire
    return view('contact');
  }






}
