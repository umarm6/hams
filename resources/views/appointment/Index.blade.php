@extends('layouts.app')
@section('content')

    <div class="bg-gray-100 flex-1 p-6 md:mt-16">

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg w-100">
        <div class="flex items-center justify-between flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 pb-4 bg-white dark:bg-gray-900">
            <div>

            </div>
             <div class="relative">
                 @can('create appointments')
                     <a href="{{route('appointment.create')}}" class="btn-bs-primary  mr-5">Add Appointment
                         <i class="fas fa-calendar-check  ml-2"></i>
                     </a>
                 @endcan
              </div>
        @include('appointment.table-list',[
                'listData'=>$appointments->toArray(),
                "headings"=>[
                    'Appointment Number',
                    'Patient Name',
                    'Doctor',
                    'Appointment Date',
                    'Appointment Time ',
                    'Status',
                    'Action',
          ]])


        </div>
    </div>
    </div>

@endsection
