<?php

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

/*
// message/{id}
// message/1
// $id = 1
// Message::find(1)
Route::get('messages/{id}', 'MessagesController@show');
Route::post('messages', 'MessagesController@store');
Route::put('messages/{id}', 'MessagesController@update');
Route::delete('messages/{id}', 'MessagesController@destroy');

Route::get('messages', 'MessagesController@index');
Route::post('messages/create', 'MessagesController@create');
Route::put('messages/{id}', 'MessagesController@update');
*/
// ↑のやつ１行でかける

Route::get('/', 'MessagesController@index');
Route::resource('messages', 'MessagesController');
Route::get('messages/{message}/{content}', 'MessagesController@show')->name('messages.see');

/*
// URI*Requestメソッドの組み合わせ毎に何を行うかを判断する
Route::get('/', function () {
    return view('welcome');
    //getメソッドでURLが/の時、このfunctionを実行する
    
    // resources/views/~<↑の引数>~.blade.phpのファイルを参照する
    //view関数の引数には、.blade.phpの拡張子は指定しなくて良い
    //ディレクトリの下にviewファイルがある場合→views/folder/hoge.blade.php
    // return view('folder.hoge');
    // /ではなく.で区切る
});
*/

