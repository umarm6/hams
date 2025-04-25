<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\DoctorsController;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {

//    $dayOfWeek = Carbon::parse('2025-04-25')->format('l');
//dd($dayOfWeek);

    $doctors =  User::role('doctor')->get()->toArray();
     return view('welcome',[
         'doctors' => $doctors
     ]);
//        if (Auth::check()){
//            return redirect('/dashboard');
//        }
 })->name('index');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::group(['prefix' => 'dashboard'], function () {
        Route::get('/doctors', [ DoctorsController::class, 'index'])->name('doctors.index');
        Route::get('/doctors/create', [ DoctorsController::class, 'create'])->name('doctors.create');
        Route::post('/doctors', [ DoctorsController::class, 'store'])->name('doctors.store');
        Route::get('/doctors/{doctor}', [ DoctorsController::class, 'show'])->name('doctors.show');
        Route::get('/doctors/{doctor}/edit', [ DoctorsController::class, 'edit'])->name('doctors.edit');
        Route::patch('/doctors/{doctor}', [ DoctorsController::class, 'update'])->name('doctors.update');
        Route::get('/doctors/{doctor}', [ DoctorsController::class, 'destroy'])->name('doctors.destroy');
    });
});


Route::get('appointment/{doctorID}',[AppointmentController::class,'index'])->name('appointment.index');
Route::get('doctor/search',[DoctorsController::class,'search'])->name('doctors.search');
require __DIR__.'/auth.php';
