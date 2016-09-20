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
  * Homepage
  */
  public function welcome(){

    $nbArticles = Article::getNbArticlesVisibles(1);
    $nbCategories = Categorie::getNbCategoriesFilled();
    $nbMedias = Media::getNbMedias();
    $nbComment = Comment::getNbCommentActif(1);

    dump($nbMedias);
    exit();

    // $nbCat =  Categorie::has('articles')->count();
    // dump($nbCat);
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
