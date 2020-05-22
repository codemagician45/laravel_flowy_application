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
    Route::get('fases/{fase_id}/themes','ThemesController@show')->name('themes');

    Route::get('fases/{fase_id}/themes/create', "ThemesController@create")->name('create_theme');
    Route::post('fases/{fase_id}/themes/save', "ThemesController@store")->name('save_theme');

    Route::get('fases/{fase_id}/themes/edit/{id}', "ThemesController@edit")->name('edit_theme');
    Route::post('fases/{fase_id}/themes/update/{id}', "ThemesController@update")->name('update_theme');

    Route::get('fases/{fase_id}/themes/delete/{id}','ThemesController@destroy')->name('delete_theme');

//    Process Route
    Route::get('fases/{fase_id}/themes/{theme_id}/processes',"ProcessesController@show")->name('processes');

    Route::get('fases/{fase_id}/themes/{theme_id}/processes/create',"ProcessesController@create")->name('create_process');
    Route::post('fases/{fase_id}/themes/{theme_id}/processes/store',"ProcessesController@store")->name('save_process');

    Route::get('fases/{fase_id}/themes/{theme_id}/processes/{id}/show',"ProcessesController@show_process")->name('process_show_flowchart');
    Route::post('fases/{fase_id}/themes/{theme_id}/processes/{id}/store',"ProcessesController@update_process")->name('process_store_flowchart');

    Route::get('fases/{fase_id}/themes/{theme_id}/processes/{id}/edit',"ProcessesController@edit_process")->name('process_edit_flowchart');
//    Route::post('fases/{fase_id}/themes/{theme_id}/processes/{id}/update',"ProcessesController@update_flow_chart")->name('process_update_flowchart');

    Route::get('/',"ProcessesController@dashboard")->name('dashboard');
    Route::post('/search','ProcessesController@search')->name('search-process');
});

