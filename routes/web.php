<?php

use App\Article;
use App\Http\Controllers\ArticlesController;
use Illuminate\Support\Facades\Route;

use function GuzzleHttp\Promise\all;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/about', function(){
    $articles = App\Article::take(3)->latest()->get();

    return view('about',[
        'articles' => $articles
    ]);
});



// order matters when making your routes. Make sure to put wildcard stuff at the end of the other endpoints - notice the create endpoint is before the wild card endpoint

Route::get('/articles' , 'ArticlesController@index');
Route::get('/articles/create', 'ArticlesController@create');
Route::get('/articles/{article}', 'ArticlesController@show');
Route::get('/articles/{article}/edit', 'ArticlesController@edit');


Route::post('/articles' , 'ArticlesController@store');
Route::put('/articles/{article}', 'ArticlesController@update');
Route::delete('articles/{article}', 'ArticlesController@destroy');


