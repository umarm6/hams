@php
use Carbon\Carbon;
@endphp

<table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
    <thead class="text-xs text-gray-700 uppercase bg-gray-200 h-16 dark:bg-gray-700 dark:text-gray-400">
     <tr>
        @foreach($headings as $heading)
            <th scope="col" class="px-6 py-3">
                {{$heading}}
            </th>
        @endforeach

    </tr>
     </thead>
    <tbody>
        @foreach($listData as $data)
         <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
            <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                <div class="ps-3">
                    <div class="text-base font-semibold">{{$data['id']}}</div>
                 </div>
            </th>
             <td class="px-6 py-4">
                 <div class="ps-3">
                    <div class=" text-black font-semibold">{{$data['first_name'] }} {{$data['last_name']}}</div>
                 </div>
            </td>
            <td class="px-6 py-4">
                {{$data['doctor_id']}}
            </td>
            <td class="px-6 py-4">
                <div class="flex items-center text-black">
                     {{Carbon::parse($data['appointment_date'])->format('Y-m-d')}}

                </div>
            </td>

            <td class="px-6 py-4">
                <div class="flex items-center text-black">
                     {{Carbon::parse($data['appointment_time'])->format('H:i:a')}}
                </div>
            </td>
            <td class="px-6 py-4">
                <div class="flex items-center text-black">
                    <div class=" w-3 h-3 rounded-full mr-1   {{strtolower($data['status'])}}-bg"></div>
                    {{strtolower($data['status'])}}

                </div>
            </td>
            <td class="px-6 py-4">
                @if($data['patient_id'] === Auth::user()->id)
                <a   href="javascript:void(0);" title="Delete" data-id="{{$data['id']}}" data-route="{{route('appointment.destroy',$data['id'])}}" class=" delete-item font-medium text-blue-600 dark:text-blue-500 hover:underline ml-2">
                     <i class="fa-trash fas"> </i>
                </a>
                @endif


                @if(strtolower($data['status']) === 'pending')

                <a href="javascript:void(0);" title="Approve" data-id="{{$data['id']}}" data-route="{{route('appointment.approve',['confirmed',$data['id']])}}" class=" approve-item font-medium text-blue-600 dark:text-blue-500 hover:underline ml-2">
                     <i class=" fa-thumbs-up fas"> </i>
                </a>

                <a href="javascript:void(0);" title="Cancel" data-id="{{$data['id']}}" data-route="{{route('appointment.approve',['cancelled',$data['id']])}}" class=" approve-item font-medium text-blue-600 dark:text-blue-500 hover:underline ml-2">
                     <i class=" fa-ban fas"> </i>
                </a>
                @endif

            </td>

        </tr>

        @endforeach

    </tbody>
</table>

