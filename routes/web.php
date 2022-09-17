<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\CompaniesController;
use App\Http\Controllers\Admin\EmployeesController;

use App\Http\Controllers\Moderator\CompaniesController1;
use App\Http\Controllers\Moderator\EmployeesController2;

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

// Auth::routes();
Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::get('/admin', function(){
//     return 'you are admin';
// })->middleware(['auth','auth.admin']);


Route::get('/admin/dashboard', function () {
    return view('admin/home');
})->middleware(['auth','auth.admin'])->name('admin.dashboard');

Route::get('/moderator/dashboard', function () {
    return view('moderator/home');
})->middleware(['auth','auth.moderator'])->name('moderator.dashboard');

//Routes for admin
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth','auth.admin']], function(){
    Route::resource('/categories', CategoriesController::class);
    Route::resource('/companies', CompaniesController::class);
    Route::resource('/employees', EmployeesController::class);
});

//Routes for moderator
Route::group(['prefix' => 'moderator', 'as' => 'moderator.', 'middleware' => ['auth','auth.moderator']], function(){
    Route::resource('/companies', CompaniesController1::class);
    Route::resource('/employees', EmployeesController2::class);
});