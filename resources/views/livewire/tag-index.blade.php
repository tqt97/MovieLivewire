<section class="container mx-auto">
    <div class="w-full flex mb-2 py-2 justify-start">
        <x-jet-button wire:click="showCreateModal">
            <x-backend.icon.plus />
            &nbsp;Create Tag
        </x-jet-button>
    </div>
    <x-search />
    <x-backend.table.table>
        <x-slot name="thead">
            <x-backend.table.th-sort wire:click="sortByColumn('tag_name')">
                <span> Tag Name </span>
                @if (!$sortColumn || ($sortColumn == 'tag_name' && $sortDirection == 'asc'))
                    <x-backend.icon.sort-asc />
                @else
                    <x-backend.icon.sort-desc />
                @endif
            </x-backend.table.th-sort>
            <x-backend.table.th-center>Created at</x-backend.table.th-center>
            <x-backend.table.th-center>Action</x-backend.table.th-center>
        </x-slot>
        <x-slot name="tbody">
            @forelse ($tags as $tag)
                <x-backend.table.tbody-tr>
                    <x-backend.table.td-left>
                        {{ $tag->tag_name }}
                    </x-backend.table.td-left>
                    <x-backend.table.td-center>
                        {{ $tag->created_at }}
                    </x-backend.table.td-center>
                    <x-backend.table.td-center>
                        <x-backend.button.edit wire:click="showEditModal({{ $tag->id }})" />
                        <x-backend.button.delete wire:click="delete({{ $tag->id }})" />
                    </x-backend.table.td-center>
                </x-backend.table.tbody-tr>
            @empty
                <x-backend.no-result :colspan="3" />
            @endforelse
        </x-slot>
        <x-slot name="pagination">
            <x-backend.pagination :pagination="$tags" />
        </x-slot>
    </x-backend.table.table>
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
