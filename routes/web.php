<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\DoctorsController;

use App\Http\Controllers\MedicalRecordsController;
use App\Http\Controllers\PatientsController;
use App\Http\Controllers\PrescriptionsController;
use App\Models\Appointments;
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


        if (!Auth::user()->can('view dashboard')) {
            return redirect(route('appointment.index'));
        }

        $appointmentsCount = 0;
        $patientsCount = 0;
        $doctorsCount = 0;

        if(Auth::user()->hasRole('doctor')){
            $appointmentsCount = Appointments::where('doctor_id',Auth::user()->id)->count();
            $doctorsCount = 0;
        }

    return view('dashboard',[
        'appointmentsCount' => $appointmentsCount,
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::group(['prefix' => 'dashboard'], function () {
//        Route::get('/doctors', [ DoctorsController::class, 'index'])->can('view doctor')->name('doctors.index');
//        Route::get('/doctors/create', [ DoctorsController::class, 'create'])->can('create doctor')->name('doctors.create');
//        Route::post('/doctors', [ DoctorsController::class, 'store'])->name('doctors.store');
//        Route::get('/doctors/{doctor}', [ DoctorsController::class, 'show'])->can('view doctor')->name('doctors.show');
//        Route::get('/doctors/{doctor}/edit', [ DoctorsController::class, 'edit'])->can('edit doctor')->name('doctors.edit');
//        Route::patch('/doctors/{doctor}', [ DoctorsController::class, 'update'])->name('doctors.update');
//        Route::get('/doctors/{doctor}', [ DoctorsController::class, 'destroy'])->can('delete doctor')->name('doctors.destroy');

        Route::get('/appointments',[AppointmentController::class,'index'])->can('view appointments')->name('appointment.index');
        Route::get('/appointment/{doctorID?}/{date?}',[AppointmentController::class,'create'])->can('create appointments')->name('appointment.create');
        Route::post('/appointment',[AppointmentController::class,'store'])->can('create appointments')->name('appointment.store');
        Route::delete('/appointments/{id}',[AppointmentController::class,'destroy'])->can('delete appointments')->name('appointment.destroy');
        Route::get('/appointments/{approveOrCancel}/{id}',[AppointmentController::class,'approveOrCancel'])->can('approveOrCancel appointments')->name('appointment.approve');

        Route::resource('medical-records', MedicalRecordsController::class);
        Route::resource('prescriptions', PrescriptionsController::class);
        Route::resource('patients',  PatientsController::class);
        Route::resource('doctors',  DoctorsController::class);


    });
});


Route::get('doctor/search',[DoctorsController::class,'search'])->name('doctors.search');
require __DIR__.'/auth.php';
