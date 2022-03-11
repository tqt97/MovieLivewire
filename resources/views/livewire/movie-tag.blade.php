<div>
    <div class="flex flex-wrap my-2 space-x-2">
        @forelse ($movie->tags as $mtag)
            <x-jet-button wire:click="detachTag({{ $mtag->id }})" class="hover:bg-red-500">
                {{ $mtag->tag_name }}
            </x-jet-button>
        @empty
            No tag
        @endforelse
    </div>
    <input wire:model="queryTag" type="text" class="w-full rounded" placeholder="Search Tag">
    @if (!empty($queryTag))
        <div class="w-full">
            @if (!empty($tags))
                @foreach ($tags as $tag)
                    <div wire:click="addTag({{ $tag->id }})"
                        class="w-full m-2 p-2 rounded bg-indigo-300 hover:bg-indigo-400 cursor-pointer">
                        {{ $tag->tag_name }}
                    </div>
                @endforeach
            @endif
        </div>
    @endif
</div>
