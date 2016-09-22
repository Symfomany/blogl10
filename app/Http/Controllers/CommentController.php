<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Comment;
use Validator;
class CommentController extends Controller
{
  /**
  * Add Tchat  message in database
  */
  public function add(Request $request, $id){

    $validator = Validator::make($request->all(), [
       'content' => 'required|min:3',
       'note' => 'required|in:0,1,2,3,4,5',
     ]);

    if (!$validator->fails()) {
      $comm = new Comment();
      $comm->article_id = $id;
      $comm->content = $request->content;
      $comm->note = $request->note;
      $comm->etat = 1;
      $comm->user_id = 1;
      $comm->save(); // created_at at now()
    }
  }

  /**
  * Remove a comment
  */
  public function remove(Request $request,Comment $id){
      $id->delete();
  }



}
