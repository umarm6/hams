@extends('layouts.app')

@section('content')
    <div class="w-1/2 mx-auto p-4">
        <h2 class="text-2xl font-bold mb-4">Edit Prescription</h2>

        <form action="{{ route('prescriptions.update', $prescription) }}" method="POST" class="space-y-4">
            @csrf @method('PUT')

            <div>
                <label class="block text-sm font-medium">Patient</label>
                <select name="patient_id" class="w-full border-gray-300 rounded p-2">
                    @foreach($patients as $patient)
                        <option value="{{ $patient->id }}" {{ $prescription->patient_id == $patient->id ? 'selected' : '' }}>
                            {{ $patient->full_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="{{ Auth::user()->roles->first()->name === \App\Enums\RolesEnum::DOCTOR->value  ? 'hidden ' : null }}">
                <label class="block text-sm font-medium">Doctor</label>
                <select name="doctor_id" class="w-full border-gray-300 rounded p-2" >
                    @foreach($doctors as $doctor)
                        <option value="{{ $doctor->id }}" {{ $prescription->doctor_id == $doctor->id ? 'selected' : '' }}>
                            {{ $doctor->full_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium">Medication</label>
                <input type="text" name="medication_name" value="{{ $prescription->medication_name }}" class="w-full border-gray-300 rounded p-2" required>
            </div>

            <div>
                <label class="block text-sm font-medium">Dosage</label>
                <input type="text" name="dosage" value="{{ $prescription->dosage }}" class="w-full border-gray-300 rounded p-2" required>
            </div>

            <div>
                <label class="block text-sm font-medium">Frequency</label>
                <input type="text" name="frequency" value="{{ $prescription->frequency }}" class="w-full border-gray-300 rounded p-2" required>
            </div>

            <div>
                <label class="block text-sm font-medium">Notes</label>
                <textarea  name="notes"   class="w-full border-gray-300 rounded p-2" required>{{ $prescription->notes }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-medium">Prescribed Date</label>
                <input type="date" name="prescribed_date" value="{{ $prescription->prescribed_date }}" class="w-full border-gray-300 rounded p-2" required>
            </div>

            <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update</button>
        </form>
    </div>
@endsection
