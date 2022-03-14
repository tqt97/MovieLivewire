<button
    {{ $attributes->merge(['class' =>'bg-indigo-600 hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-700 focus:ring-indigo-500 text-white inline-flex justify-center py-1 px-1 border border-transparent hadow-sm text-sm font-medium rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2']) }}>
    <x-backend.icon.edit />
    {{ $slot }}
</button>
