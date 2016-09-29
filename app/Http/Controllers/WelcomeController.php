<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Article;
use App\Categorie;
use App\Media;
use App\Comment;
use Mail;
use App;
use Session;
use Lang;
class WelcomeController extends Controller
{


  public function langue($locale){

    App::setLocale($locale);
    return redirect()
    ->back()
    ->with('success',trans('messages.successLangue') 
    );
  }


  /**
  * Retoruner du JSON (un tableaux d'objets en JS)
  */
  public function statsCategories(){

    $nbCat = Article::getNbArticlesByCategories();
    $tab = [['Label', 'Nombre']];
    foreach($nbCat as $key => $art){
      $tab[] = [$art->label, (int)$art->value ];
    }

    return $tab;

  }

  public function statsArticles(){
    $nbComms = Comment::getNbCommsByArticles();
    // exit(dump($nbComms));
    return $nbComms->toJson();

  }

  public function commentsArticles(){

    $datas = [['Annee', 'Nombre']];

    for ($i = date('Y')-8; $i <= date('Y'); $i++) {
      $datas[] = [
              (string) $i,
              (int) Comment::getVariationNbComments($i)
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

    $oneArt = Article::all()->random();

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
       'oneArt' => $oneArt,
      ]
   );
  }


}
