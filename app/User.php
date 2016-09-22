<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;
class User extends Authenticatable
{
  protected $table = "user";

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
        'name', 'email', 'password',
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
