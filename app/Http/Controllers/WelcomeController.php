<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Article;
use App\Categorie;
use App\Media;
use App\Comment;

class WelcomeController extends Controller
{

  /**
  * Retoruner du JSON (un tableaux d'objets en JS)
  */
  public function statsCategories(){

    $nbCat = Article::getNbArticlesByCategories();

    // parser les values
    foreach($nbCat as $key => $categorie){
      // caster une chaine en nombre
      $nbCat[$key]['value'] = (int) $nbCat[$key]['value'];
    }
    // dump($nbCat);exit;
    return $nbCat->toJson();
  }

  public function statsArticles(){
    $nbComms = Comment::getNbCommsByArticles();
    // exit(dump($nbComms));
    return $nbComms->toJson();

  }

  public function commentsArticles(){

    $datas = [];

    for ($i = date('Y')-5; $i < date('Y'); $i++) {
      $datas[] = [
            'year' =>  (string) $i,
            'value' => Comment::getVariationNbComments($i)
        ];
    }

    return $datas;
  }


  /**
  * Homepage
  */
  public function welcome(){

    $nbArticles = Article::getNbArticlesVisibles(1);
    $nbCategories = Categorie::getNbCategoriesFilled();
    $nbMedias = Media::getNbMedias();
    $nbComment = Comment::getNbCommentActif(1);

    // dump($nbMedias);
    // exit();

    // $nbCat =  Categorie::has('articles')->count();
    // dump($nbCat);
    // exit;

    // $nbMedias =  Media::has('articles')->count();
    // dump($nbMedias);
    // exit;

    // $media = Media::find(6);
    // dump($media->articles()->get());
    // exit;



    return view('welcome',
     [
       'nbArticles' => $nbArticles,
       'nbCategories' => $nbCategories,
       'nbMedias' => $nbMedias,
       'nbComment' => $nbComment,
      ]
   );
  }


}
