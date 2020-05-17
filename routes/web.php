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

Auth::routes();

Route::get('/', function () { return redirect('fases'); });

//All routes where login is required
Route::group(['middleware' => 'auth'], function () {

//    Fases Route
    Route::get('fases', "PhasesController@show")->name('phases');

    Route::get('fases/create', "PhasesController@create")->name('create_phase');
    Route::post('fases/save', "PhasesController@store")->name('save_phase');

    Route::get('fases/edit/{id}', "PhasesController@edit")->name('edit_phase');
    Route::post('fases/update/{id}', "PhasesController@update")->name('update_phase');
    Route::get('fases/delete/{id}','PhasesController@destroy')->name('delete_phase');

//    Themes Route
    Route::get('fase/{fase_id}/themes','ThemesController@show')->name('themes');

    Route::get('fase/{fase_id}/themes/create', "ThemesController@create")->name('create_theme');
    Route::post('fase/{fase_id}/themes/save', "ThemesController@store")->name('save_theme');
//    Route::get('verwervingsfase', "ThemesController@show");
//    Route::get('transitiefase', "ThemesController@show");
//    Route::get('onderhoudsfase', "ThemesController@show");
//    Route::get('overdrachtennazorg', "ThemesController@show");

});

