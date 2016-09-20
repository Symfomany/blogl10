<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@welcome')->name('homepage');
Route::get('/categories-stats',
'WelcomeController@statsCategories')
->name('statsCategories');

Route::get('/articles-stats','WelcomeController@statsArticles')
->name('statsArticles');

Route::get('/comments-stats','WelcomeController@commentsArticles')
->name('commentsArticles');

Route::get('/tchat', function(){
  return App\Tchat::all();
})
->name('tchat');


Route::post('/tchat-add', function(Illuminate\Http\Request $request){

  $tchat = new  App\Tchat();
  $tchat->content = $request->content;
  $tchat->save();

})
->name('tchat-add');


//  'NomduCobntroller@nomdelamethodeducontroller'

Route::any('/contact', 'ContactController@contact')->name('contact');

Route::get('/faq', function () {
    return view('faq');
})->name('faq');

Route::get('/concept', function () {
    return view('concept');
})->name('concept');

Route::get('/about', function () {
    return view('about');
})->name('about');


Route::any('/media', 'MediaController@media')->name('media');


// grpuer une liste de route
// permet de les préfixer au niveau URI
Route::group(['prefix' => 'user'], function () {

  Route::any('/add', 'UserController@add')->name('add');
  Route::any('/list', 'UserController@lister')->name('list');
});

// grpuer une liste de route
// permet de les préfixer au niveau URI
Route::group(['prefix' => 'article'], function () {

  Route::get('/delete/{id}', 'ArticleController@delete')->name('article.delete');
  Route::get('/visibilite/{id}', 'ArticleController@visibilite')->name('article.visibilite');
  Route::any('/list', 'ArticleController@lister')->name('article.list');
  Route::get('/voir/{id}', 'ArticleController@voir')
  ->name('article.voir')
  ->where('id', '[0-9]+');
  Route::get('/pdf/{id}', 'ArticleController@pdf')->name('article.pdf');
  Route::get('/panier/{id}/{action}', 'ArticleController@panier')
  ->name('article.panier')
  ->where('id', '[0-9]+')
  ->where('action', 'like|unlike');

  Route::get('/panier/clear/{id?}', 'ArticleController@clearCart')->name('article.clear');

});
