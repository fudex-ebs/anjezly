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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/personal_info','ClientController@personal_info');
Route::post('/personal_info/update','ClientController@personal_info_update');
Route::post('uploadUserImg','ClientController@personal_info_uploadImg');

Route::get('/my_skills','ClientController@my_skills');
Route::get('my_skills/delete','ClientController@my_skills_delete');
Route::post('updateSkills','ClientController@skillsUpdate');

// OAuth Routes
Route::get('auth/{provider}', 'Auth\AuthController@redirectToProvider');
Route::get('auth/{provider}/callback', 'Auth\AuthController@handleProviderCallback');