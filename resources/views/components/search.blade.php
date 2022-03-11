<div class="my-2 flex sm:flex-row flex-col">
    <div class="flex flex-row mb-1 sm:mb-0">
        {{-- <div class="relative flex items-center">
            <select wire:model="sort"
                class="h-full rounded-r border-t sm:rounded-r-none sm:border-r-0 border-r border-b block  w-full bg-white border-gray-400 text-gray-700 py-2 px-4 pr-8 leading-tight focus:outline-none  focus:border-r focus:bg-white ">
                <option value="asc">Asc</option>
                <option value="desc">Desc</option>
            </select>
        </div> --}}
        <div class="relative">
            <select wire:model="perPage"
                class="h-full border block w-full bg-white border-gray-400 text-gray-700 py-2 px-4 pr-8 leading-tight focus:outline-none focus:bg-white ">
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
            class="rounded-l sm:rounded-l-none border border-gray-500 border-b block pl-8 pr-6 py-2 w-full bg-white text-gray-900 focus:bg-white focus:placeholder-gray-600 focus:text-gray-900 focus:outline-none focus:border-gray-600" />
    </div>
    <button wire:click="resetFilters"
        class="px-3 py-2 bg-gray-700 hover:bg-gray-900 text-white text-sm font-medium ml-1 rounded-md">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
            stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
        </svg>
    </button>
</div>
