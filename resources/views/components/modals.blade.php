<!-- Modal Container -->
<style>
    [x-cloak] {
        display: none;
    }
</style>
<div x-data="{ openModal: false }">
    <!-- Button to Open Modal -->
    {{ $button }}

    <!-- Modal -->
    {{-- Entering: "ease-out duration-300"
      From: "opacity-0"
      To: "opacity-100"
    Leaving: "ease-in duration-200"
      From: "opacity-100"
      To: "opacity-0" --}}
    <div 
    x-show="openModal" 
    x-cloak 
    x-transition:enter="ease-out duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-40">
        <div 
        @click.outside="openModal = false" 
        x-show="openModal" 
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        {{ $attributes }}>
            {{ $form }}
        </div>
    </div>
</div>
