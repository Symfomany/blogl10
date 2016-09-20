<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class Comment extends Model
{

  protected $table = "comment";

  /**
  *
  */
  public static function getNbCommentActif($visibilite){

      return Comment::where('etat', $visibilite)
             ->count();
  }

  public static function getVariationNbComments($annee){


      return Comment::select(DB::raw('COUNT(*) as value'))
                      ->whereYear('created_at','=', $annee)
                      ->first()
                      ->value;
  }

  public static function getNbCommsByArticles(){

    return Comment::select(DB::raw('COUNT(*) as value'), 'article.titre as label')
                  ->join('article', 'comment.article_id', '=', 'article.id')
                  ->groupBy('article_id')
                  ->get();
  }


}
