<section class="container mx-auto">
    <x-backend.generate>
        <x-slot name="input">
            <input wire:model="episode_number" class="px-3 py-2 border border-gray-300 rounded"
                placeholder="Episode number" />
        </x-slot>
        <x-backend.button.generate wire:click="generateEpisode">
            <x-backend.icon.spin wire:loading wire:target="generateEpisode" />
        </x-backend.button.generate>
    </x-backend.generate>

    <x-search />
    <x-backend.table.table>
        <x-slot name="thead">
            <x-backend.table.th-sort wire:click="sortByColumn('name')">
                <span> Name </span>
                @if (!$sortColumn || ($sortColumn == 'name' && $sortDirection == 'asc'))
                    <x-backend.icon.sort-asc />
                @else
                    <x-backend.icon.sort-desc />
                @endif
            </x-backend.table.th-sort>
            <x-backend.table.th-center>Public</x-backend.table.th-center>
            <x-backend.table.th-center>Action</x-backend.table.th-center>
        </x-slot>
        <x-slot name="tbody">
            @forelse ($episodes as $tbl_episode)
                <x-backend.table.tbody-tr>
                    <x-backend.table.td-left>
                        {{ $tbl_episode->name }}
                    </x-backend.table.td-left>
                    <x-backend.table.td-center>
                        @if ($tbl_episode->is_public)
                            <x-backend.publish />
                        @else
                            <x-backend.unpublish />
                        @endif
                    </x-backend.table.td-center>
                    <x-backend.table.td-center>
                        <x-backend.button.trailer wire:click="showTrailerModal({{ $tbl_episode->id }})" />
                        <x-backend.button.edit wire:click="showEditModal({{ $tbl_episode->id }})" />
                        <x-backend.button.delete wire:click="deleteEpisode({{ $tbl_episode->id }})" />
                    </x-backend.table.td-center>
                </x-backend.table.tbody-tr>
            @empty
                <x-backend.no-result :colspan="6" />
            @endforelse
        </x-slot>
        <x-slot name="pagination">
            <x-backend.pagination :pagination="$episodes" />
        </x-slot>
    </x-backend.table.table>
    <x-jet-dialog-modal wire:model="showEpisodeModal">
        <x-slot name="title">Update Episode</x-slot>
        <x-slot name="content">
            <div class="mt-10 sm:mt-0">
                <div class="mt-5 md:mt-0 md:col-span-2">
                    <form>
                        <div class="shadow overflow-hidden sm:rounded-md">
                            <div class="px-4 py-5 bg-white sm:p-6">
                                <div class="gap-6">
                                    <div class="col-span-6 sm:col-span-3">
                                        <label class="block text-sm font-medium text-gray-700">
                                            Episode name
                                        </label>
                                        <input wire:model="name" type="text"
                                            class="mt-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                                        @error('name')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label class="block text-sm font-medium text-gray-700">
                                            Episode number
                                        </label>
                                        <input wire:model="episode_number" type="text"
                                            class="mt-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                                        @error('episode_number')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label class="block text-sm font-medium text-gray-700">
                                            Overview
                                        </label>
                                        <textarea wire:model="overview" class="mt-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                            cols="30" rows="2">{{ $overview }}</textarea>
                                        @error('overview')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="flex flex-col">
                                        <div class="flex items-center mt-2">
                                            <input wire:model="is_public" type="checkbox"
                                                class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                                            <label for="remember-me" class="ml-3 block text-sm text-gray-900">
                                                Published
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </x-slot>
        <x-slot name="footer">
            <x-m-button wire:click="updateEpisode" class="bg-green-600 hover:bg-green-700 text-white">
                Update
            </x-m-button>
            <x-m-button wire:click="closeEpisodeModal" class="bg-gray-600 ml-3 hover:bg-gray-800 text-white">
                Cancel
            </x-m-button>
        </x-slot>
    </x-jet-dialog-modal>
    <x-jet-dialog-modal wire:model="showTrailer">
        <x-slot name="title">Trailer Episode
        </x-slot>
        <x-slot name="content">
            @if ($episode)
                <div class="flex space-x-4 space-y-2 m-2">
                    @foreach ($episode->trailers as $trailer)
                        <x-jet-button wire:click="deleteTrailer({{ $trailer->id }})"
                            class="bg-indigo-500 hover:bg-red-500">
                            {{ $trailer->name }}
                        </x-jet-button>
                    @endforeach
                </div>
            @endif
            <div class="mt-5 sm:mt-0">
                <div class="mt-1 md:mt-0 md:col-span-2">
                    <form>
                        <div class="shadow overflow-hidden sm:rounded-md">
                            <div class="px-1 py-1 bg-white sm:p-6">
                                <div class="mb-4">
                                    <label class="block text-md font-bold text-black">
                                        Name
                                    </label>
                                    <input wire:model="trailerName" type="text"
                                        class="mt-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                                    @error('trailerName')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label class="block text-md font-bold text-black">
                                        Embed HTML
                                    </label>
                                    <input wire:model="embedHtml" type="text"
                                        class="mt-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                                    @error('embedHtml')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </x-slot>
        <x-slot name="footer">
            <x-m-button wire:click="addTrailer" class="bg-green-600 hover:bg-green-700 text-white">
                Add Trailer
            </x-m-button>
            <x-m-button wire:click="closeTrailerModal" class="bg-gray-600 ml-3 hover:bg-gray-800 text-white">
                Cancel
            </x-m-button>
        </x-slot>
    </x-jet-dialog-modal>
</section>
