<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Validator;
use App\Media;
use Carbon\Carbon;

class MediaController extends Controller
{


  public function media(Request $request){


    $validator = Validator::make($request->all(), [

      'titre' => 'required','regex:/[\w\d]{5,60}/|unique:media',
      // regex avec certain caractères : utiloser comme tableau []
      'url' => ['required', 'active_url', 'regex:/^http(s)?\:\/\/(www.)?(youtube.com\/watch\?|vimeo.com|dailymotion.com\/video\/)[a-zA-Z0-9\/\?\-\_\=\+\(\)\&\$\€\^]{1,}$/'],
      'page' => 'required|exists:page,id',
      'date_activation' => 'required|date_format:d/m/Y|after:today',
      'visible' => 'required|in:0,1',
    ],[
       'required' => 'Le champs :attribute est obligatoire',
       'regex' => ':attribute est invalide',
       'date_format' => 'Le format de la date doit etre dd/mm/aaaa',
       'titre.regex' => "Le titre n'est pas valide"
    ]);

    // si mon formulaire a été envoyé|soumit
    // et qu'il a échoué au niveau des validations
    if ($validator->fails() && $request->isMethod('post')){

      return redirect()->route('media') //redirige vers nom de la route "contact"
             ->withErrors($validator) //avec erreurs
             ->withInput(); // avec champs remplis

    } else if ($request->isMethod('post')){
      // formulaire est soumis et valide
      // enregistrer en bdd le contact

      // créer un nouveau concat en bdd
      $dateformat =  \DateTime::createFromFormat('d/m/Y', $request->date_activation);
      $media = new Media();
      $media->titre = $request->titre;
      $media->video = $request->url;
      $media->page_id = $request->page;
      $media->date_activation = $dateformat->format('Y-m-d'); //parser YYYY-MM-DD
      $media->visibilite = $request->visible;
      $media->save();

      // redirection avec message de success
      return redirect()->route('media') //redirige vers nom de la route "contact"
         ->with('success',
         'Votre media a bien été crée');
    }


      // retour de la réponse
      return view('media');
  }

}
