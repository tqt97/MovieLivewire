<div>
    <div class="relative pointer-events-auto">
        <button type="button" wire:click="showSearch"
            class="w-52 md:w-72 flex items-center text-sm leading-6 text-slate-400 rounded-md ring-1 ring-slate-900/10 shadow-sm py-1.5 pl-2 pr-3 hover:ring-slate-300 dark:bg-slate-800 dark:highlight-white/5 dark:hover:bg-slate-700">
            <svg width="24" height="24" fill="none" aria-hidden="true" class="mr-3 flex-none">
                <path d="m19 19-3.5-3.5" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round"></path>
                <circle cx="11" cy="11" r="6" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round"></circle>
            </svg>
            Quick search...
        </button>
        <x-jet-dialog-modal wire:model="showSearchModal">
            <x-slot name="title">Search Movie</x-slot>
            <x-slot name="content">
                <div class="mt-2 sm:mt-0 rounded-sm shadow-sm">
                    <div class="mt-1 md:mt-0 md:col-span-2 ">
                        <div class="flex flex-col">
                            <input wire:model="search" type="text" class="w-full rounded text-black"
                                placeholder="Search here ...">
                            <div wire:loading class="border border-gray-700 shadow rounded-md p-4 w-full mx-auto mt04">
                                <div class="animate-pulse flex space-x-4">
                                    <div class="flex-1 space-y-6 py-1">
                                        <div class="h-2 bg-slate-200 rounded"></div>
                                        <div class="space-y-3">
                                            <div class="grid grid-cols-3 gap-4">
                                                <div class="h-2 bg-slate-200 rounded col-span-2"></div>
                                                <div class="h-2 bg-slate-200 rounded col-span-1"></div>
                                            </div>
                                            <div class="h-2 bg-slate-200 rounded"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if (!empty($searchResults))
                                <div wire:loading.remove
                                    class="overflow-hidden lg:overflow-auto scrollbar:!w-1.5 scrollbar:!h-1.5 scrollbar:bg-transparent scrollbar-track:!bg-slate-100 scrollbar-thumb:!rounded scrollbar-thumb:!bg-slate-300 scrollbar-track:!rounded dark:scrollbar-track:!bg-slate-500/[0.16] dark:scrollbar-thumb:!bg-slate-500/50 max-h-96 supports-scrollbars:pr-2 lg:max-h-96 ">
                                    @if (!empty($searchResults))
                                        @foreach ($searchResults->groupByType() as $type => $modelSearchResults)
                                            <div class="py-2">
                                                <h2 class="mt-2 capitalize font-bold text-xl text-white">
                                                    <div class="flex items-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            class="h-5 w-5 mr-1 text-indigo-400" fill="none"
                                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14" />
                                                        </svg>
                                                        {{ $type }}
                                                    </div>
                                                </h2>
                                                @foreach ($modelSearchResults as $searchResult)
                                                    <div
                                                        class="my-2 p-2 rounded bg-gray-800 hover:bg-gray-900 cursor-pointer text-gray-100 hover:text-white shadow hover:shadow-lg">
                                                        <a href="{{ $searchResult->url }}">
                                                            {{ $searchResult->title }}
                                                        </a>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endforeach
                                    @else
                                        <div>
                                            No results found
                                        </div>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </x-slot>
            <x-slot name="footer">
                <x-m-button wire:click="closeSearchModal" class="bg-gray-600 hover:bg-gray-800 text-white">
                    Close
                </x-m-button>
            </x-slot>
        </x-jet-dialog-modal>
    </div>
</div>
