<div>
    <div class="flex flex-wrap my-2 space-x-2">
        @forelse ($movie->casts as $mcast)
            <x-jet-button wire:click="detachCast({{ $mcast->id }})" class="hover:bg-red-500">
                {{ $mcast->name }}
            </x-jet-button>
        @empty
            No cast
        @endforelse
    </div>
    <input wire:model="queryCast" type="text" class="w-full rounded" placeholder="Search Tag">
    @if (!empty($queryCast))
        <div class="w-full">
            @if (!empty($casts))
                @foreach ($casts as $cast)
                    <div wire:click="addCast({{ $cast->id }})"
                        class="w-full m-2 p-2 rounded bg-indigo-300 hover:bg-indigo-400 cursor-pointer">
                        {{ $cast->name }}
                    </div>
                @endforeach
            @endif
        </div>
    @endif
</div>
