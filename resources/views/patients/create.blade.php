@extends('layouts.app')

@section('content')
    <div class="w-1/3 mx-auto p-4">
        <h2 class="text-2xl font-bold mb-4 text-center">Add Patient</h2>

        <form action="{{ route('patients.store') }}" method="POST" class="space-y-4">
            @csrf()
            <div>
                <label class="block text-sm font-medium">First Name</label>
                <input type="text" name="first_name"   class="w-full border-gray-300 rounded p-2" required>
            </div>
            <div>
                <label class="block text-sm font-medium">Last Name</label>
                <input type="text" name="last_name"   class="w-full border-gray-300 rounded p-2" required>
            </div>

            <div>
                <label class="block text-sm font-medium">Email</label>
                <input type="text" name="email"   class="w-full border-gray-300 rounded p-2" required>
            </div>

            <div>
                <label class="block text-sm font-medium">Mobile</label>
                <input type="text" name="mobile"   class="w-full border-gray-300 rounded p-2" required>
            </div>

            <div>
                <label class="block text-sm font-medium">Gender</label>
                <select   name="gender"   class="w-full border-gray-300 rounded p-2" required>
                    <option value="">Select a Gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium">Date of Birth</label>
                <input type="date" name="date_of_birth"   class="w-full border-gray-300 rounded p-2" required>
            </div>

            <div>
                <label class="block text-sm font-medium">Password</label>
                <input type="text" name="password"   class="w-full border-gray-300 rounded p-2" required>
            </div>

            <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Create</button>
        </form>
    </div>
@endsection
