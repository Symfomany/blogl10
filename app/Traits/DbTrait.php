<?php

namespace App\Traits;

use DB;

trait DbTrait{


  public static function deleteArticle($id, $table) {

     return DB::table($table)->where('id', $id)
                                ->delete();
  }

}







 ?>
