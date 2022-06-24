<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\StudentController;

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
Route::get('/home', [PagesController::class, 'home'])->name('home');

Route::get('/products', [PagesController::class, 'products'])->name('products');

Route::get('/teams', [PagesController::class, 'teams'])->name('teams');

Route::get('/aboutUs', [PagesController::class, 'aboutUs'])->name('aboutUs');

Route::get('/contactUs', [PagesController::class, 'contactUs'])->name('contactUs');
Route::post('/contactUs', [PagesController::class, 'contactUsSubmit'])->name('contactUs');

// studeny route
Route::get('/studentRegistration', [StudentController::class, 'studentRegistration'])->name('studentRegistration');
Route::post('/studentRegistration', [StudentController::class, 'studentRegistrationSubmit'])->name('studentRegistration');

// Route::get('/login', [StudentController::class, 'login'])->name('login');
// Route::post('/login', [StudentController::class, 'loginSubmit'])->name('login');

Route::get('/loginForm', [StudentController::class, 'loginForm'])->name('loginForm');
Route::post('/loginForm', [StudentController::class, 'loginFormSubmit'])->name('loginForm');

