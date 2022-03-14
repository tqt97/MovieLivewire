<button
    {{ $attributes->merge(['class' => 'group px-3 py-2 bg-gray-800 hover:bg-gray-900  focus:text-gray-50 text-white text-sm font-medium rounded-r-md']) }}>
    <x-backend.icon.refresh />
    {{ $slot }}
</button>
