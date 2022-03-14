<button
    {{ $attributes->merge(['class' =>'bg-red-600 hover:bg-red-700 focus:bg-red-700 active:bg-red-700 focus:ring-red-500 text-white inline-flex justify-center py-1 px-1 border border-transparent hadow-sm text-sm font-medium rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2']) }} title="Delete">
    <x-backend.icon.delete />
    {{ $slot }}
</button>
