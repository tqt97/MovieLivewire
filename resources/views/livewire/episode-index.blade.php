<section class="container mx-auto p-6 font-mono">
    <div class="w-full flex mb-4 justify-start">
        <form class="flex space-x-4 shadow1 bg-white1 rounded-md">
            <div class="py-1 flex items-center">
                <div class="relative rounded-md shadow-sm">
                    <input wire:model="episode_number" class="px-3 py-2 border border-gray-300 rounded"
                        placeholder="Episode number" />
                </div>
            </div>
            <div class="py-1">
                <button type="button" wire:click="generateEpisode"
                    class="inline-flex items-center justify-center py-2 px-4 border border-transparent text-base leading-6 font-medium rounded-md text-white bg-green-600 hover:bg-green-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-green-700 transition duration-150 ease-in-out disabled:opacity-50">
                    <span>Generate</span>
                </button>
            </div>
        </form>
    </div>

    <x-search></x-search>
    <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
        <div class="w-full overflow-x-auto1">
            <table class="w-full">
                <thead>
                    <tr
                        class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">

                        <th class="px-4 py-2">Name</th>
                        <th class="px-4 py-2">Episode number</th>
                        <th class="px-4 py-2">Slug</th>
                        <th class="px-4 py-2">Public</th>
                        <th class="px-4 py-2 text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @forelse ($episodes as $tb_episode)
                        <tr class="text-gray-700">

                            <td class="px-4 py-3 border">
                                {{ $tb_episode->name }}
                            </td>
                            <td class="px-4 py-3 border">
                                {{ $tb_episode->tb_episode_number }}
                            </td>
                            <td class="px-4 py-3 border">
                                {{ $tb_episode->slug }}
                            </td>
                            <td class="px-4 py-3 border">
                                @if ($tb_episode->is_public)
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Published
                                    </span>
                                @else
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                        UnPublished
                                    </span>
                                @endif
                            </td>
                            <td class="px-4 py-3 border text-center">
                                <x-m-button wire:click="showTrailerModal({{ $tb_episode->id }})"
                                    class="bg-indigo-600 hover:bg-indigo-700  focus:bg-indigo-700 active:bg-indigo-700 text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                    </svg>
                                </x-m-button>
                                <x-m-button wire:click="showEditModal({{ $tb_episode->id }})"
                                    class="bg-green-600 hover:bg-green-500 focus:bg-green-500 active:bg-green-500 text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </x-m-button>
                                <x-m-button wire:click="deleteEpisode({{ $tb_episode->id }})"
                                    class="bg-red-600 hover:bg-red-500 focus:bg-red-500 active:bg-red-500 text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </x-m-button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <th class="px-4 py-3" colspan="7">No result</th>
                        </tr>
                    @endforelse
                </tbody>

            </table>
            @if ($episodes->count())
                <div class="m-2 p-2">
                    {{ $episodes->links() }}
                </div>
            @endif
        </div>
    </div>
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
                                        <textarea wire:model="overview"
                                            class="mt-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
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
