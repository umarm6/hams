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
                    <div class="text-base font-semibold">{{$data['first_name']}} {{$data['last_name']}}</div>
                    <div class="font-normal text-gray-500">{{$data['email']}}</div>
                </div>
            </th>


            <td class="px-6 py-4">
                {{$data['doctor_info']['specialist'] ?? null}}
            </td>
            <td class="px-6 py-4">
                <div class="flex items-center">
                    <div class="h-2.5 w-2.5 rounded-full bg-green-500 me-2"></div>
                    {{$data['status']}}

                </div>
            </td>

            <td class="px-6 py-4">
                <div class="flex items-center">
                    <div class="h-2.5 w-2.5 rounded-full bg-green-500 me-2"></div>
                    {{$data['gender']}}

                </div>
            </td>
            <td class="px-6 py-4">
                <div class="flex items-center">
                    <div class="h-2.5 w-2.5 rounded-full bg-green-500 me-2"></div>
                    {{$data['mobile']}}

                </div>
            </td>
            <td class="px-6 py-4">
                <a href="{{route('doctors.edit',$data['id'])}}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                    <i class="fa-edit fas"> </i>
                </a>
                <a   href="javascript:void(0);" data-id="{{$data['id']}}" data-route="{{route('doctors.destroy',$data['id'])}}" class=" delete-item font-medium text-blue-600 dark:text-blue-500 hover:underline ml-2">
                     <i class="fa-trash fas"> </i>
                </a>
            </td>

        </tr>

        @endforeach

    </tbody>
</table>

