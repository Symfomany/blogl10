<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Carbon\Carbon;
use Validator;
use App\User;
use Image;

class UserController extends Controller
{


  public function lister(){

    $users = User::all(); // récupérer tous les utilisateurs

    // transporteur: c'est un conteneur de données (tableaux)
    // elle envoies les données du controlleur à la vue
    return view('user/list', [
      'users' => $users
    ]);
  }






  public function add(Request $request)
  {
    $dt = new Carbon('-18 years', 'Europe/Paris');
    $validator = Validator::make($request->all(), [
      'nom' => 'required|min:4',
      'prenom' => 'required|min:4',
      'email' => 'required|email|unique:user,mail',
      'password' => ['required','confirmed', 'regex: /^(?=.{8,})(?=[^\W])(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$/'],
      'cp' => 'required|digits:5',
      'phone' => ['required', "regex:/^(\(\+[\d]{2,3}?\)|0|\+33|0033)[1-9]([0-9]{8}|([0-9\-\.\/ ]){12})\b/"],
      'ville' => 'required|string|min:3',
      'dob' => 'required|date_format:d/m/Y|before:'.$dt->format('d/m/Y'),
      'biographie' => 'required|min:10|max:3000',
      'image' => 'image|dimensions:min_width=100,min_height=200'
    ]);

    if ($validator->fails() && $request->isMethod('post')) {

      return redirect()->route('user')
      ->withErrors($validator)
      ->withInput(); // Avec tous les champs remplis gardés
    }
    elseif ($request->isMethod('post')){

      //Si formulaire soumis et valide => enregistrer en bdd
      $user = new User();

      $user->nom = $request->nom;
      $user->prenom = $request->prenom;
      $user->mail = $request->email;
      $user->password = bcrypt($request->password); // bcrypt()
      $user->code_postal = $request->cp;
      $user->ville = $request->ville;
      $user->date_naissance = Carbon::createFromFormat("d/m/Y",$request->dob)->format("Y-m-d");
      $user->phone = $request->phone;
      $user->biographie = $request->biographie;
      $user->date_auth = new Carbon();

      // pour l'upload d'image
      if ($request->hasFile('image')) {
        //image: c'est le name du champs
        $destinationPath = public_path("/uploads/"); // destination
        $file = $request->file('image'); //je recupere le fichier
        // dump($file);
        // exit();
        $fileName = $file->getClientOriginalName();
         //je récupere le nom du fichier

        $file->move($destinationPath, $fileName);

        Image::make($destinationPath.$fileName)
        ->resize(100, null, function ($constraint) {
          $constraint->aspectRatio();
        })->save('uploads/thumbail_'.$fileName);

        //je bouge le fichier dans la destination
        $user->image = $fileName;
        //enregistrement bdd nom du fichier
      }

    $user->save();


      //Redirection avec message de succès
      return redirect()->route('user')
      ->with('success', "Votre inscription s'est bien déroulée !");       //Message de succés (voir doc)

    }



    return view('user');


  }


}
