<section class="container mx-auto">
    <div class="w-full flex mb-4 justify-start">
        <form class="flex space-x-4 shadow1 bg-white1 rounded-md">
            <div class="py-1">
                <button type="button" wire:click="generateGenre"
                    class="inline-flex items-center justify-center py-2 px-4 border border-transparent text-base leading-6 font-medium rounded-md text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:gray-indigo-700 focus:shadow-outline-indigo active:bg-gray-700 transition duration-150 ease-in-out disabled:opacity-50">
                    <x-backend.icon.spin wire:loading wire:target="generateGenre" />
                    <span>Generate</span>
                </button>
            </div>
        </form>
    </div>
    <x-search />
    <x-backend.table.table>
        <x-slot name="thead">
            <x-backend.table.th-sort wire:click="sortByColumn('name')">
                <span> Title </span>
                @if (!$sortColumn || ($sortColumn == 'title' && $sortDirection == 'asc'))
                    <x-backend.icon.sort-asc />
                @else
                    <x-backend.icon.sort-desc />
                @endif
            </x-backend.table.th-sort>
            <x-backend.table.th-center>Create at</x-backend.table.th-center>
            <x-backend.table.th-center>Action</x-backend.table.th-center>
        </x-slot>
        <x-slot name="tbody">
            @forelse ($genres as $tbl_genre)
                <x-backend.table.tbody-tr>
                    <x-backend.table.td-left>
                        {{ $tbl_genre->title }}
                    </x-backend.table.td-left>
                    <x-backend.table.td-center>
                        {{ $tbl_genre->created_at }}
                    </x-backend.table.td-center>
                    <x-backend.table.td-center>
                        <x-backend.button.edit wire:click="showEditModal({{ $tbl_genre->id }})" />
                        <x-backend.button.delete wire:click="deleteGenre({{ $tbl_genre->id }})" />
                    </x-backend.table.td-center>
                </x-backend.table.tbody-tr>
            @empty
                <x-backend.no-result :colspan="4" />
            @endforelse
        </x-slot>
        <x-slot name="pagination">
            <x-backend.pagination :pagination="$genres" />
        </x-slot>
    </x-backend.table.table>
    <x-jet-dialog-modal wire:model="showgenresModal">
        <x-slot name="title">Update Genre</x-slot>
        <x-slot name="content">
            <div class="mt-10 sm:mt-0">
                <div class="mt-5 md:mt-0 md:col-span-2">
                    <form>
                        <div class="shadow overflow-hidden sm:rounded-md">
                            <div class="px-4 py-5 bg-white sm:p-6">
                                <div class="grid grid-cols-6 gap-6">
                                    <div class="col-span-6 sm:col-span-3">
                                        <label class="block text-sm font-medium text-gray-700">
                                            Genre name</label>
                                        <input wire:model="title" type="text"
                                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                                        @error('title')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </x-slot>
        <x-slot name="footer">
            <x-m-button wire:click="updateGenre" class="bg-green-600 hover:bg-green-700 text-white">Update</x-m-button>
            <x-m-button wire:click="closeGenreModal" class="bg-gray-600 ml-3 hover:bg-gray-800 text-white">Cancel
            </x-m-button>
        </x-slot>
    </x-jet-dialog-modal>
</section>
