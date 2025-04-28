@extends('layouts.app')

@section('content')
    <div class="w-1/2 mx-auto p-4">
        <h2 class="text-2xl font-bold mb-4">Edit Prescription</h2>

        <form action="{{ route('patients.update', $patient) }}" method="POST" class="space-y-4">
            @csrf @method('PUT')

            <div>
                <label class="block text-sm font-medium">First Name</label>
                <input type="text" name="first_name" value="{{ $patient->first_name }}" class="w-full border-gray-300 rounded p-2" required>
            </div>
            <div>
                <label class="block text-sm font-medium">Last Name</label>
                <input type="text" name="last_name" value="{{ $patient->last_name }}" class="w-full border-gray-300 rounded p-2" required>
            </div>

            <div>
                <label class="block text-sm font-medium">Email</label>
                <input type="text" name="email" value="{{ $patient->email }}" class="w-full border-gray-300 rounded p-2" required>
            </div>

            <div>
                <label class="block text-sm font-medium">Mobile</label>
                <input type="text" name="mobile" value="{{ $patient->mobile }}" class="w-full border-gray-300 rounded p-2" required>
            </div>

            <div>
                <label class="block text-sm font-medium">Date of Birth</label>
                <input type="date" name="date_of_birth" value="{{ $patient->date_of_birth }}" class="w-full border-gray-300 rounded p-2" required>
            </div>

             <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update</button>
        </form>
    </div>
@endsection
