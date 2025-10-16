<?php
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

Route::get('/profil/{id}', [ProfileController::class, 'show'])->name('profil.show');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'processRegister'])->name('register.process');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'processLogin'])->name('login.process');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/auth/google', [AuthController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback'])->name('google.callback');

Route::get('/home', function () {
    if (!session()->has('pengguna_id')) {
        return redirect()->route('login');
    }
Route::get('/', function () {
    return redirect()->route('login');
    });
    return view('home', ['username' => session('pengguna_username')]);
})->name('home');

Route::get('/', function () {
    return redirect()->route('login');
});
