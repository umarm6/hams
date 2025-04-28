@extends('layouts.app')

@section('content')
    <div class="w-1/3 mx-auto p-4">
        <h2 class="text-2xl font-bold mb-4 text-center">Add Medical Record</h2>

        <form action="{{ route('medical-records.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-medium">Patient</label>
                <select name="patient_id" class="w-full border-gray-300 rounded p-2">
                    @foreach($patients as $patient)
                        <option value="{{ $patient->id }}">{{ $patient->full_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="{{ Auth::user()->roles->first()->name === \App\Enums\RolesEnum::DOCTOR->value  ? 'hidden ' : null }}">
                <label class="block text-sm font-medium">Doctor</label>
                {{Auth::user()->id === 10 && Auth::user()->roles->first()->name === \App\Enums\RolesEnum::DOCTOR->value }}
                <select name="doctor_id" class="w-full border-gray-300 rounded p-2  ">
                    @foreach($doctors as $doctor)
                        <option value="{{ $doctor->id }}"
                        {{Auth::user()->id === $doctor->id && Auth::user()->roles->first()->name === \App\Enums\RolesEnum::DOCTOR->value  ? 'selected ' : null }}
                        >{{ $doctor->full_name}}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium">Diagnosis</label>
                <input type="text" name="diagnosis" class="w-full border-gray-300 rounded p-2" required>
            </div>

            <div>
                <label class="block text-sm font-medium">Notes</label>
                <textarea name="notes" class="w-full border-gray-300 rounded p-2"></textarea>
            </div>

            <div>
                <label class="block text-sm font-medium">Date</label>
                <input type="date" name="record_date" class="w-full border-gray-300 rounded p-2" required>
            </div>

            <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Save</button>
        </form>
    </div>
@endsection
