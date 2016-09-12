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

Route::get('/', function () {
    return view('welcome');
})->name('homepage');

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


Route::get('/medias', function () {
    return view('medias');
})->name('medias');
