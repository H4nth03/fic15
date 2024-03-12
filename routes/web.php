<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DoctorController;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Rute ini hanya diakses ketika pengguna belum login
// Rute ini hanya diakses ketika pengguna belum login
// Route::middleware(['web'])->group(function () {
//     Route::middleware(['auth'])->group(function () {
//         Route::get('home', function () {
//             return view('home');
//         })->name('home');

//         Route::resource('users', UserController::class);
//         Route::resource('doctors', DoctorController::class);
//     });

//     // Rute ini hanya diakses ketika pengguna belum login
//     Route::middleware(['guest'])->group(function () {
//         Route::get('/', function () {
//             return redirect()->route('home');
//         });

//         Route::view('/login', 'pages.auth.login')->name('login');
//     });
// });






Route::get('/', function () {
    return view('pages.auth.login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('home', function () {
        return view('pages.dashboard');
    })->name('home');

    Route::resource('users', UserController::class);
    //doctors
    Route::resource('doctors', DoctorController::class);


});
// Route::get('/', function () {
//     return view('pages.auth.login');
// });

// Route::middleware(['auth'])->group(function () {
//     Route::get('home', function () {
//         return view('dashboard');
//     })->name('home');

//     Route::resource('users', UserController::class);
//     //doctors
//     Route::resource('doctors', DoctorController::class);


// });
