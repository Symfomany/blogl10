<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Media extends Model
{

  protected $table = "media";

  /**
  *
  */
  public static function getNbMedias(){

    return Media::join('article_media', 'article_media.media_id', '=',
    'media.id')
      ->groupBy('article_media.media_id')
      ->get()->count();

  }


  /**
    * The roles that belong to the user.
    */
   public function articles()
   {
       return $this->belongsToMany('App\Article');
   }
}
