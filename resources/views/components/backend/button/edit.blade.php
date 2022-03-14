<button
    {{ $attributes->merge(['class' =>'bg-blue-600 hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-700 focus:ring-blue-500 text-white inline-flex justify-center py-1 px-1 border border-transparent hadow-sm text-sm font-medium rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2']) }} title="Edit">
    <x-backend.icon.edit />
    {{ $slot }}
</button>
