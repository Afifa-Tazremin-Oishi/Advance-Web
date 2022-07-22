<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\AdvertisementController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\UserController;

Route::get('/', function () {return view('pages.home');})->name('home');

//registration controller

Route::get('/registration',[RegistrationController::class,'registration'])->name('signup');
Route::post('/registration',[RegistrationController::class,'validateRegistration'])->name('signup');

//login controller
Route::get('/login',[LoginController::class,'login'])->name('login');
Route::post('/login',[LoginController::class,'loginCheck'])->name('login');



//logout controller
Route::get('/logout',[LogoutController::class,'logout'])->name('logout');

//manager controller
Route::get('/manager/dash',[ManagerController::class,'dashboard'])->name('dashboardManager')->middleware('ManagerValidAuth');
Route::get('/manager/edit',[ManagerController::class,'editManagerInfo'])->name('editManagerInfo')->middleware('ManagerValidAuth');
Route::post('/manager/edit',[ManagerController::class,'managerInfoUpdate'])->name('managerInfoUpdate')->middleware('ManagerValidAuth');

//advertisement controller

Route::get('/advertisementList',[AdvertisementController::class,'showList'])->name('advertisementList')->middleware('ManagerValidAuth');
Route::get('/advertisementList',[AdvertisementController::class,'advertisementList'])->name('advertisementList')->middleware('ManagerValidAuth');
Route::get('deleteAdvertisement/{id}',[AdvertisementController::class,'deleteAdvertisement'])->name('deleteAdvertisement/{id}')->middleware('ManagerValidAuth');
Route::post('/updateAdvertisement',[AdvertisementController::class,'updateAdvertisement'])->name('updateAdvertisement')->middleware('ManagerValidAuth');


//payment controller
Route::get('/paymentList',[PaymentController::class,'showList'])->name('paymentList')->middleware('ManagerValidAuth');

Route::get('/paymentList',[PaymentController::class,'paymentList'])->name('paymentList')->middleware('ManagerValidAuth');
Route::get('/receivePaymentList',[PaymentController::class,'receivePaymentList'])->name('receivePaymentList')->middleware('ManagerValidAuth');

Route::get('deletePayment/{id}',[PaymentController::class,'deletePayment'])->name('deletePayment/{id}')->middleware('ManagerValidAuth');

Route::get('receivePayment/{id}',[PaymentController::class,'receivePayment'])->name('receivePayment/{id}')->middleware('ManagerValidAuth');

Route::post('/sendPayment',[PaymentController::class,'sendPayment'])->name('sendPayment')->middleware('ManagerValidAuth');
Route::get('sendPayment/{id}',[PaymentController::class,'editPayment'])->name('sendPayment/{id}')->middleware('ManagerValidAuth');

Route::post('/receivePayment',[PaymentController::class,'receivePayment'])->name('receivePayment')->middleware('ManagerValidAuth');
Route::get('receivePayment/{id}',[PaymentController::class,'recPayment'])->name('receivePayment/{id}')->middleware('ManagerValidAuth');


// User controller
Route::post('/addUser',[UserController::class,'listingUser'])->name('addUser')->middleware('ManagerValidAuth');
Route::get('/addUser',[UserController::class,'allUser'])->name('addUser')->middleware('ManagerValidAuth');
Route::get('/api/editUser/{id}',[UserController::class,'EditUser'])->name('editUser/{id}')->middleware('ManagerValidAuth');


