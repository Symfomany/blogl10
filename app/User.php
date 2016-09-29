<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;
class User extends Authenticatable
{
  protected $table = "user";

  /**
  * SELECT  `nom` ,  `email`
  * FROM  `user`
  * LEFT JOIN COMMENT ON user.id = comment.user_id
  * WHERE comment.user_id IS NULL
  */
  public static function getBadUser(){
    return DB::table('user')->select('nom', 'email')
     ->leftJoin('comment', 'comment.user_id', '=', 'user.id')
     ->whereNull('comment.user_id')
     ->get();
  }


  public static function infoUser(array $table, $id) {
    return DB::table('user')->select($table)
                         ->where('id', $id)
                         ->first();
    }


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nom','prenom','age', 'dob', 'biographie', 'ville', 'cp',
        'email', 'password', 'phone', 'image'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
