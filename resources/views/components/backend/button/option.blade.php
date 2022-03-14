<button
    {{ $attributes->merge(['class' =>'bg-orange-600 hover:bg-orange-700 focus:bg-orange-700 active:bg-orange-700 focus:ring-orange-500 text-white inline-flex justify-center py-1 px-1 border border-transparent hadow-sm text-sm font-medium rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2']) }}
    title="Options">
    <x-backend.icon.option />
    {{ $slot }}
</button>
