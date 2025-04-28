@extends('layouts.app')
@section('content')



    <div class="bg-gray-100 flex-1 p-6 md:mt-16">

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg w-100">
            <div class="flex items-center justify-between flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 pb-4 bg-white dark:bg-gray-900">
                <div>

                </div>
                <div class="relative">
                    @can('create appointments')
                        <a href="{{route('appointment.index')}}" class="btn-bs-primary  mr-5">Appointments
                         </a>
                    @endcan
                </div>
                <div class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">

                    <form class="p-5" method="POST" action="{{route('appointment.store')}}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                          <div class="grid gap-6 mb-6 grid-cols-2">
                            <div>
                                <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">First name</label>
                                <input type="text" id="first_name" name="first_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="John" required />
                            </div>
                            <div>
                                <label for="last_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Last name</label>
                                <input type="text" id="last_name" name="last_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Doe" required />
                            </div>

                            <div>
                                <label for="mobile" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone number</label>
                                <input type="tel"   id="mobile" name="mobile" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="123-45-678"   required />
                            </div>
                              <div class="">
                                  <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email address</label>
                                  <input type="email"  id="email" name="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="john.doe@company.com" required />
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
                                 <input type="date" value="{{$date}}"   id="date" onfocus="this.min=new Date().toISOString().split('T')[0]"  name="date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  required />
                             </div>
                        </div>


                        <button type="submit" class="text-white mt-5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm   sm:w-auto px-5 py-3 w-32 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Create</button>
                    </form>


                </div>



            </div>
        </div>
    </div>

@endsection
