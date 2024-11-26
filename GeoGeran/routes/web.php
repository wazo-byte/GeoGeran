<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GeoLocationController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});


// Define the dashboard routes for admin and user
Route::middleware(['auth', 'verified'])->group(function () {

    // admin route
    Route::get('/admin/dashboard', [HomeController::class, 'admin_dashboard'])->name('admin.dashboard');
    Route::get('/admin/data', [GeoLocationController::class, 'admin_data_list'])->name('admin.data');
    Route::post('/admin/delete_user', [HomeController::class, 'admin_delete_user'])->name('admin.delete_user');

    // user route
    Route::get('/user/dashboard', [HomeController::class, 'user_dashboard'])->name('user.dashboard');
    Route::get('/user/search', [GeoLocationController::class, 'search_form'])->name('user.search');
    Route::post('/user/search_location', [GeoLocationController::class, 'search_location'])->name('user.search_location');
    Route::post('/user/save_location', [GeoLocationController::class, 'save_location'])->name('user.save_location');
    Route::get('/user/edit_location/{id}', [GeoLocationController::class, 'edit_location'])->name('user.edit_location');
    Route::post('/user/update_location', [GeoLocationController::class, 'update_location'])->name('user.update_location');
    Route::get('/get_district_list', [DistrictController::class, 'get_district_list'])->name('get_district_list');
    Route::get('/get_city_list', [CityController::class, 'get_city_list'])->name('get_city_list');

    // Other routes related to profiles
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';
