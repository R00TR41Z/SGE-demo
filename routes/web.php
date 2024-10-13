<?php

use App\Http\Controllers\ProfileController;
use App\Livewire\Dashboard;
use App\Livewire\Enrollments;
use App\Livewire\MonthlyFees;
use App\Livewire\Students;
use App\Livewire\Transactions;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function(){
    
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    
    Route::get('/students', Students::class)->name('students');
    Route::get('/enrollments', Enrollments::class)->name('enrollments');
    Route::get('monthlyfees', MonthlyFees::class)->name('monthlyfees');
    Route::get('transactions', Transactions::class)->name('transactions');

});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
