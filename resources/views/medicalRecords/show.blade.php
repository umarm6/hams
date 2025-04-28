@extends('layouts.app')

@section('content')
    <div class="w-1/3 mx-auto p-4">
        <h2 class="text-2xl font-bold mb-4">Medical Record Details</h2>

        <div class="bg-white shadow rounded p-4 space-y-4">
            <div>
                <strong class="block text-gray-700">Patient:</strong>
                <p>{{ $medicalRecord->patients->full_name }}</p>
            </div>

            <div>
                <strong class="block text-gray-700">Doctor:</strong>
                <p>{{ $medicalRecord->doctor->full_name }}</p>
            </div>

            <div>
                <strong class="block text-gray-700">Diagnosis:</strong>
                <p>{{ $medicalRecord->diagnosis }}</p>
            </div>

            <div>
                <strong class="block text-gray-700">Notes:</strong>
                <p>{{ $medicalRecord->notes }}</p>
            </div>

            <div>
                <strong class="block text-gray-700">Date:</strong>
                <p>{{ $medicalRecord->record_date }}</p>
            </div>
        </div>

        <div class="mt-6">
            <a href="{{ route('medical-records.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Back to List</a>
        </div>
    </div>
@endsection
