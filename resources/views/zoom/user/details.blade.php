<x-app-layout>

    <x-slot name="header">
        <div class="flex justify-between items-center">

            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Peserta Zoom') }} 
                {{ $zoom->title }}
            </h2>
            <x-back-button>

            </x-back-button>
            

        </div>
    </x-slot>

    <div class="mt-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">     
                    <a class="font-semibold text-white bg-indigo-700 px-4 py-2 rounded-lg hover:bg-indigo-900" href="{{ route('zoom-participant.export', $zoom->participant->first()->id) }}">
                    Export to Excel</a>
                </div>
            </div>
        </div>
    </div>
    
    <x-table>
        <x-slot:table>
            
            <thead class="bg-gray-100">
                <tr>
                    <th scope="col" class="w-3/12 px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                        Dokumentasi</th>
                    <th scope="col" class="w-3/12 px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                        Nama</th>
                    <th scope="col" class="w-3/12 px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                        Jabatan</th>
                    <th scope="col" class="w-2/12 px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                        Dibuat pada</th>
                </tr>
            </thead>

            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($participants as $participant)
                    <tr class="hover:bg-blue-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            <div class="sm:h-40 w-full">
                            <img src="{{ asset('storage/'. $participant->documentation) }}"
                            alt="Foto Dokumentasi" class=" text-base w-full h-full overflow-hidden object-cover object-center">
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $participant->user->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $participant->user->role->role }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $participant->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </x-slot>
    </x-table>

</x-app-layout>
