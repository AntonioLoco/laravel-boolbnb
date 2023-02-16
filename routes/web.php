<?php

use App\Http\Controllers\Admin\ApartmentController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\SponsorshipController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    if (Auth::user()) {
        return redirect()->route("admin.dashboard");
    } else {
        return view('auth.login');
    }
});

Route::middleware(['auth', 'verified'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('apartments', ApartmentController::class)->parameters(["apartments" => "apartment:slug"]);
        Route::get("/{apartment}/message", [MessageController::class, "index"])->name('apartment.message');
        Route::get('/{apartment}/sponsorship', [SponsorshipController::class, 'index'])->name('apartment.sponsorship');
    });


require __DIR__ . '/auth.php';
