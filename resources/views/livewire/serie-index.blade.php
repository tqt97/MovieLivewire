<section class="container mx-auto">
    <x-backend.generate>
        <x-slot name="input">
            <input wire:model="tmdbId" id="tmdb_id_g" name="tmdb_id_g" class="px-3 py-2 border border-gray-300 rounded"
                placeholder="Serie ID" />
        </x-slot>
        <x-backend.button.generate wire:click="generateSerie">
            <x-backend.icon.spin wire:loading wire:target="generateSerie" />
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
            <x-backend.table.th-center>Poster</x-backend.table.th-center>
            <x-backend.table.th-center>Create at</x-backend.table.th-center>
            <x-backend.table.th-center>Action</x-backend.table.th-center>
        </x-slot>
        <x-slot name="tbody">
            @forelse ($series as $tbl_serie)
                <x-backend.table.tbody-tr>
                    <x-backend.table.td-left>
                        {{ $tbl_serie->name }}
                    </x-backend.table.td-left>
                    <x-backend.table.td-center class="flex justify-center items-center py-1">
                        <img src="https://image.tmdb.org/t/p/w500/{{ $tbl_serie->poster_path }}"
                            alt="{{ $tbl_serie->name }}" class="w-12 h-12 rounded">
                    </x-backend.table.td-center>
                    <x-backend.table.td-center>
                        {{ $tbl_serie->created_at }}
                    </x-backend.table.td-center>
                    <x-backend.table.td-center>
                        <a href="{{ route('admin.seasons.index', $tbl_serie->id) }}">
                            <x-backend.button.option />
                        </a>
                        <x-backend.button.edit wire:click="showEditModal({{ $tbl_serie->id }})" />
                        <x-backend.button.delete wire:click="deleteSerie({{ $tbl_serie->id }})" />
                    </x-backend.table.td-center>
                </x-backend.table.tbody-tr>
            @empty
                <x-backend.no-result :colspan="6" />
            @endforelse
        </x-slot>
        <x-slot name="pagination">
            <x-backend.pagination :pagination="$series" />
        </x-slot>
    </x-backend.table.table>

    <x-jet-dialog-modal wire:model="showSerieModal">
        <x-slot name="title">Update serie</x-slot>
        <x-slot name="content">
            <div class="mt-10 sm:mt-0">
                <div class="mt-5 md:mt-0 md:col-span-2">
                    <form>
                        <div class="shadow overflow-hidden sm:rounded-md">
                            <div class="px-4 py-5 bg-white sm:p-6">
                                <div class="gap-6">
                                    <div class="col-span-6 sm:col-span-3">
                                        <label class="block text-sm font-medium text-gray-700">
                                            Serie name</label>
                                        <input wire:model="name" type="text"
                                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                                        @error('name')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label class="block text-sm font-medium text-gray-700">
                                            Created year
                                        </label>
                                        <input wire:model="created_year" type="text"
                                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                                        @error('created_year')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label class="block text-sm font-medium text-gray-700">
                                            Poster path
                                        </label>
                                        <input wire:model="poster_path" type="text"
                                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                                        @error('poster_path')
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
            <x-m-button wire:click="updateSerie" class="bg-green-600 hover:bg-green-700 text-white">Update</x-m-button>
            <x-m-button wire:click="closeSerieModal" class="bg-gray-600 ml-3 hover:bg-gray-800 text-white">Cancel
            </x-m-button>
        </x-slot>
    </x-jet-dialog-modal>
</section>
