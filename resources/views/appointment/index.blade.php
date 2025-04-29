@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto p-4 mt-10">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold">Appointments</h2>
            <a href="{{ route('appointment.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">+ Add New</a>
        </div>

        <div class="overflow-x-auto bg-white shadow rounded-lg">
            <table class="min-w-full text-left border">
                <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2 border">ID</th>
                    <th class="px-4 py-2 border">Patient</th>
                    <th class="px-4 py-2 border">Doctor</th>
                     <th class="px-4 py-2 border">Mobile</th>
                     <th class="px-4 py-2 border">Appointment Date</th>
                     <th class="px-4 py-2 border">Appointment Time</th>
                     <th class="px-4 py-2 border">Status</th>
                    <th class="px-4 py-2 border">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($appointments as $record)
                     <tr class="border-t">
                        <td class="px-4 py-2">{{ $record->id }}</td>
                        <td class="px-4 py-2">{{ $record->first_name }} {{$record->last_name  }}</td>
                        <td class="px-4 py-2">{{ $record->doctor->full_name  }}</td>
                     <td class="px-4 py-2">{{ $record->mobile }}</td>
                         <td class="px-4 py-2">{{ $record->appointment_date->format('Y-m-d')}}</td>
                         <td class="px-4 py-2">{{ $record->appointment_time->format('H:i')}}</td>
                         <td class="px-4 py-2">
                             <div class=" w-3 h-3 rounded-full mr-1   {{strtolower($record->status) ?? null}}-bg"></div>
                         </td>
                         <td class="px-4 py-2 space-x-2">



                             @if(strtolower($record->status) === 'pending' && Auth::user()->can('approveOrCancel appointments'))

                                 <a href="javascript:void(0);" title="Approve" data-id="{{$record->id}}" data-route="{{route('appointment.approve',['confirmed',$record->id])}}" class=" approve-item font-medium text-blue-600 dark:text-blue-500 hover:underline ml-2">
                                     <i class=" fa-thumbs-up fas"> </i>
                                 </a>

                                 <a href="javascript:void(0);" title="Cancel" data-id="{{$record->id}}" data-route="{{route('appointment.approve',['cancelled',$record->id])}}" class=" approve-item font-medium text-blue-600 dark:text-blue-500 hover:underline ml-2">
                                     <i class=" fa-ban fas"> </i>
                                 </a>
                             @endif


                             @if($record->status === 'pending' && isset($record->patient_id) && $record->patient_id === Auth::user()->id || Auth::user()->hasRole(\App\Enums\RolesEnum::ADMIN))


                                 <form action="{{ route('appointment.destroy', $record) }}" method="POST" class="inline">
                                        @csrf @method('DELETE')
                                        <button onclick="return confirm('Delete this record?')" class="text-red-600 hover:underline">
                                            <i class="fa-trash fas"> </i>
                                        </button>
                                </form>
                             @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $appointments->links() }}
        </div>
    </div>
@endsection
