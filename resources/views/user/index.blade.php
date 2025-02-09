<x-app-layout>

    <x-slot name="header">
        <div class="flex justify-between">

            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('User Data') }}
            </h2>
        </div>
    </x-slot>

    <x-table>
        <x-slot:table>

            <thead class="bg-gray-100">
                <tr>
                    <th scope="col" class="w-1/6 px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">User
                    </th>
                    <th scope="col" class="w-4/6 px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                        Status</th>
                    <th scope="w-1/8 col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Tools
                    </th>
                </tr>
            </thead>

            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($users as $user)
                    <tr class="hover:bg-blue-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $user->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $user->status }}</td>

                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            <x-modals
                                class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                                <x-slot:button>
                                    <button @click="openModal = true"
                                        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                                        Edit
                                    </button>
                                </x-slot>

                                <x-slot:form>
                                    <h3 class="text-lg font-semibold mb-4">User Edit</h3>
                                    <form @submit="openModal = false" method="POST"
                                        action="{{ route('status.update', $user->id) }}" enctype="multipart/form-data">
                                        @csrf
                                        @method('patch')
                                        <!-- User -->
                                        <div class="mt-4">
                                            <x-input-label for="status" :value="__('Status')" />
                                            <select id="status" name="status"
                                                class="block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                                <option value="user" {{ $user->status === 'user' ? 'selected' : '' }}>
                                                    User</option>
                                                <option value="admin" {{ $user->status === 'admin' ? 'selected' : '' }}>
                                                    Admin</option>
                                            </select>
                                            <x-input-error class="mt-2" :messages="$errors->get('status')" />
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


                    </tr>
                @endforeach
            </tbody>
        </x-slot>
    </x-table>

</x-app-layout>
