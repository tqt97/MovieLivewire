<section class="container mx-auto">

    <x-backend.generate>
        <x-slot name="input">
            <input wire:model="castTMDBId" class="px-3 py-2 border border-gray-300 rounded" placeholder="Cast ID" />
        </x-slot>
        <x-backend.button.generate wire:click="generateCast">
            <x-backend.icon.spin wire:loading wire:target="generateCast" />
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
            @forelse ($casts as $tcast)
                <x-backend.table.tbody-tr>
                    <x-backend.table.td-left>
                        {{ $tcast->name }}
                    </x-backend.table.td-left>
                    <x-backend.table.td-center class="flex justify-center items-center py-1">
                        <img src="https://image.tmdb.org/t/p/w500/{{ $tcast->poster_path }}"
                            alt="{{ $tcast->title }}" class="w-12 h-12 rounded">
                    </x-backend.table.td-center>
                    <x-backend.table.td-center>
                        {{ $tcast->created_at }}
                    </x-backend.table.td-center>
                    <x-backend.table.td-center>
                        <x-backend.button.edit wire:click="showEditModal({{ $tcast->id }})" />
                        <x-backend.button.delete wire:click="deleteCast({{ $tcast->id }})" />
                    </x-backend.table.td-center>
                </x-backend.table.tbody-tr>
            @empty
                <x-backend.no-result :colspan="4" />
            @endforelse
        </x-slot>
        <x-slot name="pagination">
            <x-backend.pagination :pagination="$casts" />
        </x-slot>
    </x-backend.table.table>
    <x-jet-dialog-modal wire:model="showCastModal">
        <x-slot name="title">Update Cast</x-slot>
        <x-slot name="content">
            <div class="mt-10 sm:mt-0">
                <div class="mt-5 md:mt-0 md:col-span-2">
                    <form>
                        <div class="shadow overflow-hidden sm:rounded-md">
                            <div class="px-4 py-5 bg-white sm:p-6">
                                <div class="grid grid-cols-6 gap-6">
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="first-name" class="block text-sm font-medium text-gray-700">Cast
                                            name</label>
                                        <input wire:model="name" type="text"
                                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                                        @error('name')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="first-name" class="block text-sm text-gray-700">Cast
                                            Poster</label>
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
            <x-m-button wire:click="updateCast" class="bg-green-600 hover:bg-green-700 text-white">Update</x-m-button>
            <x-m-button wire:click="closeCastModal" class="bg-gray-600 ml-3 hover:bg-gray-800 text-white">Cancel
            </x-m-button>

        </x-slot>
    </x-jet-dialog-modal>
</section>
