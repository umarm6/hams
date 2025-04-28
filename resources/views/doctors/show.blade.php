@extends('layouts.app')

@section('content')
    <div class="w-1/2 mx-auto p-4">
        <h2 class="text-2xl font-bold mb-4 text-center">Medical Record Details</h2>

        <div class="bg-white shadow rounded p-4 space-y-4">
            <div>
                <strong class="block text-gray-700">Patient:</strong>
                <p class="text-gray-600">{{ $prescription->full_name }}</p>
            </div>

            <div>
                <strong class="block text-gray-700">Doctor:</strong>
                <p class="text-gray-600">{{ $prescription->doctor->full_name }}</p>
            </div>

            <div>
            <strong class="block text-gray-700">Medication</strong>
                <p class="text-gray-600">{{ $prescription->medication_name }}</p>
            </div>

            <div>
            <strong class="block text-gray-700">Dosage</strong>
                <p class="text-gray-600">{{ $prescription->dosage}}</p>
            </div>

            <div>
                <strong class="block text-gray-700">Frequency:</strong>
                <p class="text-gray-600">{{ $prescription->frequency }}</p>
            </div>
            <div>
                <strong class="block text-gray-700">Date:</strong>
                <p class="text-gray-600">{{ $prescription->prescribed_date }}</p>
            </div>

            <div>
                <strong class="block text-gray-700">Notes:</strong>
                <p class="text-gray-600">{{ $prescription->notes }}</p>
            </div>

        </div>

        <div class="mt-6">
            <a href="{{ route('doctors.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Back to List</a>
        </div>
    </div>
@endsection
