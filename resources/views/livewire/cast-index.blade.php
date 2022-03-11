<section class="container mx-auto p-6 font-mono">
    <div class="w-full flex mb-4 justify-start">
        <form class="flex space-x-4 shadow1 bg-white1 rounded-md">
            <div class="py-1 flex items-center">
                {{-- <label for="tmdb_id_g" class="block text-sm font-medium text-gray-700 mr-4">Cast Tmdb Id</label> --}}
                <div class="relative rounded-md shadow-sm">
                    <input wire:model="castTMDBId" id="tmdb_id_g" name="tmdb_id_g"
                        class="px-3 py-2 border border-gray-300 rounded" placeholder="Cast ID" />
                </div>
            </div>
            <div class="py-1">
                <button type="button" wire:click="generateCast"
                    class="inline-flex items-center justify-center py-2 px-4 border border-transparent text-base leading-6 font-medium rounded-md text-white bg-green-600 hover:bg-green-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-green-700 transition duration-150 ease-in-out disabled:opacity-50">
                    <span>Generate</span>
                </button>
            </div>
        </form>
    </div>

    <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
        <x-search></x-search>

        <div class="w-full overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr
                        class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
                        <th class="px-4 py-3">TMDB ID</th>
                        <th class="px-4 py-3">Name</th>
                        <th class="px-4 py-3">Slug</th>
                        <th class="px-4 py-3">Poster</th>
                        <th class="px-4 py-3 text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @forelse ($casts as $cast)
                        <tr class="text-gray-700">
                            <td class="px-4 py-3 border">
                                {{ $cast->tmdb_id }}
                            </td>
                            <td class="px-4 py-3 border">
                                {{ $cast->name }}
                            </td>
                            <td class="px-4 py-3 border">
                                {{ $cast->slug }}
                            </td>
                            <td class="px-4 py-3 border">
                                <img src="https://image.tmdb.org/t/p/w500/{{ $cast->poster_path }}"
                                    alt="{{ $cast->name }}" class="w-12 h-12 rounded">
                            </td>

                            <td class="px-4 py-3 border text-center">
                                <x-m-button wire:click="showEditModal({{ $cast->id }})"
                                    class="bg-green-600 hover:bg-green-500 focus:bg-green-500 active:bg-green-500 text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </x-m-button>
                                <x-m-button wire:click="deleteCast({{ $cast->id }})"
                                    class="bg-red-600 hover:bg-red-500 focus:bg-red-500 active:bg-red-500 text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </x-m-button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <th class="px-4 py-3" colspan="5">No result</th>
                        </tr>
                    @endforelse
                </tbody>

            </table>
            @if ($casts->count())
                <div class="m-2 p-2">
                    {{ $casts->links() }}
                </div>
            @endif
        </div>
    </div>
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
