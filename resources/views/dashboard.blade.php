<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="relative pt-16 pb-32 flex content-center items-center justify-center" style="min-height: 75vh;">
        <div class="absolute top-0 w-full h-full bg-center bg-cover"
            style='background-image: url("https://images.unsplash.com/photo-1557804506-669a67965ba0?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=1267&amp;q=80");'>
            <span id="blackOverlay" class="w-full h-full absolute opacity-75 bg-indigo-950"></span>
        </div>
        <div class="container relative mx-auto">
            <div class="items-center flex flex-wrap">
                <div class="w-full lg:w-6/12 px-4 ml-auto mr-auto text-center">
                    <div class="">
                        <h1 class="text-white font-semibold text-5xl">
                            Selamat Datang, di Pendataan Meeting Online
                        </h1>
                        <p class="mt-4 text-lg text-gray-300">
                            Solusi cepat dan efisien untuk pendataan Meeting.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="top-auto bottom-0 left-0 right-0 w-full absolute pointer-events-none overflow-hidden"
            style="height: 70px;">
            <svg class="absolute bottom-0 overflow-hidden" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none"
                version="1.1" viewBox="0 0 2560 100" x="0" y="0">
                <polygon class="text-gray-300 fill-current" points="2560 0 2560 100 0 100"></polygon>
            </svg>
        </div>
    </div>
    <section class="pb-20 bg-gray-300 -mt-32">
        <div class="container mx-auto px-4">

            <div class="flex flex-wrap items-center mt-32">
                <div class="w-full md:w-5/12 px-4 mr-auto ml-auto">
                    <div
                        class="text-gray-600 p-3 text-center inline-flex items-center justify-center w-16 h-16 mb-6 shadow-lg rounded-full bg-gray-100">
                        <i class="fas fa-user-friends text-xl"></i>
                    </div>

                    @if (Auth::user()->status == 'user')
                    <h3 class="text-3xl mb-2 font-semibold leading-normal">
                        Panduan Pengguna
                    </h3>
                    <ul class="list-disc">
                        <li class="text-lg font-light leading-relaxed mt-4 mb-4 text-gray-700">
                            Silahkan daftarkan diri anda dalam zoom meeting terbaru
                            dengan mengakses menu 'Participate Zoom' atau klik link
                            <a href="{{ route('zoom-participant.index') }}"
                                class="font-bold text-indigo-800 mt-8 underline">join zoom.</a>
                        </li>
                        <li class="text-lg font-light leading-relaxed mt-4 mb-4 text-gray-700">
                            Pilih zoom dengan cara klik gambar dengan judul yang sesuai
                        </li>
                        <li class="text-lg font-light leading-relaxed mt-4 mb-4 text-gray-700">
                            Isi dengan gambar dokumentasi, lalu submit
                        </li>
                    </ul>

                    @elseif (Auth::user()->status == 'operator')
                    <h3 class="text-3xl mb-2 font-semibold leading-normal">
                        Panduan Operator
                    </h3>
                    <ul class="list-disc">
                        <li class="text-lg font-light leading-relaxed mt-4 mb-4 text-gray-700">
                            Anda dapat menambahkan jadwal zoom dengan mengakses menu 'Zoom' atau kilk link 
                            <a href="{{ route('zoom.index') }}"
                                class="font-bold text-indigo-800 mt-8 underline">create zoom.</a>
                        </li>
                        <li class="text-lg font-light leading-relaxed mt-4 mb-4 text-gray-700">
                            Buat zoom sesuai keperluan anda
                        </li>
                        <li class="text-lg font-light leading-relaxed mt-4 mb-4 text-gray-700">
                            Isi dengan data zoom yang ingin anda buat, lalu submit
                        </li>
                    </ul>

                    @elseif (Auth::user()->status == 'admin')
                    <h3 class="text-3xl mb-2 font-semibold leading-normal">
                        Panduan Admin
                    </h3>
                    <ul class="list-disc">
                        <li class="text-lg font-light leading-relaxed mt-4 mb-4 text-gray-700">
                            Anda dapat menambahkan data pada table tertentu dengan mengkases nama tabel yang tercantum menu di menu
                        </li>
                        <li class="text-lg font-light leading-relaxed mt-4 mb-4 text-gray-700">
                            Tambah, Edit, dan Delete table sesuai aturan yang berlaku
                        </li>
                        <li class="text-lg font-light leading-relaxed mt-4 mb-4 text-gray-700">
                            Isi dengan data yang diperlukan, lalu submit
                        </li>
                    </ul>
                    @endif
                        
                </div>
                <div class="w-full md:w-4/12 px-4 mr-auto ml-auto">
                    <div
                        class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-indigo-900">
                        <img alt="..."
                            src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=1051&amp;q=80"
                            class="w-full align-middle rounded-t-lg" />
                        <blockquote class="relative p-8 mb-4">
                            <svg preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 583 95"
                                class="absolute left-0 w-full block" style="height: 95px; top: -94px;">
                                <polygon points="-30,95 583,95 583,65" class="text-blue-400 fill-current"></polygon>
                            </svg>
                            <h4 class="text-xl font-bold text-white">
                                Pendataan Zoom
                            </h4>
                            <p class="text-md font-light mt-2 text-white">
                                Menawarkan kemudahan akses, pendataan dan penjadwalan zoom.
                            </p>
                        </blockquote>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
</x-app-layout>
