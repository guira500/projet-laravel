<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ElementController;

Route::get('/', function () {
    return view('welcome');
});


Route::controller(AuthController::class)->group(function () {
    Route::get('register', 'register')->name('register');
    Route::post('register', 'registerSave')->name('register.save');

    Route::get('login', 'login')->name('login');
    Route::post('login', 'loginAction')->name('login.action');

    Route::get('logout', 'logout')->middleware('auth')->name('logout');
});

//route utilisateur normal
Route::middleware(['auth', 'user-access:user'])->group(function () {
    Route::get('/home',[HomeController::class, 'index'])->name('home');
});


//route utilisateur administrateur
Route::middleware(['auth', 'user-access:admin'])->group(function () {
    Route::get('/admin/home',[HomeController::class, 'adminHome'])->name('admin/home');

    Route::get('/admin/profile',[AdminController::class, 'profilePage'])->name('admin/profile');

    Route::get('/admin/elements',[ElementController::class, 'index'])->name('admin/elements');
    Route::get('/admin/elements/create',[ElementController::class, 'create'])->name('admin/elements/create');
    Route::post('/admin/elements/store',[ElementController::class, 'store'])->name('admin/elements/store');
    Route::get('/admin/elements/show/{id}',[ElementController::class, 'show'])->name('admin/elements/show');
    Route::get('/admin/elements/edit/{id}',[ElementController::class, 'show'])->name('admin/elements/edit');
    Route::put('/admin/elements/update/{id}',[ElementController::class, 'update'])->name('admin/elements/update');
    Route::delete('/admin/elements/destroy/{id}',[ElementController::class, 'destroy'])->name('admin/elements/destroy');
});