<div class="my-2 flex sm:flex-row flex-col">
    <div class="flex flex-row mb-1 sm:mb-0">
        <div class="relative">
            <select wire:model="perPage"
                class="rounded-l-md h-full block w-full border border-gray-500 text-gray-700 py-2 pl-2 pr-8 leading-tight focus:outline-none hover:outline-none acitve:outline-none focus:border-gray-600">
                <option value="5">05 Per Page</option>
                <option value="10">10 Per Page</option>
                <option value="15">15 Per Page</option>
                <option value="30">30 Per Page</option>
            </select>
        </div>
    </div>
    <div class="block relative">
        <span class="h-full absolute inset-y-0 left-0 flex items-center pl-2">
            <svg viewBox="0 0 24 24" class="h-4 w-4 fill-current text-gray-500">
                <path
                    d="M10 4a6 6 0 100 12 6 6 0 000-12zm-8 6a8 8 0 1114.32 4.906l5.387 5.387a1 1 0 01-1.414 1.414l-5.387-5.387A8 8 0 012 10z">
                </path>
            </svg>
        </span>
        <input placeholder="Search here ..." wire:model="search"
            class="border border-l-0 border-gray-500 block pl-8 pr-6 py-2 w-full bg-white text-gray-900 focus:bg-white focus:placeholder-gray-600 focus:text-gray-900 focus:outline-none focus:border-gray-600" />
    </div>
    <x-backend.button.refresh wire:click="resetFilters"/>
</div>
