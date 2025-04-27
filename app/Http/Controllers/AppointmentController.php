<?php

namespace App\Http\Controllers;

use App\Constants\Specialist;
use App\Enums\RolesEnum;
use App\Models\Appointments;
use App\Models\DoctorInfo;
use App\Models\User;
use Carbon\Carbon;
use Devrabiul\ToastMagic\Facades\ToastMagic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use PHPUnit\Event\Exception;

class AppointmentController extends Controller
{
    //

    public function index(){

        $user = Auth::user();
        $appointments = Appointments::wherePatientId($user?->id)->get()->sortByDesc('created_at'); //default patient role

        if($user->hasRole(RolesEnum::DOCTOR->value)){
            $appointments = Appointments::whereDoctorId($user?->id)->get()->sortByDesc('created_at');
        }

        if($user->hasRole(RolesEnum::ADMIN->value)){
            $appointments = Appointments::all()->sortByDesc('created_at');
        }

        return view('appointment.index',[
        'appointments'=>$appointments
        ]);

    }

    public function create(Request $request,$id = null){

        if (!User::find($id)?->exists()  && $id != null){
            ToastMagic::error('Doctor not found');
            return redirect()->route('dashboard');
        }

        $doctors = User::role(RolesEnum::DOCTOR->value)->get();

        return view('appointment.create',[
            'doctors'=>$doctors,
            'selectedDoctor'=>$id
        ]);
    }

    public function store(Request $request){


        $validator = Validator::make($request->all(),array(
            'doctor' => 'required|exists:users,id',
            'mobile' => 'required',
            'email' => 'required'
        ));

        if($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                ToastMagic::error($error);
            }

            return redirect()->back();
        }


        $doctor = User::whereId($request->doctor)->first();
        $day = Carbon::parse($request->get('date'))->format('l');

        $doctorSchedule = $doctor->doctorSchedules()->where('day','=',$day);
        dump($request->all());

        if(!$doctorSchedule->exists()){
            ToastMagic::error('Doctor is not available on this date');
            return redirect()->back();
        }

        $latestDoctorAppointmentTime = $doctor->doctorAppointments()->get()->sortByDesc('created_at')->pluck('appointment_time')->first();
        $doctorTimeStart = $doctorSchedule->first()->start_time->addMinutes($doctor->doctorInfo->patient_examination)->format('H:i');
        $doctorEndTime = $doctorSchedule->first()->end_time;

        if(!is_null($latestDoctorAppointmentTime)){

             $doctorTimeStart = $latestDoctorAppointmentTime->addMinutes($doctor->doctorInfo->patient_examination)->format('H:i');

        }

        if (!Carbon::parse($doctorTimeStart)->lessThan($doctorEndTime)){
            ToastMagic::error('Doctor appointment time slots are booked');
        }

        try {

             Appointments::create([
                'first_name'=>$request?->first_name,
                'last_name'=>$request?->last_name,
                'email'=>$request?->email,
                'mobile'=>$request?->mobile,
                'appointment_date'=>$request?->date,
                'appointment_time'=>$doctorTimeStart,
                'doctor_id'=>$doctor->id,
                'patient_id'=>Auth::user()->id,
             ]);


        }catch (Exception $exception){
            Log::info($exception->getMessage());
            ToastMagic::error($exception->getMessage());

            return redirect()->back();

         }
        ToastMagic::success('Appointment created successfully');

        return redirect()->route('appointment.index');
    }

    public function destroy($id){

        if (Appointments::find($id)){
            Appointments::destroy($id);
            ToastMagic::success('Appointment deleted successfully');
            return redirect()->back();
        }

        ToastMagic::error('Appointment could not deleted');
        return redirect()->back();

    }


        public function approveOrCancel($status, $id){

        if (Appointments::find($id)){
            Appointments::whereId($id)->update([
                'status'=>$status
            ]);
            ToastMagic::success("Appointment $status successfully");
            return redirect()->back();
        }

        ToastMagic::error("Appointment could not $status");
        return redirect()->back();

    }

}
