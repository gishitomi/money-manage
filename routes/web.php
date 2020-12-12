<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', 'App\Http\Controllers\HomeController@index');

// 会員登録・ログイン・ログアウト・パスワード再設定の各機能で必要なルーティング設定をすべて定義
Auth::routes();

// インデックス画面
Route::get('/kakeibo/{date?}', 'App\Http\Controllers\KakeiboController@index')->name('kakeibo.index');
Route::post('/kakeibo/{date?}', 'App\Http\Controllers\KakeiboController@create');

// 一覧画面
Route::get('/kakeibo/details', 'App\Http\Controllers\KakeiboController@showDetails')->name('kakeibo.details');

// 予算編集、設定画面
Route::get('/budgets/edit/{date?}', 'App\Http\Controllers\BudgetController@showEditForm')->name('budgets.edit');
Route::post('/budgets/edit/{date?}', 'App\Http\Controllers\BudgetController@edit');


// Chart.jsでデータを渡すためのAjax用URL
Route::get('ajax/kakeibo', 'App\Http\Controllers\Ajax\KakeiboController@index');