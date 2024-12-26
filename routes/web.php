<?php

use App\Http\Controllers\PersonsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


// Public Routes --------------------------------------------------------------------
Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Public Authenticated Routes ------------------------------------------------------
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Global routes ----------------------------------------------------
    Route::get('/getKelurahan/{id}', [PersonsController::class, 'getKelurahan']);
    Route::get('/penduduk/cari', [PersonsController::class, 'searchPersons'])->name('persons.search');
    Route::get('/penduduk/find', [PersonsController::class, 'searchPersonsByName'])->name('persons.search_name');

});

// System Administrator and Puskesmas Routes ------------------------------------------------------
Route::middleware(['role:System Administrator,Puskesmas'])->group(function (){
    // Method Users Management Routes ----------------------------------------------------
    Route::post('/admin/store/users', [UserController::class, 'store'])->name('users.store');
    Route::delete('/destroy/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::post('/admin/update/profile', [UserController::class, 'update_profile'])->name('user.update_profile');
    Route::post('/admin/update/password', [UserController::class, 'update_password'])->name('user.update_password');
    Route::post('/admin/update/role', [UserController::class, 'update_role'])->name('user.update_role');


});

// System Administrator Routes ------------------------------------------------------
Route::middleware(['role:System Administrator'])->group(function (){
    Route::get('/layout', function () {
        return view('components.layout');
    });
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

    // Users Management
    Route::get('/admin/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/admin/users/{id}', [UserController::class, 'detail_view'])->name('users.detail_view');
    Route::post('/admin/update/email', [UserController::class, 'update_email'])->name('user.update_email');

    // Penduduk Management
    Route::get('/admin/penduduk', [PersonsController::class, 'index'])->name('persons.index');
    Route::get('/admin/penduduk/lansia', [PersonsController::class, 'index_lansia'])->name('persons.index_lansia');
    Route::get('/admin/penduduk/pra-lansia', [PersonsController::class, 'index_pra_lansia'])->name('persons.index_pra_lansia');

    Route::post('/admin/penduduk/store', [PersonsController::class, 'store'])->name('persons.store');
    Route::delete('/destroy/penduduk/{id}', [PersonsController::class, 'destroy'])->name('persons.destroy');
    Route::get('/admin/penduduk/{id}', [PersonsController::class, 'detail_view'])->name('persons.detail_view');
    Route::get('/admin/penduduk/edit/{id}', [PersonsController::class, 'edit_view'])->name('persons.edit_view');
    Route::post('/admin/penduduk/update/{id}', [PersonsController::class, 'update'])->name('persons.update');


});

// Dinkes Routes ------------------------------------------------------
Route::middleware(['role:Dinkes'])->group(function (){
     Route::get('/dinkes/dashboard', function () {
        return view('dinkes.dashboard');
    })->middleware(['auth', 'verified'])->name('dinkes.dashboard');

    // Penduduk Management
    Route::get('/dinkes/penduduk', [PersonsController::class, 'index'])->name('persons.index');
    Route::get('/dinkes/penduduk/lansia', [PersonsController::class, 'index_lansia'])->name('persons.index_lansia');
    Route::get('/dinkes/penduduk/pra-lansia', [PersonsController::class, 'index_pra_lansia'])->name('persons.index_pra_lansia');
    Route::delete('/destroy/penduduk/{id}', [PersonsController::class, 'destroy'])->name('persons.destroy');
    Route::get('/dinkes/penduduk/{id}', [PersonsController::class, 'detail_view'])->name('persons.detail_view');
    Route::get('/dinkes/penduduk/edit/{id}', [PersonsController::class, 'edit_view'])->name('persons.edit_view');
    



});

// Puskesmas Routes ------------------------------------------------------
Route::middleware(['role:Puskesmas'])->group(function (){
    
    Route::get('/puskesmas/dashboard', function () {
        return view('puskesmas.dashboard');
    })->middleware(['auth', 'verified'])->name('puskesmas.dashboard');
    Route::get('/puskesmas/users', [UserController::class, 'index_puskesmas'])->name('users.index_puskesmas');
    Route::get('/puskesmas/users/{id}', [UserController::class, 'detail_view_puskesmas'])->name('users.detail_view_puskesmas');
    Route::get('/puskesmas/penduduk', [PersonsController::class, 'index_puskesmas'])->name('persons.index_puskesmas');
    Route::get('/puskesmas/penduduk/lansia', [PersonsController::class, 'index_lansia_puskesmas'])->name('persons.index_lansia_puskesmas');
    Route::get('/puskesmas/penduduk/pra-lansia', [PersonsController::class, 'index_pra_lansia_puskesmas'])->name('persons.index_pra_lansia_puskesmas');


});

// Kader Routes ------------------------------------------------------
Route::middleware(['role:Kader'])->group(function (){
    
    Route::get('/kader/dashboard', function () {
        return view('kader.dashboard');
    })->middleware(['auth', 'verified'])->name('kader.dashboard');

    
});

require __DIR__.'/auth.php';
