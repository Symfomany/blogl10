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
* SELECT COUNT( article.id ) AS nbArticles, categorie.titre
* FROM article
* INNER JOIN categorie ON categorie.id = article.categorie_id
* GROUP BY categorie_id
*/
public static function getNbArticlesByCategories(){

  return Article::select(DB::raw('COUNT(article.id) as value'), 'categorie.titre as label')
                ->join('categorie', 'categorie.id', '=', 'article.categorie_id')
                ->groupBy('categorie_id')
                ->get();
}



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



/**
* Recupérer les articles visibles
*/
public  static function getNbArticlesVisibles($visibilite){

  return Article::where('visibilite' ,  $visibilite)
         ->count();
}




}
