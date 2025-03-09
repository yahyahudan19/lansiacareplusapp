<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KunjungansController;
use App\Http\Controllers\LaporansController;
use App\Http\Controllers\PersonsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PuskesmasController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WhatsappController;
use App\Models\Puskesmas;
use Illuminate\Support\Facades\Route;


// Public Routes --------------------------------------------------------------------
Route::get('/', function () {
    return redirect('login');
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
    Route::get('/getPendudukByNIK', [PersonsController::class, 'getPendudukByNIK']);
    Route::delete('/destroy/penduduk/{id}', [PersonsController::class, 'destroy'])->name('persons.destroy');

    Route::get('/admin/laporan/exportExcel', [LaporansController::class, 'exportExcel'])->name('laporan.exportExcel');

});

Route::middleware(['role:System Administrator,Puskesmas,Kader'])->group(function (){
    Route::delete('/destroy/kunjungan/{id}', [KunjungansController::class, 'destroy'])->name('kunjungans.destroy');
    Route::get('/kunjungan/find', [KunjungansController::class, 'searchPersonsByName'])->name('kunjungans.search_name');
    Route::get('/kunjungan/cari', [KunjungansController::class, 'searchKunjungans'])->name('kunjungans.search');
    Route::post('/admin/penduduk/store', [PersonsController::class, 'store'])->name('persons.store');

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

Route::middleware(['role:System Administrator,Dinkes'])->group(function (){

    Route::post('/admin/puskesmas/store', [PuskesmasController::class, 'store'])->name('puskesmas.store');
    Route::delete('/destroy/puskesmas/{id}', [PuskesmasController::class, 'destroy'])->name('puskesmas.destroy');
    Route::get('/admin/puskesmas/{id}/edit', [PuskesmasController::class, 'edit'])->name('puskesmas.edit');
    Route::put('/admin/puskesmas/{id}', [PuskesmasController::class, 'update'])->name('puskesmas.update');
});
// System Administrator Routes ------------------------------------------------------
Route::middleware(['role:System Administrator'])->group(function (){
    Route::get('/layout', function () {
        return view('components.layout');
    });
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Users Management
    Route::get('/admin/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/admin/users/{id}', [UserController::class, 'detail_view'])->name('users.detail_view');
    Route::post('/admin/update/email', [UserController::class, 'update_email'])->name('user.update_email');

    // Penduduk Management
    Route::get('/admin/penduduk', [PersonsController::class, 'index'])->name('persons.index');
    Route::get('/admin/penduduk/lansia', [PersonsController::class, 'index_lansia'])->name('persons.index_lansia');
    Route::get('/admin/penduduk/pra-lansia', [PersonsController::class, 'index_pra_lansia'])->name('persons.index_pra_lansia');

    // Route::post('/admin/penduduk/store', [PersonsController::class, 'store'])->name('persons.store');
    Route::get('/admin/penduduk/{id}', [PersonsController::class, 'detail_view'])->name('persons.detail_view');
    Route::get('/admin/penduduk/edit/{id}', [PersonsController::class, 'edit_view'])->name('persons.edit_view');
    Route::post('/admin/penduduk/update/{id}', [PersonsController::class, 'update'])->name('persons.update');

    Route::get('/admin/kunjungan', [KunjungansController::class, 'index'])->name('kunjungans.index');
    Route::post('/admin/kunjungan/tambah', [KunjungansController::class, 'create_view'])->name('kunjungans.create.admin');
    Route::get('/admin/kunjungan/tambah', [KunjungansController::class, 'create_view'])->name('kunjungans.create.admin');
    Route::post('/admin/kunjungan/store', [KunjungansController::class, 'store'])->name('kunjungans.store');
    Route::get('/admin/kunjungan/{id}', [KunjungansController::class, 'detail_view'])->name('kunjungans.detail_view');
    Route::get('/admin/kunjungan/edit/{id}', [KunjungansController::class, 'edit'])->name('kunjungans.edit');
    Route::post('/admin/kunjungan/update/{id}', [KunjungansController::class, 'update'])->name('kunjungans.update');
    
    
    Route::get('/admin/laporan/puskesmas', [LaporansController::class, 'index'])->name('laporan.index');
    Route::get('/admin/laporan/agregat', [LaporansController::class, 'agregat'])->name('laporan.agregat');

    Route::get('/admin/puskesmas', [PuskesmasController::class, 'index'])->name('puskesmas.index');

    Route::get('/admin/whatsapp', [WhatsappController::class, 'index'])->name('whatsapp.index');
    Route::post('/admin/whatsapp/test', [WhatsappController::class, 'WhatsappTestMessages'])->name('whatsapp.test');


    
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
    // Route::delete('/destroy/penduduk/{id}', [PersonsController::class, 'destroy'])->name('persons.destroy');
    Route::get('/dinkes/penduduk/{id}', [PersonsController::class, 'detail_view'])->name('persons.detail_view');
    Route::get('/dinkes/penduduk/edit/{id}', [PersonsController::class, 'edit_view'])->name('persons.edit_view');

    Route::get('/dinkes/puskesmas', [PuskesmasController::class, 'index'])->name('puskesmas.index');
    
    Route::get('/dinkes/laporan/puskesmas', [LaporansController::class, 'index'])->name('dinkes.laporan.index');

    Route::get('/dinkes/kunjungan', [KunjungansController::class, 'index'])->name('kunjungans.index');
    Route::get('/dinkes/kunjungan/{id}', [KunjungansController::class, 'detail_view'])->name('kunjungans.detail_view');


});

// Puskesmas Routes ------------------------------------------------------
Route::middleware(['role:Puskesmas'])->group(function (){
    
    Route::get('/puskesmas/dashboard', function () {
        return view('puskesmas.dashboard');
    })->middleware(['auth', 'verified'])->name('puskesmas.dashboard');
    Route::get('/puskesmas/users', [UserController::class, 'index_puskesmas'])->name('users.index_puskesmas');
    Route::get('/puskesmas/users/{id}', [UserController::class, 'detail_view_puskesmas'])->name('users.detail_view_puskesmas');
    Route::get('/puskesmas/penduduk', [PersonsController::class, 'index'])->name('persons.index');
    Route::get('/puskesmas/penduduk/lansia', [PersonsController::class, 'index_lansia'])->name('persons.index_lansia');
    Route::get('/puskesmas/penduduk/pra-lansia', [PersonsController::class, 'index_pra_lansia'])->name('persons.index_pra_lansia');
    Route::get('/puskesmas/penduduk/{id}', [PersonsController::class, 'detail_view'])->name('persons.detail_view');

    Route::get('/puskesmas/kunjungan', [KunjungansController::class, 'index'])->name('kunjungans.index');
    Route::post('/puskesmas/kunjungan/tambah', [KunjungansController::class, 'create_view'])->name('kunjungans.create.puskesmas');
    Route::get('/puskesmas/kunjungan/tambah', [KunjungansController::class, 'create_view'])->name('kunjungans.create.puskesmas');
    Route::get('/puskesmas/kunjungan/{id}', [KunjungansController::class, 'detail_view'])->name('kunjungans.detail_view');
    Route::post('/puskesmas/kunjungan/store', [KunjungansController::class, 'store'])->name('kunjungans.store');

    Route::get('/puskesmas/laporan/', [LaporansController::class, 'index'])->name('puskesmas.laporan.index');


});

// Kader Routes ------------------------------------------------------
Route::middleware(['role:Kader'])->group(function (){
    
    Route::get('/kader/dashboard', function () {
        return view('kader.dashboard');
    })->middleware(['auth', 'verified'])->name('kader.dashboard');

    Route::get('/kader/penduduk', [PersonsController::class, 'index'])->name('persons.index');
    Route::get('/kader/penduduk/lansia', [PersonsController::class, 'index_lansia'])->name('persons.index_lansia');
    Route::get('/kader/penduduk/pra-lansia', [PersonsController::class, 'index_pra_lansia'])->name('persons.index_pra_lansia');
    Route::get('/kader/penduduk/{id}', [PersonsController::class, 'detail_view'])->name('persons.detail_view');

    Route::get('/kader/kunjungan', [KunjungansController::class, 'index'])->name('kunjungans.index');
    Route::post('/kader/kunjungan/tambah', [KunjungansController::class, 'create_view'])->name('kunjungans.create.kader');
    Route::get('/kader/kunjungan/tambah', [KunjungansController::class, 'create_view'])->name('kunjungans.create.kader');
    Route::get('/kader/kunjungan/{id}', [KunjungansController::class, 'detail_view'])->name('kunjungans.detail_view');
    Route::post('/kader/kunjungan/store', [KunjungansController::class, 'store'])->name('kunjungans.store');
    
});

require __DIR__.'/auth.php';
