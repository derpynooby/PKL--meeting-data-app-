<x-app-layout>

    <x-slot name="header">
        <div class="flex justify-between items-center">

            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Riwayat Zoom') }} 
                {{ Auth::user()->name }}
            </h2>
            <x-back-button>

            </x-back-button>
            

        </div>
    </x-slot>

    <div class="mt-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">     
                    <a class="font-semibold text-white bg-indigo-700 px-4 py-2 rounded-lg hover:bg-indigo-900" href="{{ route('zoom-participant.export-history')}}">
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
                        Nama Meeting</th>
                    <th scope="col" class="w-3/12 px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                        Tanggal</th>
                    <th scope="col" class="w-3/12 px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                        Waktu Join</th>
                </tr>
            </thead>

            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($histories as $history)
                    <tr class="hover:bg-blue-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $history->zoom->title }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $history->zoom->datetime }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $history->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </x-slot>
    </x-table>

</x-app-layout>
