<?php

namespace App\Http\Controllers;

use App\Constants\Specialist;
use App\Enums\RolesEnum;
use App\Models\DoctorInfo;
use App\Models\DoctorSchedules;
use App\Models\User;
use Carbon\Carbon;
use Devrabiul\ToastMagic\Facades\ToastMagic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use PHPUnit\Event\Exception;

class DoctorsController extends Controller
{
    //

    public function index(){

        $doctors = User::role(RolesEnum::DOCTOR->value)->with('doctorInfo')->latest()->orderBy('id','desc')->paginate(10); // Returns only users with the role 'writer'
        return view('doctors.index',[
            'doctors'=>$doctors
        ]);
    }

    public function create(){
        $specialist = Specialist::data(); // Returns only users with the role 'writer'
        return view('doctors.create',[
            'specialist'=>$specialist
        ]);
    }

    public function search(Request $request){

        $request->validate([
            'doctor' =>'required|exists:users,id',
            'date' =>'required',
        ]);

        $day = Carbon::parse($request->get('date'))->format('l');
        $doctors = User::find($request->get('doctor'))->doctorSchedules()->where('day','=',$day)->exists();

         if($doctors){
             return redirect()->route('appointment.create',[$request->get('doctor'),$request->get('date')]);
        }

         return redirect()->back()->withErrors('Doctor not available on this day');

    }


    public function store(Request $request){

        $validator = Validator::make($request->all(),array(
            'email' => 'required|email|unique:users,email',
            'password' => 'required'
        ));

        if($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                ToastMagic::error($error);
            }

            return redirect()->back();
         }


        try {

            //creating user and assignnig role
            $user = User::firstOrCreate([
                'first_name'=>$request?->first_name,
                'last_name'=>$request?->last_name,
                'email'=>$request?->email,
                'mobile'=>$request?->mobile,
                'date_of_birth'=>$request?->dob,
                'gender'=>$request?->gender,
                'password'=>Hash::make($request?->password),
            ])->assignRole(RolesEnum::DOCTOR->value);


            DoctorInfo::create([
                'user_id'=>$user->id,
                'doctor_fee'=>$request?->fee,
                'patient_examination'=>$request?->patient_examination,
                'specialist'=>$request?->specialist,
                'description'=>$request?->description
            ]);

            $days = $request->get('day');
            if (count($days) > 1){

                foreach ($days as $day) {
                    $startTime = $request->get('start_time')[$day];
                    $endTime = $request->get('end_time')[$day];
                    if (isset($startTime) && isset($endTime)) {

                        DoctorSchedules::create([
                            'doctor_id'=>$user->id,
                            'day'=>$day,
                            'start_time'=>$startTime,
                            'end_time'=>$endTime,
                        ]);
                    }
                }
            }


        }catch (Exception $exception){
            Log::info($exception->getMessage());
            ToastMagic::error($exception->getMessage());

            return redirect()->route('doctors.index');

         }
        ToastMagic::success('Doctor created successfully');

        return redirect()->route('doctors.index');
    }

    public function edit($id){
        $specialist = Specialist::data(); // Returns only users with the role 'writer'
        $user = User::whereId($id)->with(['doctorInfo'])->role(RolesEnum::DOCTOR->value)->firstOrFail();
          return view('doctors.edit',
            [
            'user'=>$user,
            'specialist'=>$specialist,
            'doctorSchedules'=>$user->doctorSchedules()->get()->toArray()
        ]);
    }

    public function update(Request $request,$id){

        $validator = Validator::make($request->all(),array(
            'email' => 'required|email|',
        ));


        if($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                ToastMagic::error($error);
            }

            return redirect()->back();
        }


        try {

            $user = User::findOrFail($id);

            $password = is_null($request->password) ? $user->password : str($request->password);

            $user->update([
                'first_name'=>$request?->first_name,
                'last_name'=>$request?->last_name,
                'email'=>$request?->email,
                'mobile'=>$request?->mobile,
                'date_of_birth'=>$request?->dob,
                'gender'=>$request?->gender,
                'password'=>$password,
            ]);


            $user?->doctorInfo->update([
                'user_id'=>$user->id,
                'doctor_fee'=>$request?->fee,
                'patient_examination'=>$request?->patient_examination,
                'specialist'=>$request?->specialist,
                'description'=>$request?->description
            ]);


            //creating doctor availability schedule
            $days = $request->get('day');


            if (count($days) > 1){

                foreach ($days as $day) {
                    $startTime = $request->get('start_time')[$day];
                    $endTime = $request->get('end_time')[$day];
                    if (isset($startTime) && isset($endTime)) {

                        DoctorSchedules::updateOrCreate(
                            ['doctor_id' => $id, 'day' => $day],
                            [
                                'doctor_id'=>$id,
                                'day'=>$day,
                                'start_time'=>$startTime,
                                'end_time'=>$endTime,
                        ]);
                    }
                }
            }

        }catch (Exception $exception){
            Log::info($exception->getMessage());
            ToastMagic::error($exception->getMessage());

            return redirect()->back();

        }
        ToastMagic::success('Doctor updated successfully');

        return redirect()->back();
    }
    public function destroy($id){

        if (User::find($id)){
            User::destroy($id);
            DoctorInfo::destroy($id);
            ToastMagic::success('Doctor deleted successfully');
            return redirect()->back();
        }

        ToastMagic::error('Doctor could not deleted');


    }

}
