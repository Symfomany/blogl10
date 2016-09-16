<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\Traits\DbTrait;

class Article extends Model
{
  use DbTrait;

  protected $table = "article";

/**
*
*/
public static function articleAutCat($id){
  // Query Builder
  return DB::table('article')
    ->select('article.*', 'categorie.titre as cat_titre','user.prenom as prenom')
    ->join('user', 'user.id', '=', 'article.user_id')
    ->join('categorie', 'categorie.id', '=', 'article.categorie_id')
    ->where('article.id', '=', $id)
    ->first();
}


}
