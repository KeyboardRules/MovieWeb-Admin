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

// Route::get('/', function () {
//     return view('welcome');
// });
//Route::get('/users','App\Http\Controllers\UserController@listAdmin')->name("user.list");
//Route::get('/movies','App\Http\Controllers\MovieController@list')->name("movies.list");
//Route::get('/movies/create','App\Http\Controllers\MovieController@create')->name("movies.create");
//Route::post('movies/createSubmit','App\Http\Controllers\MovieController@createSubmit')->name("movies.createSubmit");

// Route::view('/test','admin.views.test');
// Route::view('/theater_list','admin.views.theater-list');
// Route::view('/theater_submit','admin.views.theater-submit');
// Route::view('/theater_detail','admin.views.theater-detail');
// Route::view('/login_test','admin.views.login');

//Login
Route::group(['middleware'=>['auth.login']],function(){
    Route::get('/login','App\Http\Controllers\LoginController@LoginView')->name('login');
    Route::post('/login/validate','App\Http\Controllers\LoginController@Login')->name('login.validate');
    
});

Route::group(['middleware' => ['auth.admin']], function() {
    Route::get('/logout','App\Http\Controllers\LoginController@Logout')->name('logout');
    //Account
    Route::get('/account','App\Http\Controllers\AccountController@AccountDetailView')->name('account');
    Route::get('/account/setting','App\Http\Controllers\AccountController@AccountSettingView')->name('account.setting');
    Route::post('/account/update','App\Http\Controllers\AccountController@AccountUpdate')->name('account.update');
    //Main
    Route::get('/','App\Http\Controllers\MainController@MainView')->name('main');
    //Theater
    Route::get('/theaters','App\Http\Controllers\TheaterController@ListTheaterView')->name("theaters");
    Route::get('/theater/detail/{id}','App\Http\Controllers\TheaterController@DetailTheaterView')->name("theater.detail");
    Route::get('/theater/create','App\Http\Controllers\TheaterController@SubmitTheaterView')->name("theater.create");
    Route::get('/theater/update/{id}','App\Http\Controllers\TheaterController@SubmitTheaterView')->name("theater.edit");
    Route::post('/theater/createSubmit','App\Http\Controllers\TheaterController@SubmitTheater')->name("theater.createSubmit");
    Route::post('/theater/editSubmit/{id}','App\Http\Controllers\TheaterController@SubmitTheater')->name("theater.editSubmit");
    Route::post('/theater/delete/{id}','App\Http\Controllers\TheaterController@DeleteTheater')->name("theater.delete");
    //User
    Route::get('/users','App\Http\Controllers\UserController@ListUserView')->name("users");
    Route::get('/user/detail/{id}','App\Http\Controllers\UserController@DetailUserView')->name("user.detail");
    Route::post('/user/delete/{id}','App\Http\Controllers\UserController@DeleteUser')->name("user.delete");
    //Category
    Route::get('/categories','App\Http\Controllers\CategoryController@CategoryListView')->name("categories");
    Route::get('/category/create','App\Http\Controllers\CategoryController@SubmitCategoryView')->name("category.create");
    Route::get('/category/update/{id}','App\Http\Controllers\CategoryController@SubmitCategoryView')->name("category.edit");
    Route::post('/category/createSubmit','App\Http\Controllers\CategoryController@SubmitCategory')->name("category.createSubmit");
    Route::post('/category/editSubmit/{id}','App\Http\Controllers\CategoryController@SubmitCategory')->name("category.editSubmit");
    Route::post('/category/delete/{id}','App\Http\Controllers\CategoryController@DeleteCategory')->name('category.delete');
    //Movie
    Route::get('/movies','App\Http\Controllers\MovieController@MovieListView')->name("movies");
    Route::get('/movie/detail/{id}','App\Http\Controllers\MovieController@MovieDetailView')->name('movie.detail');
    Route::get('/movie/create','App\Http\Controllers\MovieController@SubmitMovieView')->name("movie.create");
    Route::get('/movie/update/{id}','App\Http\Controllers\MovieController@SubmitMovieView')->name("movie.edit");
    Route::post('/movie/createSubmit','App\Http\Controllers\MovieController@SubmitMovie')->name("movie.createSubmit");
    Route::post('/movie/editSubmit/{id}','App\Http\Controllers\MovieController@SubmitMovie')->name("movie.editSubmit");
    Route::post('/movie/delete/{id}','App\Http\Controllers\MovieController@DeleteMovie')->name('movie.delete');
    //Movie-Theater
    Route::get('/theaters/{id}','App\Http\Controllers\MovieTheaterController@ListTheaterView')->name("movie-theaters");
    Route::get('/delete/{theater}/{movie}','App\Http\Controllers\MovieTheaterController@DeleteTheatersMovies')->name("movies-theaters.delete");
    Route::post('/theaters/editSubmit/{id}','App\Http\Controllers\MovieTheaterController@SubmitTheaters')->name("movie-theaters.editSubmit");
});

