<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Article;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\User;

class ArticleController extends Controller
{

  /**
  * Supprimer
  * Para converter
  */
  public function delete($id) {
    Article::deleteArticle($id, 'article');  // article:  deleteArticle

    return redirect()->route('article.list') // redirige vers la page media
   ->with('success', 'L\'article a bien été supprimé.');
 }


/*
* Controller
*/
public function voir(Article $id){

  return view('article/voir',[
    "article" => $id
  ]);
}



    public function lister(){
      $articles = Article::all(); // récupérer tous les utilisateurs
      // transporteur: c'est un conteneur de données (tableaux)
      // elle envoies les données du controlleur à la vue
      return view('article/list', [
        'articles' => $articles
      ]);
    }


    /**
 * function qui change la visibilité de l'article
 * @return string
 */
public function visibilite(Article $id)
{

    $id->visibilite = !$id->visibilite;
    $id->save();
   return redirect()->route('article.list')->with('success', "La visibilité de l'article a bien été modifié.");
}

public function pdf(Article $id, Dompdf $dompdf, Options $options)
{
    $dompdf->loadHtml(
      "<h1>".$id->titre."</h1>".
      "<p>".$id->resume."</p>".
      "<img src='".$id->image."' width='500'/>".
      "<p>".$id->description."</p>".
      "<h3>Informations complémentaires</h3>".
      "<p>Auteur : ".User::infoUser(['prenom'], $id->user_id)->prenom." ".User::infoUser(['nom'], $id->user_id)->nom."</p>".
      "<p>Visibilité : ".$id->visibilite."</p>".
      "<p>Note : ".$id->note."</p>".
      "<p>Date de création : ".$id->date_creation."</p>".
      "<p>Date de modification : ".$id->date_modification."</p>".
      "<p>Année de publication : ".$id->annee_publication."</p>"
     );

    // Autorise les images externes type http://...
    $options->setIsRemoteEnabled(true); //load urls distantes
    $dompdf->setOptions($options);
    $dompdf->render();

    // Output the generated PDF to Browser
    $dompdf->stream("Article ".$id->id,['Attachment'=>0]);
}

}
