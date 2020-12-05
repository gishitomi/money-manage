<?php

use Illuminate\Support\Facades\Route;

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

// インデックス画面
Route::get('/kakeibo/{date?}', 'App\Http\Controllers\KakeiboController@index')->name('kakeibo.index');
Route::post('/kakeibo/{date?}', 'App\Http\Controllers\KakeiboController@create');

// 一覧画面
Route::get('/kakeibo/details', 'App\Http\Controllers\KakeiboController@showDetails')->name('kakeibo.details');

// 予算編集、設定画面
Route::get('/budgets/edit/{date?}', 'App\Http\Controllers\BudgetController@showEditForm')->name('budgets.edit');