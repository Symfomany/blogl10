<?php

namespace App\Traits;

use DB;


trait DbTrait{

  /**
  * Delete Article
  */
  public static function deleteArticle($id, $table) {

     return DB::table($table)->where('id', $id)
                                ->delete();
  }


  /**
  * Recupérer les articles visibles
  */
  public  static function getNbVisibles(
  $class, $column, $visibilite){

    return $class::where($column, $visibilite)
           ->count();
  }

}







 ?>
