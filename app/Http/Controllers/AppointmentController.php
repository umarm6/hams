<?php

namespace App\Http\Controllers;

use App\Constants\Specialist;
use App\Enums\RolesEnum;
use App\Models\DoctorInfo;
use App\Models\User;
use Devrabiul\ToastMagic\Facades\ToastMagic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use PHPUnit\Event\Exception;

class AppointmentController extends Controller
{
    //

    public function index($id){

         $doctor = User::findOrFail($id); // Returns only users with the role 'writer'
         return view('appointment.book',[
            'doctor'=>$doctor
        ]);
    }

    public function create(){
        $specialist = Specialist::data(); // Returns only users with the role 'writer'
        return view('appointment.book',[
            'specialist'=>$specialist
        ]);
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
                'specialist'=>$request?->specialist,
                'description'=>$request?->description
            ]);


        }catch (Exception $exception){
            Log::info($exception->getMessage());
            ToastMagic::error($exception->getMessage());

            return redirect()->back();

         }
        ToastMagic::success('Doctor created successfully');

        return redirect()->back();
    }

    public function edit($id){
        $specialist = Specialist::data(); // Returns only users with the role 'writer'
        $user = User::whereId($id)->with('doctorInfo')->role(RolesEnum::DOCTOR->value)->firstOrFail();

        return view('doctors.edit',
            [
            'user'=>$user,
            'specialist'=>$specialist
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


            $user?->DoctorInfo->update([
                'user_id'=>$user->id,
                'doctor_fee'=>$request?->fee,
                'specialist'=>$request?->specialist,
                'description'=>$request?->description
            ]);


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
