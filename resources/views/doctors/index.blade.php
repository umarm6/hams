@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto p-4 mt-10">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold">Doctors</h2>
            <a href="{{ route('doctors.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">+ Add New</a>
        </div>

        <div class="overflow-x-auto bg-white shadow rounded-lg">
            <table class="min-w-full text-left border">
                <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2 border">ID</th>
                    <th class="px-4 py-2 border">Full Name</th>
                    <th class="px-4 py-2 border">Email</th>
                    <th class="px-4 py-2 border">Mobile</th>
                    <th class="px-4 py-2 border">Gender</th>
                    <th class="px-4 py-2 border">Specialist</th>
                    <th class="px-4 py-2 border">DOB</th>
                     <th class="px-4 py-2 border">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($doctors as $record)
                     <tr class="border-t">
                        <td class="px-4 py-2">{{ $record->id }}</td>
                        <td class="px-4 py-2">{{ $record->full_name }}</td>
                        <td class="px-4 py-2">{{ $record->email }}</td>
                         <td class="px-4 py-2">{{ $record->mobile }}</td>
                         <td class="px-4 py-2">{{ $record->gender }}</td>
                         <td class="px-4 py-2">{{ $record->doctorInfo?->specialist }}</td>
                         <td class="px-4 py-2">{{ $record->date_of_birth }}</td>
                          <td class="px-4 py-2 space-x-2">

                            <a href="{{ route('doctors.edit', $record) }}" class="text-yellow-600 hover:underline">
                                 <i class="fa-edit fas"> </i>
                             </a>
                            <form action="{{ route('doctors.destroy', $record) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button onclick="return confirm('Delete this record?')" class="text-red-600 hover:underline">
                                    <i class="fa-trash fas"> </i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $doctors->links() }}
        </div>
    </div>
@endsection
