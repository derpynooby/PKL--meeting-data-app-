<div>
    <div class="flex w-full px-4 divide-x divide-black gap-4 sm:gap-6 sm:px-0">
        {{ $header }}
    </div>
    <div class="mt-6 border-t border-indigo-800">
        <dl class="divide-y divide-indigo-800">
            {{ $slot }}
        </dl>
    </div>
</div>
