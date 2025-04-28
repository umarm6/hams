<?php

namespace App\Http\Controllers;

use App\Enums\RolesEnum;
use App\Models\Prescription;
use App\Models\User;
use Devrabiul\ToastMagic\Facades\ToastMagic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PatientsController extends Controller
{
    public function index()
    {
        $patients = User::role([RolesEnum::PATIENTS->value])->orderBy('id','desc')->latest()->paginate(10);

        return view('patients.index', compact('patients'));
    }

    public function create()
    {
        $patients = User::role(RolesEnum::PATIENTS->value)->get();
        $doctors = User::role(RolesEnum::DOCTOR->value)->get();
        return view('patients.create', compact('patients', 'doctors'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email',
            'mobile' => 'required|numeric',
            'date_of_birth' => 'required|date',
            'password' => 'required',
        ]);

        if($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                ToastMagic::error($error);
            }

            return redirect()->route('patients.index');
        }

        try {
            User::create($request->all())->assignRole(RolesEnum::PATIENTS->value);
            ToastMagic::success('Patient added successfully!.');

        }catch (\Exception $e){
            \Log::error($e->getMessage());
            ToastMagic::error('Patient create failed');

        }
        return redirect()->route('patients.index');

    }

    public function show(User $user)
    {
        return abort(404);
    }

    public function edit(User $patient)
    {
         return view('patients.edit', compact('patient'));
    }

    public function update(Request $request, User $patient)
    {

        $validator = Validator::make($request->all(),[
            'first_name' => 'required',
            'last_name' => 'required',
             'mobile' => 'required|numeric',
            'email' => 'required',
            'date_of_birth' => 'required|date',
        ]);

        if($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                ToastMagic::error($error);
            }

            return redirect()->route('patients.index');
        }


         try {

            $patient->update($request->all());
            ToastMagic::success('Patient updated successfully!.');

        }catch (\Exception $e){
            \Log::error($e->getMessage());
            ToastMagic::error('Patient update failed');

        }


        return redirect()->route('patients.index');
     }

    public function destroy(User $patient)
    {
        $patient->delete();
        ToastMagic::success('Patient record deleted.');
        return redirect()->route('patients.index');
    }
}
