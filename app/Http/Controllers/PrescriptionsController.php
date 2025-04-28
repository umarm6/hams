<?php

namespace App\Http\Controllers;

use App\Enums\RolesEnum;
use App\Models\Appointments;
use App\Models\MedicalRecord;
use App\Models\Prescription;
use App\Models\User;
use Auth;
use Devrabiul\ToastMagic\Facades\ToastMagic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PrescriptionsController extends Controller
{
    public function index()
    {

        $prescriptions = Prescription::wherePatientId(Auth::user()->id)->with([RolesEnum::PATIENTS->value, RolesEnum::DOCTOR->value])->orderBy('id','desc')->latest()->paginate(10);

        if(Auth::user()->hasRole(RolesEnum::DOCTOR->value)){
            $prescriptions = Prescription::whereDoctorId(Auth::user()->id)->with([RolesEnum::PATIENTS->value, RolesEnum::DOCTOR->value])->orderBy('id','desc')->latest()->paginate(10);
        }

        if(Auth::user()->hasRole(RolesEnum::ADMIN->value)){

            $prescriptions = Prescription::with([RolesEnum::PATIENTS->value, RolesEnum::DOCTOR->value])->orderBy('id','desc')->latest()->paginate(10);
        }



        return view('prescriptions.index', compact('prescriptions'));
    }

    public function create()
    {
        $user= Auth::user();
        $patientIds = Appointments::whereDoctorId($user->id)->pluck('patient_id')->toArray();
        $patients = User::whereIn('id', $patientIds)->get();
        $doctors = User::role(RolesEnum::DOCTOR->value)->get();
        if($user->hasRole(RolesEnum::DOCTOR->value)){
            $doctors = User::whereId($user->id)->get();
        }

        return view('prescriptions.create', compact('patients', 'doctors'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'patient_id' => 'required|exists:users,id',
            'doctor_id' => 'required|exists:users,id',
            'medication_name' => 'required|string|max:255',
            'dosage' => 'required|string|max:255',
            'prescribed_date' => 'required|date',
        ]);

        if($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                ToastMagic::error($error);
            }

            return redirect()->route('prescriptions.index');
        }

        try {
            Prescription::create($request->all());
            ToastMagic::success('Prescription added successfully!.');

        }catch (\Exception $e){
            \Log::error($e->getMessage());
            ToastMagic::error('Prescription create failed');

        }
        return redirect()->route('prescriptions.index');

    }

    public function show(Prescription $prescription)
    {
        return view('prescriptions.show', compact('prescription'));
    }

    public function edit(Prescription $prescription)
    {
        $patients = User::role(RolesEnum::PATIENTS->value)->get();
        $doctors = User::role(RolesEnum::DOCTOR->value)->get();

        return view('prescriptions.edit', compact('prescription', 'patients', 'doctors'));
    }

    public function update(Request $request, Prescription $prescription)
    {


        $validator = Validator::make($request->all(),[
            'patient_id' => 'required|exists:users,id',
            'doctor_id' => 'required|exists:users,id',
            'medication_name' => 'required|string|max:255',
            'dosage' => 'required|string|max:255',
            'prescribed_date' => 'required|date',
        ]);

        if($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                ToastMagic::error($error);
            }

            return redirect()->route('prescriptions.index');
        }



        try {
            $prescription->update($request->all());
            ToastMagic::success('Prescription updated successfully!.');

        }catch (\Exception $e){
            \Log::error($e->getMessage());
            ToastMagic::error('Prescription update failed');

        }


        return redirect()->route('prescriptions.index');
     }

    public function destroy(Prescription $prescription)
    {
        $prescription->delete();
        ToastMagic::success('Medical record deleted.');
        return redirect()->route('prescriptions.index');
    }
}
