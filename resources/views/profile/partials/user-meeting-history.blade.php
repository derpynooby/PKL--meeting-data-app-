<section>
    <header>
    <h2 class="text-lg font-medium text-gray-900">
        {{ __('Riwayat Zoom') }}
    </h2>
    <a href="{{ route('zoom-participant.history')}}" class="text-indigo-700 hover:text-indigo-900">
        {{ Auth::user()->name }}
    </a>
    </header>
</section>