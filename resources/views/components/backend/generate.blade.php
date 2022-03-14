<div {{ $attributes->merge(['class' => 'w-full flex mb-4 justify-start']) }}>
    <form class="flex space-x-0 bg-white ">
        <div class="py-1 flex items-center">
            <div class="relative rounded-l-md shadow-sm">
                {{ $input }}
            </div>
        </div>
        <div class="py-1">
            {{ $slot }}
        </div>
    </form>
</div>
