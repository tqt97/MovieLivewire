@props(['id' => null, 'maxWidth' => null])

<x-jet-modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
    <div class="px-6 py-4 bg-indigo-50  dark:bg-gray-700 lg:translate-x-0 lg:static lg:inset-0">
        <div class="text-xl text-center font-semibold dark:text-gray-50 ">
            {{ $title }}
        </div>

        <div class="mt-4">
            {{ $content }}
        </div>
    </div>

    <div class="flex flex-row justify-end px-6 py-2 bg-indigo-50 dark:bg-gray-700  lg:translate-x-0 lg:static lg:inset-0 text-right">
        {{ $footer }}
    </div>
</x-jet-modal>
