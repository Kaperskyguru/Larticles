<?php

use App\Article;
use App\Comment;
use Illuminate\Http\Request;
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

Route::get('/{any}', function () {
    return view('welcome');
})->where('any', '.*');

Route::get('/single/{id}', function ($id) {
    $article = Article::findOrFail($id);
    $comment = Comment::where('article_id' ,$id)->get();
    $data = [
        'articles' => $article,
        'comments' => $comment
    ];
    return view('Single')->with('data', $data);
});

