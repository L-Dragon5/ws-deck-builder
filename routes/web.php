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

Route::get('/', 'DeckController@index');

Route::resource('decks', 'DeckController');
Route::post('/decks/list', 'DeckController@getDeckList');

Route::get('/tools', 'ToolController@index');
Route::get('/tools/export', 'ToolController@export');
Route::put('/tools/update-password', 'ToolController@updatePassword');