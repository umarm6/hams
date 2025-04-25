@extends('layouts.app')
@section('content')

    <div class="bg-gray-100 flex-1 p-6 md:mt-16">

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg w-100">
        <div class="flex items-center justify-between flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 pb-4 bg-white dark:bg-gray-900">
            <div>

            </div>
             <div class="relative">
                 @can('create doctor')
                     <a href="{{route('doctors.create')}}" class="btn-bs-primary  mr-5">Add Doctors
                         <i class="fad fa-user-plus  ml-2"></i>
                     </a>
                 @endcan
              </div>
            <x-table-list
                :list-data="$doctors->toArray()"
                :headings="[
                    'Name',
                    'Specialist',
                    'Status',
                    'Gender',
                    'Mobile',
                    'Action',
          ]"
            />


        </div>
    </div>
    </div>

@endsection
