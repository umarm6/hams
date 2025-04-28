@extends('layouts.app')

@section('content')
    <div class="w-1/3 mx-auto p-4">
        <h2 class="text-2xl font-bold mb-4 text-center">Add Appointment</h2>

        <form action="{{ route('appointment.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">First name</label>
                <input type="text" id="first_name" value="{{old('first_name')}}" name="first_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="John" required />
            </div>
            <div>
                <label for="last_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Last name</label>
                <input type="text" id="last_name" value="{{old('last_name')}}" name="last_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Doe" required />
            </div>

            <div>
                <label for="mobile" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone number</label>
                <input type="tel"   id="mobile" name="mobile" value="{{old('mobile')}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="123-45-678"   required />
            </div>
            <div class="">
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email address</label>
                <input type="email"  id="email" name="email" value="{{old('email')}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="john.doe@company.com" required />
            </div>
            <div>
                <label for="doctor" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Doctors</label>
                <select   id="doctor" name="doctor"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required >
                    <option value="">Select a Doctor</option>
                    @foreach($doctors as $data)
                        <option value="{{$data->id}}" {{$data->id === intval($selectedDoctor) ? 'selected':null}}>{{$data->full_name}}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date</label>
                <input type="date" value="{{$date}}" value="{{old('date')}}"   id="date" onfocus="this.min=new Date().toISOString().split('T')[0]"  name="date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  required />
            </div>

    <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Create</button>
        </form>
    </div>
@endsection
