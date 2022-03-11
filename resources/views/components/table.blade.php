<div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
    <div class="w-full overflow-x-auto1">
        <table class="w-full table-auto">
            <thead>
                <tr
                    class="text-md font-semibold tracking-wide text-left text-white bg-indigo-600 uppercase border-b border-gray-100 rounded-full">
                    <th class="px-4 py-3 text-center border border-indigo-500">ID</th>
                    <th class="px-4 py-3 text-center border border-indigo-500">TMDB ID</th>
                    <th class="px-4 py-3 border border-indigo-500 cursor-pointer" wire:click="sortByColumn('title')">
                        <div class="flex space-x-4 items-center self-center justify-between content-center">
                            <span> Title </span>
                            @if (!$sortColumn || ($sortColumn == 'title' && $sortDirection == 'asc'))
                                <x-sort-asc></x-sort-asc>
                            @else
                                <x-sort-desc></x-sort-desc>
                            @endif
                        </div>
                    </th>
                    <th class="px-4 py-3 text-center border border-indigo-500 cursor-pointer"
                        wire:click="sortByColumn('rating')">
                        <div class="flex space-x-4 items-center self-center justify-between content-center">
                            <span> Rating </span>
                            @if (!$sortColumn || ($sortColumn == 'rating' && $sortDirection == 'asc'))
                                <x-sort-asc></x-sort-asc>
                            @else
                                <x-sort-desc></x-sort-desc>
                            @endif
                        </div>
                    </th>
                    <th class="px-4 py-3 text-center border border-indigo-500 cursor-pointer"
                        wire:click="sortByColumn('visits')">
                        <div class="flex space-x-4 items-center self-center justify-between content-center">
                            <span> Visits </span>
                            @if (!$sortColumn || ($sortColumn == 'visits' && $sortDirection == 'asc'))
                                <x-sort-asc></x-sort-asc>
                            @else
                                <x-sort-desc></x-sort-desc>
                            @endif
                    </th>
                    <th class="px-4 py-3 text-center border border-indigo-500 cursor-pointer"
                        wire:click="sortByColumn('runtime')">
                        <div class="flex space-x-4 items-center self-center justify-between content-center">
                            <span> Runtime </span>
                            @if (!$sortColumn || ($sortColumn == 'runtime' && $sortDirection == 'asc'))
                                <x-sort-asc></x-sort-asc>
                            @else
                                <x-sort-desc></x-sort-desc>
                            @endif
                        </div>
                    </th>
                    <th class="px-4 py-3 text-center border border-indigo-500">Published</th>
                    <th class="px-4 py-3 text-center border border-indigo-500">Poster</th>
                    <th class="px-4 py-3 text-center border border-indigo-500">Action</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @forelse ($movies as $table_movie)
                    <tr class="text-black">
                        <td class="px-4 py-1 border">
                            {{ $table_movie->id }}
                        </td>
                        <td class="px-4 py-1 border">
                            {{ $table_movie->tmdb_id }}
                        </td>
                        <td class="px-4 py-1 border">
                            <span wire:click="showMovieDetail({{ $table_movie->id }})"
                                class="text-blue-600 hover:text-blue-700 cursor-pointer font-bold">
                                {{ $table_movie->title }}
                            </span>
                        </td>
                        <td class="px-4 py-1 border text-center">
                            {{ $table_movie->rating }}
                        </td>
                        <td class="px-4 py-1 border text-center">
                            {{ $table_movie->visits }}
                        </td>
                        <td class="px-4 py-1 border text-center ">
                            {{ date('H:i', mktime(0, $table_movie->runtime)) }}
                        </td>
                        <td class="px-4 py-1 border text-center">
                            @if ($table_movie->is_public)
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
                        <td class="px-4 py-1 text-ms border flex justify-center items-center">
                            <img src="https://image.tmdb.org/t/p/w500/{{ $table_movie->poster_path }}"
                                alt="{{ $table_movie->title }}" class="w-12 h-12 rounded">
                        </td>
                        <td class="px-4 py-1 text-sm border text-center">
                            <x-m-button wire:click="showTrailerModal({{ $table_movie->id }})"
                                class="bg-indigo-600 hover:bg-indigo-500 focus:bg-indigo-500 active:bg-indigo-500 text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                </svg>
                            </x-m-button>
                            <x-m-button wire:click="showEditModal({{ $table_movie->id }})"
                                class="bg-blue-600 hover:bg-blue-500 focus:bg-blue-500 active:bg-blue-500 text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </x-m-button>
                            <x-m-button wire:click="deleteMovie({{ $table_movie->id }})"
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
                        <th class="px-4 py-3" colspan="9">No result</th>
                    </tr>
                @endforelse
            </tbody>
        </table>
        @if ($movies->count() > 4)
            <div class="m-2 p-2">
                {{ $movies->links() }}
            </div>
        @endif
    </div>
</div>

<x-wrapper>
    
</x-wrapper>
