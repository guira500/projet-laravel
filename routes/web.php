<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ElementController;
use App\Http\Controllers\ProfesseurController;
use App\Http\Controllers\SalleController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\EmploiController;
use App\Http\Controllers\EmploiUserController;
use App\Http\Controllers\AfficherController;




Route::get('/', function () {
    /* return view('welcome'); */
    return redirect()->route('login');
});


Route::controller(AuthController::class)->group(function () {
    Route::get('register', 'register')->name('register');
    Route::post('register', 'registerSave')->name('register.save');

    Route::get('login', 'login')->name('login');
    Route::post('login', 'loginAction')->name('login.action');

    Route::get('logout', 'logout')->middleware('auth')->name('logout');

    //Route::get('sendTestEmail', 'sendTestEmail')->name('sendTestEmail');
});


Route::controller(AfficherController::class)->group(function () {
    Route::get('afficher', 'index')->name('afficher');
});


//route utilisateur normal
Route::middleware(['auth', 'user-access:user'])->group(function () {
    Route::get('/home',[HomeController::class, 'index'])->name('home');

    Route::get('/home/emplois',[EmploiUserController::class, 'index'])->name('home/emplois');

    Route::post('/home/emplois/valider/{id}', [EmploiUserController::class, 'valider'])->name('home/emplois/valider');
    Route::post('/home/emplois/refuser/{id}', [EmploiUserController::class, 'refuser'])->name('home/emplois/refuser');

    Route::post('/home/emplois/soumettre/{niveau}', [EmploiUserController::class, 'soumettre'])->name('home/emplois/soumettre');
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

    Route::get('/admin/professeur',[ProfesseurController::class, 'index'])->name('admin/professeur');

    Route::get('/admin/salle',[SalleController::class, 'index'])->name('admin/salle');
    Route::post('/admin/salle/store',[SalleController::class, 'store'])->name('admin/salle/store');

    Route::get('/admin/module',[ModuleController::class, 'index'])->name('admin/module');
    Route::post('/admin/module/store',[ModuleController::class, 'store'])->name('admin/module/store');

    Route::get('/admin/emploi',[EmploiController::class, 'index'])->name('admin/emploi');
    Route::post('/admin/emploi/store',[EmploiController::class, 'store'])->name('admin/emploi/store');

    Route::post('admin/emploi/envoyer/{niveau}', [EmploiController::class, 'envoyer'])->name('admin/emploi/envoyer');

    Route::post('admin/emploi/publier/{niveau}', [EmploiController::class, 'publier'])->name('admin/emploi/publier');

    Route::post('admin/emploi/retirer/{niveau}', [EmploiController::class, 'retirer'])->name('admin/emploi/retirer');
});