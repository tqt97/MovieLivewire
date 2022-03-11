<section class="container mx-auto p-6 font-mono">
    <div class="w-full flex mb-2 py-2 justify-start">
        <x-jet-button wire:click="showCreateModal">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
            </svg>
            &nbsp;Create Tag
        </x-jet-button>
    </div>
    <div class="my-2 flex sm:flex-row flex-col">
        <div class="flex flex-row mb-1 sm:mb-0">
            <div class="relative">
                <select wire:model="sort"
                    class="h-full rounded-r border-t sm:rounded-r-none sm:border-r-0 border-r border-b block  w-full bg-white border-gray-400 text-gray-700 py-2 px-4 pr-8 leading-tight focus:outline-none  focus:border-r focus:bg-white ">
                    <option value="asc">Asc</option>
                    <option value="desc">Desc</option>
                </select>
            </div>
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
    <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
        <div class="w-full overflow-x-auto ">
            <table class="w-full">
                <thead>
                    <tr
                        class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-300 uppercase border-b border-gray-600 rounded-full">
                        <th class="px-4 py-3 text-center">ID</th>
                        <th class="px-4 py-3">Tag name</th>
                        <th class="px-4 py-3">Slug</th>
                        <th class="px-4 py-3">Created at</th>
                        <th class="px-4 py-3 text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @forelse ($tags as $tag)
                        <tr class="text-gray-700">
                            <td class="px-4 py-1 border text-center">
                                {{ $tag->id }}
                            </td>
                            <td class="px-4 py-1 border">
                                {{ $tag->tag_name }}
                            </td>
                            <td class="px-4 py-1 text-ms border">{{ $tag->slug }}</td>
                            <td class="px-4 py-1 text-ms border">{{ $tag->created_at }}</td>
                            <td class="px-4 py-1 text-sm border text-center">
                                <x-m-button wire:click="showEditModal({{ $tag->id }})"
                                    class="bg-green-600 hover:bg-green-500 focus:bg-green-500 active:bg-green-500 text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </x-m-button>
                                <x-m-button wire:click="delete({{ $tag->id }})"
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
            @if ($tags->count())
                <div class="m-2 p-2">
                    {{ $tags->links() }}
                </div>
            @endif
        </div>
    </div>
    <x-jet-dialog-modal wire:model="showTagModal">
        @if ($Id)
            <x-slot name="title">UPDATE</x-slot>
        @else
            <x-slot name="title">CREATE</x-slot>
        @endif
        <x-slot name="content">
            <div class="mt-10 sm:mt-0">
                <div class="mt-5 md:mt-0 md:col-span-2">
                    <form>
                        <div class="shadow overflow-hidden sm:rounded-md">
                            <div class="px-2 py-2 bg-white sm:p-6">
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="first-name" class="block text-sm font-medium text-black">Tag
                                        name</label>
                                    <input wire:model="tag_name" type="text" autocomplete="given-name"
                                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </x-slot>
        <x-slot name="footer">
            @if ($Id)
                <x-jet-button wire:click="update"
                    class="bg-indigo-700 hover:bg-indigo-800 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring focus:ring-indigo-300 text-white ml-3">
                    Update
                </x-jet-button>
            @else
                <x-jet-button wire:click="create"
                    class="bg-indigo-700 hover:bg-indigo-800 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring focus:ring-indigo-300 text-white ml-3">
                    Create
                </x-jet-button>
            @endif
            <x-jet-secondary-button wire:click="closeTagModal" class="ml-3">
                Cancel
            </x-jet-secondary-button>

        </x-slot>
    </x-jet-dialog-modal>
</section>
