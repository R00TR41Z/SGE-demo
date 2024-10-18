<?php

use App\Http\Controllers\ProfileController;
use App\Livewire\Dashboard;
use App\Livewire\Enrollments;
use App\Livewire\MonthlyFees;
use App\Livewire\Students;
use App\Livewire\Stundents\Dashboard as StundentsDashboard;
use App\Livewire\Stundents\Home;
use App\Livewire\Transactions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', Dashboard::class)->name('dashboard');

    Route::get('/students', Students::class)->name('students');
    Route::get('/enrollments', Enrollments::class)->name('enrollments');
    Route::get('monthlyfees', MonthlyFees::class)->name('monthlyfees');
    Route::get('transactions', Transactions::class)->name('transactions');
});

// Student area routes
Route::get('/students/home', Home::class)->middleware('studentGuest')->name('students.home');

Route::middleware('auth:student')->group(function () {

    Route::get('/students/dashboard', StundentsDashboard::class)->name('students.dashboard');

    Route::get('/students/logout', function () {

        Auth::guard('student')->logout();

        return redirect(route('students.home'));
    })->name('students.logout');
});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
