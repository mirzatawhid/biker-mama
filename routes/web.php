<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HazardReportController;
use App\Http\Controllers\HelpRequestController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware(['auth'])->group(function () {
    // Create & Store
    Route::resource('hazards', HazardReportController::class)->only(['create', 'store', 'index']);
    Route::resource('helps', HelpRequestController::class)->only(['create', 'store', 'index']);

    // MY submissions
    Route::get('hazards/my', [HazardReportController::class, 'myHazards'])->name('hazards.my');
    Route::get('helps/my', [HelpRequestController::class, 'myHelps'])->name('helps.my');

    Route::get('/hazards/map', [HazardReportController::class, 'mapView'])->name('hazards.map');

});



require __DIR__.'/auth.php';
