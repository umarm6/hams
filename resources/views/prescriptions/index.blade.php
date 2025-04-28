@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto p-4 mt-10">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold">Prescription</h2>
            @can('create medical records')
                <a href="{{ route('prescriptions.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">+ Add New</a>
            @endcan
        </div>

        <div class="overflow-x-auto bg-white shadow rounded-lg">
            <table class="min-w-full text-left border">
                <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2 border">ID</th>
                    <th class="px-4 py-2 border">Patient</th>
                    <th class="px-4 py-2 border">Doctor</th>
                    <th class="px-4 py-2 border">Medication</th>
                     <th class="px-4 py-2 border">Date</th>
                    <th class="px-4 py-2 border">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($prescriptions as $record)
                     <tr class="border-t">
                        <td class="px-4 py-2">{{ $record->id }}</td>
                        <td class="px-4 py-2">{{ $record->patients?->full_name }}</td>
                        <td class="px-4 py-2">{{ $record->doctor?->full_name }}</td>
                         <td class="px-4 py-2">{{ $record->medication_name }}</td>
                        <td class="px-4 py-2">{{ $record->prescribed_date }}</td>
                        <td class="px-4 py-2 space-x-2">

                             <a href="{{ route('prescriptions.show', $record) }}" class="text-yellow-600 hover:underline">
                                 <i class="fa-eye fas"> </i>
                             </a>

                            <a href="{{ route('prescriptions.edit', $record) }}" class="text-yellow-600 hover:underline">
                                 <i class="fa-edit fas"> </i>
                             </a>
                            <form action="{{ route('prescriptions.destroy', $record) }}" method="POST" class="inline">
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
            {{ $prescriptions->links() }}
        </div>
    </div>
@endsection
