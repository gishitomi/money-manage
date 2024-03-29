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

Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home');

// 会員登録・ログイン・ログアウト・パスワード再設定の各機能で必要なルーティング設定をすべて定義
Auth::routes();

// ページ認証...ログインしていないとアクセスできないようにする
Route::group(['middleware' => 'auth'], function() {
    // インデックス画面
Route::get('/kakeibo/{date}', 'App\Http\Controllers\KakeiboController@index')->name('kakeibo.index');
Route::post('/kakeibo/{date}', 'App\Http\Controllers\KakeiboController@create');

// 一覧画面
Route::get('/kakeibo/details/{date}', 'App\Http\Controllers\KakeiboController@showDetails')->name('kakeibo.details');
Route::post('/kakeibo/details/{date}', 'App\Http\Controllers\KakeiboController@detailsEdit');

// 予算編集、設定画面
Route::get('/budgets/edit/{date?}', 'App\Http\Controllers\BudgetController@showEditForm')->name('budgets.edit');
Route::post('/budgets/edit/{date?}', 'App\Http\Controllers\BudgetController@edit');

// 家計簿統計画面
Route::get('/kakeibo/statistics/{date?}', 'App\Http\Controllers\KakeiboController@showStatisticsForm')->name('kakeibo.statistics');
Route::post('/kakeibo/statistics/{date?}', 'App\Http\Controllers\KakeiboController@statistics');

//家計簿一覧画面（PC：カレンダー形式、スマホ：一覧形式）
Route::get('/kakeibo/list/{date?}', 'App\Http\Controllers\CalendarController@index')->name('kakeibo.list');

//Ajax用URL(日付変換用)
Route::post('/changedate', 'App\Http\Controllers\Ajax\KakeiboController@changeDate');

});

// Chart.jsでデータを渡すためのAjax用URL
Route::get('/ajax/kakeibo', 'App\Http\Controllers\Ajax\KakeiboController@index');


// ゲストログイン
Route::get('/login/guest', 'App\Http\Controllers\Auth\LoginController@guestLogin')->name(('guest.login'));