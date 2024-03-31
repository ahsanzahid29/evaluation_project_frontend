<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\UserController;

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
    return view('login');
})->name('login');
Route::post('/check_login',[UserController::class,'checkLogin'])
    ->name('login_check');
Route::get('/signup', function () {
    return view('signup');
})->name('signup');
Route::post('/user-signup', [UserController::class, 'saveUser'])
    ->name('user-signup');
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/category', [CategoryController::class, 'index'])
    ->name('category-list');
Route::get('/add-category', [CategoryController::class, 'add'])
    ->name('category-add');
Route::post('/save-category',[CategoryController::class,'save'])
    ->name('category-save');
Route::get('/edit-category/{id}',[CategoryController::class,'edit'])
    ->name('category-edit');
Route::patch('/update-category',[CategoryController::class,'update'])
    ->name('category-update');
Route::get('/delete-category/{id}',[CategoryController::class,'delete'])
    ->name('category-delete');
Route::get('/cars', [CarController::class, 'index'])
    ->name('cars-list');
Route::get('/add-car', [CarController::class, 'add'])
    ->name('car-add');
Route::post('/save-car',[CarController::class,'save'])
    ->name('car-save');
Route::get('/edit-car/{id}',[CarController::class,'edit'])
    ->name('car-edit');
Route::patch('/update-car',[CarController::class,'update'])
    ->name('car-update');
Route::get('/delete-car/{id}',[CarController::class,'delete'])
    ->name('car-delete');
Route::get('/logout', [UserController::class, 'logout'])
    ->name('logout');
