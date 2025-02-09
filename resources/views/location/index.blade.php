<x-app-layout>

    <x-slot name="header">
        <div class="flex justify-between">

            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Location Data') }}
            </h2>
            <x-modals class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                <x-slot:button>
                    <button @click="openModal = true" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                        Tambah
                    </button>
                </x-slot>

                <x-slot:form>
                    <h3 class="text-lg font-semibold mb-4">Location Add</h3>
                    <form @submit="openModal = false" method="POST" action="{{ route('location.store') }}">
                        @csrf
                        <!-- Location -->
                        <div class="mt-4">
                            <x-input-label for="location" :value="__('Location')" />
                            <x-text-input id="location" name="location" type="text" class="mt-1 block w-full"
                                :value="old('location')" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('location')" />
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ms-4">
                                {{ __('Submit') }}
                            </x-primary-button>
                        </div>
                    </form>
                </x-slot>
            </x-modals>

        </div>
    </x-slot>

    <x-table>
        <x-slot:table>

            <thead class="bg-gray-100">
                <tr>
                    <th scope="col" class="w-1/6 px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Id
                    </th>
                    <th scope="col" class="w-4/6 px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                        Location</th>
                    <th colspan="2" scope="w-1/6 col"
                        class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Tools</th>
                </tr>
            </thead>

            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($locations as $location)
                    <tr class="hover:bg-blue-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $location->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $location->location }}</td>

                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            <x-modals class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                                <x-slot:button>
                                    <button @click="openModal = true" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                                        Edit
                                    </button>
                                </x-slot>

                                <x-slot:form>
                                    <h3 class="text-lg font-semibold mb-4">Location Edit</h3>
                                    <form @submit="openModal = false" method="POST" action="{{ route('location.update', $location->id) }}">
                                        @csrf
                                        @method('patch')
                                        <!-- Location -->
                                        <div class="mt-4">
                                            <x-input-label for="location" :value="__('Location')" />
                                            <x-text-input id="location" name="location" type="text"
                                                class="mt-1 block w-full" :value="old('location', $location->location)" required autofocus />
                                            <x-input-error class="mt-2" :messages="$errors->get('location')" />
                                        </div>
                                        <div class="flex items-center justify-end mt-4">
                                            <x-primary-button class="ms-4">
                                                {{ __('Submit') }}
                                            </x-primary-button>
                                        </div>
                                    </form>
                                </x-slot>
                            </x-modals>
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            <form method="POST" action="{{ route('location.destroy', $location->id) }}">
                                @csrf
                                @method('delete')
                                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Delete</button>
                            </form>
                        </td>


                    </tr>
                @endforeach
            </tbody>
        </x-slot>
    </x-table>

</x-app-layout>
