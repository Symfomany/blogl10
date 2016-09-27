<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Carbon\Carbon;
class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/admin';


    /**
    * Redirection après deconnexion
    */
    protected $redirectAfterLogout = '/login';




    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $dt = new Carbon('-18 years', 'Europe/Paris');

        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:user',
            'password' => 'required|min:6|confirmed',

            // name de inputs => regles de validation
            'prenom' => 'required|max:255',
            'cp' => 'required|digits:5',
            'phone' => ['required', "regex:/^(\(\+[\d]{2,3}?\)|0|\+33|0033)[1-9]([0-9]{8}|([0-9\-\.\/ ]){12})\b/"],
            'ville' => 'required|string|min:3',
            'dob' => 'required|date_format:d/m/Y|before:'.$dt->format('d/m/Y'),
            'biographie' => 'required|min:10|max:3000',
            'image' => 'image|dimensions:min_width=100,min_height=200'

        ],[
          'required' => 'Votre champs doit etre remplis'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     * $data <=> $request->all()
     */
    protected function create(array $data)
    {
      $fileName = "";

      // dump($data);
      // exit;

      // si il y a une image
      if (isset($data['image']) && !empty($data['image'])) {
        $destinationPath = public_path("/uploads/");
        $file = $data['image'];
        $fileName = $file->getClientOriginalName(); //nom du fichier
        $file->move($destinationPath, $fileName);
      }

      $dob = Carbon::createFromFormat('d/m/Y', $data["dob"]);

      return User::create([
          'nom' => $data['name'],
          'prenom' => $data['prenom'],
          'email' => $data['email'],
          'password' => bcrypt($data['password']),
          'code_postal' => $data['cp'],
          'phone' => $data['phone'],
          'ville' => $data['ville'],
          'date_naissance' => Carbon::parse($dob),
          'biographie' => $data['biographie'],
          'image' => $fileName,
      ]);
  }
}
