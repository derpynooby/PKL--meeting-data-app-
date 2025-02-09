<x-app-layout>

    <x-slot name="header">
        <div class="flex justify-between">

            <h2 class="font-semibold text-xl text-gray-800 px-4 py-2 leading-tight">
                {{ __('Data Meeting') }}
            </h2>

            <!-- Modal -->
            <x-modals class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">

                <!-- Button open Modal -->
                <x-slot:button>
                    <button @click="openModal = true"
                        class="font-semibold bg-green-200 text-green-700 px-4 py-2 rounded hover:text-green-900 hover:bg-gray-100">
                        Tambah+
                    </button>
                </x-slot>

                <!-- Modal Items -->
                <x-slot:form>
                    <h3 class="text-lg text-indigo-700 font-semibold mb-4">Meeting Add</h3>
                    <form @submit="openModal = false" method="POST" action="{{ route('zoom.store') }}">
                        @csrf
                        <!-- Title -->
                        <div class="mt-4">
                            <x-input-label for="title" :value="__('Judul Meeting')" />
                            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full"
                                :value="old('title')" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('title')" />
                        </div>
                        <!-- Location-->
                        <div class="mt-4">
                            <x-input-label for="location" :value="__('Lokasi')" />
                            <select id="location" name="location_id"
                                class="block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                @foreach ($locations as $location)
                                    <option value="{{ $location->id }}">{{ $location->location }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('location')" class="mt-2" />
                        </div>
                        <!-- Time -->
                        <div class="mt-4">
                            <x-input-label for="start_time" :value="__('Waktu')" />
                            <div class="flex items-center space-x-4">
                                <label for="start_time" class="block text-sm font-medium text-gray-700">Dari Jam</label>
                                <input id="start_time" name="start" type="time"
                                    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                    required />

                                <label for="end_time" class="block text-sm font-medium text-gray-700">Sampai Jam</label>
                                <input id="end_time" name="end" type="time"
                                    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                    required />
                            </div>
                            <x-input-error class="mt-2" :messages="$errors->get('start_time')" />
                            <x-input-error class="mt-2" :messages="$errors->get('end_time')" />
                        </div>
                        <!-- Datetime -->
                        <div class="mt-4">
                            <x-input-label for="datetime" :value="__('Tanggal')" />
                            <x-text-input id="datetime" name="datetime" type="date" class="mt-1 block w-full"
                                :value="old('datetime')" required />
                            <x-input-error class="mt-2" :messages="$errors->get('datetime')" />
                        </div>
                        <!-- Link -->
                        <div class="mt-4">
                            <x-input-label for="link" :value="__('Link Meeting')" />
                            <x-text-input id="link" name="link" type="text" class="mt-1 block w-full"
                                :value="old('link')" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('link')" />
                        </div>
                        <!-- Description -->
                        <div class="mt-4">
                            <x-input-label for="description" :value="__('Deskripsi')" />
                            <textarea id="description" name="description" class="mt-1 block w-full" :value="old('description')" required>
                            </textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('description')" />
                        </div>
                        <div class="flex items-center justify-between mt-4">
                            <button @click="openModal = false"
                                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Back
                            </button>
                            <x-primary-button>
                                {{ __('Submit') }}
                            </x-primary-button>
                        </div>
                    </form>
                </x-slot>
            </x-modals>
            <!-- End Modal -->

        </div>
    </x-slot>

    <!-- Content -->
    <x-content>
        <div class="mt-6 space-y-12 lg:grid lg:grid-cols-3 lg:gap-x-6 lg:space-y-0">

            <!-- Collection Items -->
            @foreach ($zooms as $zoom)
                <div class="group relative">
                    <div
                        class="relative h-80 w-full overflow-hidden rounded-lg bg-white sm:mt-4 sm:aspect-h-1 sm:aspect-w-2 lg:aspect-h-1 lg:aspect-w-1 group-hover:opacity-75 sm:h-64">
                        @if ($zoom->participant->pluck('documentation')->isEmpty())
                            <img src="{{ asset('storage/' . 'zooms/documentations/default.png') }}"
                                alt="Desk with leather desk pad" class="h-full w-full object-cover object-center">
                        @else
                            @foreach ($zoom->participant as $participant)
                                <img src="{{ asset('storage/' . $participant->documentation) }}"
                                    alt="Desk with leather desk pad" class="h-full w-full object-cover object-center">
                            @break
                        @endforeach
                    @endif
                </div>
                <h3 class="mt-4 text-xl font-semibold text-gray-900 truncate overflow-hidden">

                    <!-- Modal -->
                    <x-modals
                        class="w-full max-w-screen-lg mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">

                        <!-- Button open Modal -->
                        <x-slot:button>
                            <a @click="openModal = true">
                                <span class="absolute inset-0"></span>
                                {{ $zoom->title }}
                            </a>
                        </x-slot>

                        <!-- Modal Items -->
                        <x-slot:form>

                        <!-- Description -->
                        <x-description>
                            <x-slot:header>
                                <div class="sm:h-40 sm:w-1/4 h-40 w-2/5">
                                    @if ($zoom->participant->pluck('documentation')->isEmpty())
                                        <img src="{{ asset('storage/' . 'zooms/documentations/default.png') }}"
                                            alt="Foto Dokumentasi"
                                            class=" text-base w-full h-full overflow-hidden object-cover object-center">
                                    @else
                                        @foreach ($zoom->participant as $participant)
                                            <img src="{{ asset('storage/' . $participant->documentation) }}"
                                                alt="Foto Dokumentasi"
                                                class=" text-base w-full h-full overflow-hidden object-cover object-center">
                                        @break
                                    @endforeach
                                    @endif
                                </div>
                                <div class="sm:w-3/4 sm:p-6 h-40 w-3/5 p-3">
                                    <h3 class="text-xl font-semibold text-indigo-700">Detail Kegiatan</h3>
                                    <p class="text-xl font-semibold text-gray-900 whitespace-normal">
                                        {{ $zoom->title }}
                                    </p>
                                    <p
                                        class="mt-1 hidden text-base leading-6 text-gray-500 sm:whitespace-normal sm:overflow-hidden sm:block sm:col-span-2 sm:mt-0">
                                        {{ $zoom->description }}
                                    </p>
                                </div>
                            </x-slot>
                            <div class="px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                <dt class="text-base font-normal leading-6 text-black">Link Meeting</dt>
                                <dd class="truncate mt-1 text-lg leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                                    {{ $zoom->link }}</dd>
                            </div>
                            <div class="px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                <dt class="text-base font-normal leading-6 text-black">Lokasi Meeting</dt>
                                <dd class="mt-1 text-lg leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                                    {{ $zoom->location->location }}</dd>
                            </div>
                            <div class="px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                <dt class="text-base font-normal leading-6 text-black">Waktu</dt>
                                <dd class="mt-1 text-lg leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                                    {{ $zoom->start }} - {{ $zoom->end }}</dd>
                            </div>
                            <div class="px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                <dt class="text-base font-normal leading-6 text-black">Tanggal</dt>
                                <dd class="mt-1 text-lg leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                                    {{ $zoom->datetime }}</dd>
                            </div>
                            <div class="px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                <dt class="text-base font-normal leading-6 text-black">Peserta</dt>
                                <dd class="mt-1 text-lg leading-6 text-gray-700 sm:px-0 sm:mt-0">
                                    {{ $zoom->participant->count() }}</dd>
                                @if ($zoom->participant->count() > 0)
                                <a class="text-right mt-1 mx-4 underline text-lg leading-6 text-indigo-700 hover:text-indigo-900 sm:px-0 sm:mt-0" href="{{ route('zoom-participant.details', $zoom->participant->first()->id) }}">
                                    Lihat Peserta</a>
                                @endif
                            </div>
                            <div class="sm:hidden px-4 py-5 sm:px-0">
                                <dt class="text-base font-normal leading-6 text-black">Deskripsi</dt>
                                <dd
                                    class="mt-1 text-lg leading-6 text-gray-500 sm:col-span-2 sm:mt-0 whitespace-normal overflow-hidden ">
                                    {{ $zoom->description }}</dd>
                            </div>
                        </x-description>
                        <!-- End Description -->

                        <div class="flex items-center justify-between mt-4 p-4">
                            <button @click="openModal = false"
                                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Back
                            </button>
                            <div class="flex justify-end gap-3">

                                <!-- Modal -->
                                <x-modals
                                    class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">

                                    <!-- Button open Modal -->
                                    <x-slot:button>
                                        <button @click="openModal = true"
                                            class=" text-lg bg-blue-200 text-blue-700 px-4 py-1 rounded hover:text-blue-900 hover:bg-gray-100">
                                            Edit
                                        </button>
                                    </x-slot>

                                    <!-- Modal Items -->
                                    <x-slot:form>
                                        <h3 class="text-lg text-indigo-700 font-semibold mb-4">Meeting Edit</h3>
                                        <form @submit="openModal = false" method="POST"
                                            action="{{ route('zoom.update', $zoom->id) }}">
                                            @csrf
                                            @method('patch')
                                            <!-- Meeting -->
                                            <div class="mt-4">
                                                <x-input-label for="zoom" :value="__('Judul Meeting')" />
                                                <x-text-input id="zoom" name="title" type="text"
                                                    class="mt-1 block w-full" :value="old('zoom', $zoom->title)" required
                                                    autofocus />
                                                <x-input-error class="mt-2" :messages="$errors->get('zoom')" />
                                            </div>
                                            <!-- Location-->
                                            <div class="mt-4">
                                                <x-input-label for="location" :value="__('Lokasi')" />
                                                <select id="location" name="location_id"
                                                    class="block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                                    @foreach ($locations as $location)
                                                        <option value="{{ $location->id }}"
                                                            @if ($location == $zoom->location) selected @endif>
                                                            {{ $location->location }}</option>
                                                    @endforeach
                                                </select>
                                                <x-input-error :messages="$errors->get('location')" class="mt-2" />
                                            </div>
                                            <!-- Time -->
                                            <div class="mt-4">
                                                <x-input-label for="start_time" :value="__('Waktu')" />
                                                <div class="flex items-center space-x-4">
                                                    <label for="start_time"
                                                        class="block text-sm font-medium text-gray-700">
                                                        Dari Jam</label>
                                                    <input id="start_time" name="start" type="time"
                                                        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                                        required />

                                                    <label for="end_time"
                                                        class="block text-sm font-medium text-gray-700">
                                                        Sampai Jam</label>
                                                    <input id="end_time" name="end" type="time"
                                                        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                                        required />
                                                </div>
                                                <x-input-error class="mt-2" :messages="$errors->get('start_time')" />
                                                <x-input-error class="mt-2" :messages="$errors->get('end_time')" />
                                            </div>
                                            <!-- Datetime -->
                                            <div class="mt-4">
                                                <x-input-label for="datetime" :value="__('Tanggal')" />
                                                <x-text-input id="datetime" name="datetime" type="date"
                                                    class="mt-1 block w-full" :value="old('datetime', $zoom->datetime)" required />
                                                <x-input-error class="mt-2" :messages="$errors->get('datetime')" />
                                            </div>
                                            <!-- Link -->
                                            <div class="mt-4">
                                                <x-input-label for="link" :value="__('Link Meeting')" />
                                                <x-text-input id="link" name="link" type="text"
                                                    class="mt-1 block w-full" :value="old('link', $zoom->link)" required
                                                    autofocus />
                                                <x-input-error class="mt-2" :messages="$errors->get('link')" />
                                            </div>
                                            <!-- Description -->
                                            <div class="mt-4">
                                                <x-input-label for="description" :value="__('Deskripsi')" />
                                                <textarea id="description" name="description" class="mt-1 block w-full" :value="old('description')" required>
                                                    </textarea>
                                                <x-input-error class="mt-2" :messages="$errors->get('description')" />
                                            </div>
                                            <div class="flex items-center justify-between mt-4">
                                                <button @click="openModal = false"
                                                    class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                                    Back
                                                </button>
                                                <x-primary-button>
                                                    {{ __('Submit') }}
                                                </x-primary-button>
                                            </div>
                                        </form>
                                    </x-slot>
                                </x-modals>
                                <!-- End Modal -->

                                <!-- Delete Button -->
                                <form method="POST" action="{{ route('zoom.destroy', $zoom->id) }}">
                                    @csrf
                                    @method('delete')
                                    <button type="submit"
                                        class=" text-lg bg-red-200 text-red-700 px-4 py-1 rounded hover:text-red-900 hover:bg-gray-100">
                                        Delete</button>
                                </form>

                            </div>
                        </div>

                    </x-slot>
                </x-modals>
                <!-- End Modal -->

            </h3>
            <p class="truncate mt-1 text-base text-gray-500">{{ $zoom->description }}</p>
        </div>
    @endforeach
    <!-- Add more collection items here -->

</div>
</x-content>
<div class="mx-auto max-w-7xl m-4 p-4 sm:px-6 lg:px-8 bg-white shadow-sm sm:rounded-lg @if (!$zooms->links()->paginator->hasPages()) hidden @endif">
{{ $zooms->links() }}
</div>
<br>
<!-- End Content -->

</x-app-layout>
