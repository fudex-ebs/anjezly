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
Route::group(['middleware' => ['auth']], function() {
        Route::get('/dashboard/personal_info','ClientController@personal_info');
        Route::post('/personal_info/update','ClientController@personal_info_update');
        Route::post('uploadUserImg','ClientController@personal_info_uploadImg');

        Route::get('/dashboard/my_skills','ClientController@my_skills');
        Route::get('my_skills/delete','ClientController@my_skills_delete');
        Route::post('updateSkills','ClientController@skillsUpdate');

        Route::get('/dashboard/portfolio','ClientController@portfolio');
        Route::get('/portfolio/add','ClientController@portfolio_add');
        Route::post('portfolioInsert','ClientController@portfolio_insert');
        Route::get('portfolio/changeStatus','ClientController@portfolio_changeStatus');
        Route::get('portfolio/delete','ClientController@portfolio_delete');
        Route::get('portfolio/edit/{item}','ClientController@portfolio_edit');
        Route::post('portfolio/update/{item}','ClientController@portfolio_update');  
        
        Route::get('/dashboard/deleteItem','ClientController@delete_item');
        //-------- Projects -----------
        Route::get('/project/add','ProjectsController@project_add');
        Route::post('projects/insert','ProjectsController@project_insert');
        Route::get('/dashboard/my_projects','ProjectsController@my_projects');
        Route::get('my_projects/delete','ProjectsController@my_projects_delete');
        Route::get('project/edit/{item}','ProjectsController@my_projects_edit');
        Route::post('project/update/{item}','ProjectsController@my_projects_update');  
});

 // OAuth Routes (Social login)
Route::get('auth/{provider}', 'Auth\AuthController@redirectToProvider');
Route::get('auth/{provider}/callback', 'Auth\AuthController@handleProviderCallback');

