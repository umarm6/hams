@extends('layouts.app')
@section('content')



    <div class="bg-gray-100 flex-1 p-6 md:mt-16">

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg w-100">
            <div class="flex items-center justify-between flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 pb-4 bg-white dark:bg-gray-900">
                <div>

                </div>
                <div class="relative">
                    @can('create doctor')
                        <a href="{{route('doctors.index')}}" class="btn-bs-primary  mr-5">Doctors
                         </a>
                    @endcan
                </div>
                <div class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">

                    <form class="p-5" method="POST" action="{{route('doctors.update',$user->id)}}">
                        @method('PATCH')
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                          <div class="grid gap-6 mb-6 grid-cols-2">
                            <div>
                                <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">First name</label>
                                <input type="text" value="{{$user->first_name}}" id="first_name" name="first_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="John" required />
                            </div>
                            <div>
                                <label for="last_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Last name</label>
                                <input type="text" value="{{$user->last_name}}" id="last_name" name="last_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Doe" required />
                            </div>

                            <div>
                                <label for="mobile" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone number</label>
                                <input type="tel" value="{{$user->mobile}}" id="mobile" name="mobile" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="123-45-678"   required />
                            </div>

                            <div>
                                <label for="dob" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Data of month</label>
                                <input type="date" value="{{$user->date_of_birth}}" id="dob" name="dob" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" required />
                            </div>
                            <div>
                                <label for="gender" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Gender</label>
                                <select   id="gender" name="gender"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required >
                                    <option value="">Select a Gender</option>
                                    <option value="male" selected="{{$user->gender === 'male'}}">Male</option>
                                    <option value="female" selected="{{$user->gender === 'female'}}">Female</option>
                                </select>
                            </div>
                            <div>
                                 <label for="fee" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Doctor Fee</label>
                                <input type="number" value="{{$user?->doctorInfo->doctor_fee}}" id="fee" name="fee" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" required />
                            </div>
                              <div>
                                  <label for="fee" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"> Patient Examination</label>
                                  <input type="number" value="{{$user?->doctorInfo->patient_examination}}" id="patient_examination" name="patient_examination" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" required />
                              </div>
                            <div>
                                <label for="specialist" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Specialist</label>
                                <select   id="specialist" name="specialist"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required >
                                    <option value="">Select a Specialist</option>
                                   @foreach($specialist as $data)

                                        <option value="{{$data}}" selected="{{$user?->doctorInfo->specialist === $data}}">{{$data}}</option>
                                   @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description </label>
                                <textarea   id="description" name="description"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required >{{$user?->doctorInfo->description}}</textarea>
                            </div>
                        </div>
                        <div class="mb-6">
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email address</label>
                            <input type="email" value="{{$user?->email}}" id="email" name="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="john.doe@company.com" required />
                        </div>
                        <div class="mb-6">
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                            <input type="password" id="password" name="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="•••••••••"  />
                        </div>

                        <hr/>


                        <div>


                        <h2 class="text-black my-3">Doctor availability </h2>
                          <div class="grid gap-2 mb-6 grid-cols-3 mt-3`">
                            <div class="grid gap-2 mb-6 grid-cols-3 mt-3 mr-10">
                                 <div>
                                    <label for="day" class="mt-10 flex  mb-2 text-sm font-medium text-gray-900 dark:text-white"> Monday
                                    <input type="checkbox"  {{in_array('Monday',array_column($doctorSchedules,'day')) ? 'checked' : null}}  value="Monday" id="day" name="day[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block ml-4 p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="John"  />
                                    </label>
                                </div>
                                <div>
                                    <label for="start_time" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Start Time</label>
                                     <input type="time" value="{{in_array('Monday',array_column($doctorSchedules,'day')) ? $doctorSchedules[array_search('Monday',array_column($doctorSchedules,'day'))]['start_time'] : null}}" id="start_time"  name="start_time[Monday]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Doe"  />
                                </div>
                                <div>
                                    <label for="end_time" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">End Time</label>
                                    <input type="time"  value="{{in_array('Monday',array_column($doctorSchedules,'day')) ? $doctorSchedules[array_search('Monday',array_column($doctorSchedules,'day'))]['end_time'] : null}}" id="start_time" name="end_time[Monday]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Doe"  />
                                </div>
{{--                                @endforeach--}}
                            </div> <div class="grid gap-2 mb-6 grid-cols-3 mt-3 mr-10 ">
                                <div>
                                    <label for="day" class="mt-10 flex  mb-2 text-sm font-medium text-gray-900 dark:text-white">Tuesday
                                    <input type="checkbox"   {{in_array('Tuesday',array_column($doctorSchedules,'day'))  ? 'checked' : null }}  value="Tuesday" id="day" name="day[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block ml-4 p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="John"  />
                                    </label>
                                </div>
                                <div>
                                    <label for="start_time" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Start Time</label>
                                    <input type="time" value="{{in_array('Tuesday',array_column($doctorSchedules,'day')) ? $doctorSchedules[array_search('Tuesday',array_column($doctorSchedules,'day'))]['start_time'] : null}}" id="start_time" name="start_time[Tuesday]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Doe"  />
                                </div>
                                <div>
                                    <label for="end_time" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">End Time</label>
                                    <input type="time" value="{{in_array('Tuesday',array_column($doctorSchedules,'day')) ? $doctorSchedules[array_search('Tuesday',array_column($doctorSchedules,'day'))]['end_time'] : null}}" id="start_time" name="end_time[Tuesday]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Doe"  />
                                </div>
                            </div>

                               <div class="grid gap-2 mb-6 grid-cols-3 mt-3 mr-10">
                                <div>
                                    <label for="day" class="mt-10 flex  mb-2 text-sm font-medium text-gray-900 dark:text-white">Wednesday
                                    <input type="checkbox" {{in_array('Wednesday',array_column($doctorSchedules,'day')) ?  'checked' : null}}   value="Wednesday" id="day" name="day[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block ml-4 p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="John"  />
                                    </label>
                                </div>
                                <div>
                                    <label for="start_time" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Start Date</label>
                                    <input type="time" value="{{in_array('Wednesday',array_column($doctorSchedules,'day')) ? $doctorSchedules[array_search('Wednesday',array_column($doctorSchedules,'day'))]['start_time'] : null}}" id="start_time" name="start_time[Wednesday]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Doe"  />
                                </div>
                                <div>
                                    <label for="end_time" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">End Date</label>
                                    <input type="time" value="{{in_array('Wednesday',array_column($doctorSchedules,'day')) ? $doctorSchedules[array_search('Wednesday',array_column($doctorSchedules,'day'))]['end_time'] : null}}" id="start_time" name="end_time[Wednesday]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Doe"  />
                                </div>
                            </div>
                        </div>
                        <div class="grid gap-2 mb-6 grid-cols-3 mt-3`">

                            <div class="grid gap-3 mb-6 grid-cols-3 mt-3  mr-10 ">
                                <div>
                                    <label for="day" class="mt-10 flex  mb-2 text-sm font-medium text-gray-900 dark:text-white">Thursday
                                    <input type="checkbox" {{in_array('Thursday',array_column($doctorSchedules,'day')) ?  'checked' : null }}  value="Thursday" id="day" name="day[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block ml-4 p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"    />
                                    </label>
                                </div>
                                <div>
                                    <label for="start_time" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Start Date</label>
                                    <input type="time" value="{{in_array('Thursday',array_column($doctorSchedules,'day')) ? $doctorSchedules[array_search('Thursday',array_column($doctorSchedules,'day'))]['start_time'] : null}}" id="start_time" name="start_time[Thursday]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"    />
                                </div>
                                <div>
                                    <label for="end_time" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">End Time</label>
                                    <input type="time" value="{{in_array('Thursday',array_column($doctorSchedules,'day')) ? $doctorSchedules[array_search('Thursday',array_column($doctorSchedules,'day'))]['end_time'] : null}}" id="start_time" name="end_time[Thursday]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"    />
                                </div>
                            </div>

                            <div class="grid gap-2 mb-6 grid-cols-3 mt-3  mr-10 ">
                                <div>
                                    <label for="day" class="mt-10 flex  mb-2 text-sm font-medium text-gray-900 dark:text-white">Friday
                                     <input type="checkbox"  {{in_array('Friday',array_column($doctorSchedules,'day')) ? 'checked' : null}}  value="Friday" id="day" name="day[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block ml-4 p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"    />
                                    </label>
                                </div>
                                <div>
                                    <label for="start_time" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Start Date</label>
                                    <input type="time" value="{{in_array('Friday',array_column($doctorSchedules,'day')) ? $doctorSchedules[array_search('Friday',array_column($doctorSchedules,'day'))]['start_time'] : null}}"  id="start_time" name="start_time[Friday]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"    />
                                </div>
                                <div>
                                    <label for="end_time" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">End Time</label>
                                    <input type="time" value="{{in_array('Friday',array_column($doctorSchedules,'day')) ? $doctorSchedules[array_search('Friday',array_column($doctorSchedules,'day'))]['end_time'] : null}}"  id="start_time" name="end_time[Friday]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"    />
                                </div>
                            </div>
                            <div class="grid gap-2 mb-6 grid-cols-3 mt-3  mr-10 ">
                                <div>
                                    <label for="day" class="mt-10 flex  mb-2 text-sm font-medium text-gray-900 dark:text-white">Saturday
                                    <input type="checkbox" {{in_array('Saturday',array_column($doctorSchedules,'day')) ?  'checked' : null}}   value="Saturday" id="day" name="day[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block ml-4 p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"    />
                                    </label>
                                </div>
                                <div>
                                    <label for="start_time" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Start Date</label>
                                    <input type="time" value="{{in_array('Saturday',array_column($doctorSchedules,'day')) ? $doctorSchedules[array_search('Saturday',array_column($doctorSchedules,'day'))]['start_time'] : null}}" id="start_time" name="start_time[Saturday]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"    />
                                </div>
                                <div>
                                    <label for="end_time" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">End Time</label>
                                    <input type="time" value="{{in_array('Saturday',array_column($doctorSchedules,'day')) ? $doctorSchedules[array_search('Saturday',array_column($doctorSchedules,'day'))]['end_time'] : null}}" id="start_time" name="end_time[Saturday]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"    />
                                </div>
                            </div>

                            <div class="grid gap-2 mb-6 grid-cols-3 mt-3  mr-10 ">
                                <div>
                                    <label for="day" class="mt-10 flex  mb-2 text-sm font-medium text-gray-900 dark:text-white">Sunday
                                    <input type="checkbox"  {{in_array('Sunday',array_column($doctorSchedules,'day') ) ?  'checked' : null}} value="Sunday" id="day" name="day[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block ml-4 p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"   />
                                    </label>
                                </div>
                                <div>
                                    <label for="start_time" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Start Time</label>
                                    <input type="time" value="{{in_array('Sunday',array_column($doctorSchedules,'day')) ? $doctorSchedules[array_search('Sunday',array_column($doctorSchedules,'day'))]['start_time'] : null}}" id="start_time" name="start_time[Sunday]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"   />
                                </div>
                                <div>
                                    <label for="end_time" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">End Time</label>
                                    <input type="time" value="{{in_array('Sunday',array_column($doctorSchedules,'day')) ? $doctorSchedules[array_search('Sunday',array_column($doctorSchedules,'day'))]['end_time'] : null}}" id="start_time" name="end_time[Sunday]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"   />
                                </div>
                            </div>
                            </div>
                        </div>

                        <button type="submit" class="text-white mt-5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm   sm:w-auto px-5 py-3 w-32 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Update</button>


                    </form>

                </div>



            </div>
        </div>
    </div>

@endsection
