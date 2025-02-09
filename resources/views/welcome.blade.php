<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/gh/creativetimofficial/tailwind-starter-kit/compiled-tailwind.min.css" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        <nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
            <!-- Primary Navigation Menu -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                        <!-- Logo -->
                        <div class="shrink-0 flex items-center gap-3">
                            <a href="{{ route('dashboard') }}">
                                <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                            </a>
                            <h2 class="text-xl font-semibold">{{ config('app.name', 'Laravel') }}</h2>
                        </div>
                        <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                            <!-- Navigation Links -->
                            @if (Route::has('login'))
                            @auth
                            <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                                <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                                    {{ __('Dashboard') }}
                                </x-nav-link>
                            </div>
                            @else
                            <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                                <x-nav-link :href="route('login')" :active="request()->routeIs('login')">
                                    {{ __('Login') }}
                                </x-nav-link>
                            </div>

                            @if (Route::has('register'))
                            <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                                <x-nav-link :href="route('register')" :active="request()->routeIs('register')">
                                    {{ __('Register') }}
                                </x-nav-link>
                            </div>
                            @endif
                            @endauth
                            @endif
                        </div>
                    <!-- Hamburger -->
                    <div class="-me-2 flex items-center sm:hidden">
                        <button @click="open = ! open"
                            class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16" />
                                <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                                    stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Responsive Navigation Menu -->
            <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
                <div class="pt-2 pb-3 space-y-1">
                @if (Route::has('login'))
                    @auth
                    <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-responsive-nav-link>
                    @else
                    <x-responsive-nav-link :href="route('login')" :active="request()->routeIs('login')">
                        {{ __('Login') }}
                    </x-responsive-nav-link>
                    @if (Route::has('register'))
                    <x-responsive-nav-link :href="route('register')" :active="request()->routeIs('register')">
                        {{ __('Register') }}
                    </x-responsive-nav-link>
                    @endif
                    @endauth
                @endif
                </div> 
            </div>
        </nav>

        <!-- Page Content -->
        <main>
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
                    <svg class="absolute bottom-0 overflow-hidden" xmlns="http://www.w3.org/2000/svg"
                        preserveAspectRatio="none" version="1.1" viewBox="0 0 2560 100" x="0" y="0">
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

                                <h3 class="text-3xl mb-2 font-semibold leading-normal">
                                    Hallo,
                                </h3>
                                <ul class="list-disc">
                                    <li class="text-lg font-light leading-relaxed mt-4 mb-4 text-gray-700">
                                        Silahkan daftarkan diri anda dalam meeting terbaru
                                        dengan mengakses menu 'Login' atau 'Register'
                                    </li>
                                </ul>
                            

                        </div>
                        <div class="w-full md:w-4/12 px-4 mr-auto ml-auto">
                            <div
                                class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-indigo-900">
                                <img alt="..."
                                    src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=1051&amp;q=80"
                                    class="w-full align-middle rounded-t-lg" />
                                <blockquote class="relative p-8 mb-4">
                                    <svg preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 583 95" class="absolute left-0 w-full block"
                                        style="height: 95px; top: -94px;">
                                        <polygon points="-30,95 583,95 583,65" class="text-blue-400 fill-current">
                                        </polygon>
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
        </main>
    </div>
</body>
<footer>
    <div class="bg-white shadow text-gray-400 text-center py-2">
        © 2024 Stempert
    </div>
</footer>

</html>
