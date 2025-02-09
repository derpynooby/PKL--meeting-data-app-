<x-app-layout>

    <x-slot name="header">
        <div class="flex justify-between">

            <h2 class="font-semibold text-xl text-gray-800 px-4 py-2 leading-tight">
                {{ __('Bergabung ke Meeting Sekarang !') }}
            </h2>



        </div>
    </x-slot>

    <!-- Content -->
    <x-content>
        <h2 class="text-2xl font-bold text-gray-900">Join Meeting</h2>
        <div class="mt-6 space-y-12 lg:grid lg:grid-cols-3 lg:gap-x-6 lg:space-y-0">

            <!-- Collection Items -->
            @foreach ($zooms as $zoom)
                {{-- {{ dd($zoom) }} --}}
                <div class="group relative">
                    <div class="relative h-80 w-full overflow-hidden rounded-lg bg-white sm:mt-4 sm:aspect-h-1 sm:aspect-w-2 lg:aspect-h-1 lg:aspect-w-1 group-hover:opacity-75 sm:h-64">
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
                                                alt="Foto Dokumentasi" class=" text-base w-full h-full overflow-hidden object-cover object-center">
                                            @else
                                            @foreach ($zoom->participant as $participant)
                                                <img src="{{ asset('storage/' . $participant->documentation) }}"
                                                alt="Foto Dokumentasi" class=" text-base w-full h-full overflow-hidden object-cover object-center">
                                                @break
                                            @endforeach
                                            @endif
                                        </div>
                                        <div class="sm:w-3/4 sm:p-6 h-40 w-3/5 p-3">
                                            <h3 class="text-xl font-semibold text-indigo-700">Detail Kegiatan</h3>
                                            <h3 class="text-xl font-semibold text-gray-900 whitespace-normal">
                                                {{ $zoom->title }}</h3>
                                            <p class="mt-1 hidden text-base leading-6 text-gray-500 sm:whitespace-normal sm:overflow-hidden sm:block sm:col-span-2 sm:mt-0">
                                                {{ $zoom->description }}</p>
                                        </div>
                                    </x-slot>
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
                                        <dd class="mt-1 text-lg leading-6 text-gray-500 sm:col-span-2 sm:mt-0 whitespace-normal">
                                            {{ $zoom->description }}</dd>
                                    </div>
                                </x-description>
                                <!-- End Description -->

                                <div class="flex items-center justify-between mt-4 p-4">
                                    <button @click="openModal = false"
                                        class="font-semibold px-4 py-2 rounded text-white bg-gray-800 hover:bg-gray-900">
                                        Back
                                    </button>
                                    <div class="flex gap-3">
                                    
                                        <!-- Modal -->
                                    <x-modals
                                        class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">

                                        <!-- Button open Modal -->
                                        <x-slot:button>
                                            <button @click="openModal = true"
                                                class="font-semibold text-white bg-indigo-700 px-4 py-2 rounded hover:bg-indigo-900">
                                                Join
                                            </button>
                                        </x-slot>

                                        <!-- Modal Items -->
                                        <x-slot:form>
                                            <h3 class="text-xl text-indigo-600 font-semibold mb-4">Join Meeting</h3>
                                            <div x-data="imageUpload()" class="bg-white p-6 w-96">
                                                <h2 class="text-lg font-semibold mb-4">Upload Dokumentasi</h2>
                                                <form @submit="submitForm" method="POST" enctype="multipart/form-data">
                                                    <div x-ref="dropzone" @dragover.prevent @dragleave="hover = false"
                                                        @drop.prevent="handleDrop($event)" @mouseenter="hover = true"
                                                        @mouseleave="hover = false"
                                                        class="border-2 border-dashed border-gray-300 rounded-lg p-4 flex flex-col items-center justify-center"
                                                        :class="{ 'border-blue-500': hover, 'border-gray-300': !hover }"
                                                        action="{{ route('zoom-participant.store') }}"
                                                        enctype="multipart/form-data">

                                                        @csrf
                                                        @method('post')

                                                        <!-- Meeting Id -->
                                                        <div class="hidden">
                                                            <x-text-input id="zoom" name="zoom_id" type="text"
                                                                :value="old('zoom', $zoom->id)" required />
                                                        </div>
                                                        <div class="hidden">
                                                            <x-text-input id="link" name="link" type="text"
                                                                value="{{ $zoom->link }}" required />
                                                        </div>

                                                        <template x-if="image">
                                                            <img :src="image" alt="Preview"
                                                                class="w-full h-32 object-cover mb-2 rounded-lg">
                                                        </template>
                                                        <template x-if="!image">
                                                            <p class="text-gray-500 whitespace-normal">
                                                                Seret & jatuhkan gambar Anda di sini atau
                                                                klik untuk mengunggah</p>
                                                        </template>
                                                        <input type="file" @change="handleFileUpload"
                                                            accept="image/*" class="hidden" x-ref="fileInput"
                                                            name="documentation" required>
                                                        <button @click="$refs.fileInput.click()" type="button"
                                                            class="font-semibold text-indigo-900 bg-indigo-100 px-4 py-2 mt-2 rounded hover:text-indigo-700 hover:bg-gray-100">
                                                            Pilih Gambar
                                                        </button>
                                                    </div>
                                                    <div class="flex items-center justify-between mt-4">
                                                        <button @click="openModal = false"
                                                            class="font-semibold px-4 py-1 mt-2 rounded-lg text-white bg-gray-800 hover:bg-gray-900">
                                                            Back
                                                        </button>
                                                        <button type="submit"
                                                            class="font-semibold text-white bg-indigo-700 px-4 py-1 mt-2 rounded-lg hover:bg-indigo-900">
                                                            Submit
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                            <script>
                                                function imageUpload() {
                                                    return {
                                                        image: null,
                                                        hover: false,

                                                        handleDrop(event) {
                                                            const files = event.dataTransfer.files;
                                                            if (files.length) {
                                                                this.handleFileUpload({
                                                                    target: {
                                                                        files
                                                                    }
                                                                });
                                                            }
                                                        },

                                                        handleFileUpload(event) {
                                                            const file = event.target.files[0];
                                                            if (file && file.type.startsWith('image/')) {
                                                                const reader = new FileReader();
                                                                reader.onload = (e) => {
                                                                    this.image = e.target.result;
                                                                };
                                                                reader.readAsDataURL(file);
                                                            } else {
                                                                alert('Please upload a valid image file.');
                                                            }
                                                        },

                                                    };
                                                }
                                            </script>
                                        </x-slot>
                                    </x-modals>
                                    <!-- End Modal -->

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
