<?php
namespace App\Http\Controllers;

use App\Enums\RolesEnum;
use App\Models\Appointments;
use App\Models\MedicalRecord;
use App\Models\User;
use Auth;
use Devrabiul\ToastMagic\Facades\ToastMagic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MedicalRecordsController extends Controller
{
    public function index()
    {

        $records = MedicalRecord::wherePatientId(Auth::user()->id)->with([RolesEnum::PATIENTS->value, RolesEnum::DOCTOR->value])->orderBy('id','desc')->latest()->paginate(10);

        if(Auth::user()->hasRole(RolesEnum::DOCTOR->value)){
             $records = MedicalRecord::whereDoctorId(Auth::user()->id)->with([RolesEnum::PATIENTS->value, RolesEnum::DOCTOR->value])->orderBy('id','desc')->latest()->paginate(10);
        }

        if(Auth::user()->hasRole(RolesEnum::ADMIN->value)){

            $records = MedicalRecord::with([RolesEnum::PATIENTS->value, RolesEnum::DOCTOR->value])->orderBy('id','desc')->latest()->paginate(10);
        }


       return view('medicalRecords.index', compact('records'));
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

         return view('medicalRecords.create', compact('patients', 'doctors'));
    }

    public function store(Request $request)
    {


        $validator = Validator::make($request->all(),[
            'patient_id' => 'required|exists:users,id',
            'doctor_id' => 'required|exists:users,id',
            'diagnosis' => 'required|string',
            'notes'     => 'nullable|string',
            'record_date' => 'required|date',
        ]);

        if($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                ToastMagic::error($error);
            }

            return redirect()->route('medical-records.index');
        }



        try {
            MedicalRecord::create($request->all());

            ToastMagic::success('Medical record created.');

        }catch (\Exception $e){
            ToastMagic::error('Medical record create failed');
            \Log::error($e->getMessage());

        }
        return redirect()->route('medical-records.index');

    }

    public function show(MedicalRecord $medicalRecord)
    {
        return view('medicalRecords.show', compact('medicalRecord'));
    }

    public function edit(MedicalRecord $medicalRecord)
    {
        $patients = User::all();
        $doctors = User::role(RolesEnum::DOCTOR->value)->get();
        return view('medicalRecords.edit', compact('medicalRecord', 'patients', 'doctors'));
    }

    public function update(Request $request, MedicalRecord $medicalRecord)
    {

        $validator = Validator::make($request->all(),[
            'patient_id' => 'required|exists:users,id',
            'doctor_id' => 'required|exists:users,id',
            'diagnosis' => 'required|string',
            'notes'     => 'nullable|string',
            'record_date' => 'required|date',
        ]);


        if($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                ToastMagic::error($error);
            }

            return redirect()->route('medical-records.index');
        }

         try {

            $medicalRecord->update($request->all());
            ToastMagic::success('Medical record updated.');

        }catch (\Exception $e){
            ToastMagic::error('Medical record update failed');
            \Log::error($e->getMessage());

        }
        return redirect()->route('medical-records.index');

    }

    public function destroy(MedicalRecord $medicalRecord)
    {
        $medicalRecord->delete();
        ToastMagic::success('Medical record deleted.');
        return redirect()->route('medical-records.index')->with('success', 'Medical record deleted.');
    }
}
