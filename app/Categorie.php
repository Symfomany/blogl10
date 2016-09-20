<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{

  protected $table = "categorie";

    /**
    * Nb de catégories remplies
    */
    public static function getNbCategoriesFilled(){

      // jointures
      // return Categorie::join('article',
      // 'categorie.id', '=', 'article.categorie_id')
      //   ->count();

        // Julien
      return Article::groupBy('categorie_id')
      ->get()->count();
    }


    /**
    * Approche ORM Eloquent Relationship
    */
    /**
   * Get the comments for the blog post.
   */
  public function articles()
  {
      return $this->hasMany('App\Article');
  }


}
