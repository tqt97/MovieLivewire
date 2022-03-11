<section class="container mx-auto p-6 font-sans">
    <div class="w-full flex mb-4 justify-start">
        <form class="flex space-x-4 shadow1 bg-white1 rounded-md">
            <div class="py-1 flex items-center">
                <div class="relative rounded-md shadow-sm">
                    <input wire:model="tmdb_id" class="px-3 py-2 border border-gray-300 rounded" placeholder="TMDB ID" />
                </div>
            </div>
            <div class="py-1">
                <button type="button" wire:click="generateMovie"
                    class="inline-flex items-center justify-center py-2 px-4 border border-transparent text-base leading-6 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-green-700 transition duration-150 ease-in-out disabled:opacity-50">
                    <svg wire:loading wire:target="generateMovie" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                        </circle>
                        <path class="opacity-75" fill="currentColor"
                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                        </path>
                    </svg>
                    <span>Generate</span>
                </button>
            </div>
        </form>
    </div>
    <x-search></x-search>
    {{-- <div class="w-full shadow py-5 bg-white">
        <div>
            <div class="flex justify-between">
                <div class="flex-1">
                    <div class="relative">
                        <div class="absolute flex items-center ml-2 h-full">
                            <svg class="w-4 h-4 fill-current text-primary-gray-dark" viewBox="0 0 16 16" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M15.8898 15.0493L11.8588 11.0182C11.7869 10.9463 11.6932 10.9088 11.5932 10.9088H11.2713C12.3431 9.74952 12.9994 8.20272 12.9994 6.49968C12.9994 2.90923 10.0901 0 6.49968 0C2.90923 0 0 2.90923 0 6.49968C0 10.0901 2.90923 12.9994 6.49968 12.9994C8.20272 12.9994 9.74952 12.3431 10.9088 11.2744V11.5932C10.9088 11.6932 10.9495 11.7869 11.0182 11.8588L15.0493 15.8898C15.1961 16.0367 15.4336 16.0367 15.5805 15.8898L15.8898 15.5805C16.0367 15.4336 16.0367 15.1961 15.8898 15.0493ZM6.49968 11.9994C3.45921 11.9994 0.999951 9.54016 0.999951 6.49968C0.999951 3.45921 3.45921 0.999951 6.49968 0.999951C9.54016 0.999951 11.9994 3.45921 11.9994 6.49968C11.9994 9.54016 9.54016 11.9994 6.49968 11.9994Z">
                                </path>
                            </svg>
                        </div>
                        <input wire:model="search" type="text" placeholder="Search by title"
                            class="px-8 py-3 w-full md:w-2/6 rounded-md bg-gray-100 border-transparent focus:border-gray-500 focus:bg-white focus:ring-0 text-sm" />
                    </div>
                </div>
                <div class="flex">
                    <select wire:model="perPage"
                        class="pr-10 py-3 w-full rounded-md bg-gray-100 border-transparent focus:border-gray-500 focus:bg-white focus:ring-0 text-sm">
                        <option value="5">5 Per Page</option>
                        <option value="10">10 Per Page</option>
                        <option value="15">15 Per Page</option>
                    </select>
                </div>
            </div>
        </div>
    </div> --}}
    <x-wrapper>
        <table class="w-full table-auto">
            <x-thead-tr>
                <x-th class="cursor-pointer" wire:click="sortByColumn('title')">
                    <div class="flex space-x-4 items-center self-center justify-between content-center">
                        <span> Title </span>
                        @if (!$sortColumn || ($sortColumn == 'title' && $sortDirection == 'asc'))
                            <x-sort-asc></x-sort-asc>
                        @else
                            <x-sort-desc></x-sort-desc>
                        @endif
                    </div>
                </x-th>
                <x-th class="text-center">Poster</x-th>
                <x-th class="cursor-pointer text-center" wire:click="sortByColumn('rating')">
                    <div class="flex space-x-4 items-center self-center justify-between content-center">
                        <span> Rating </span>
                        @if (!$sortColumn || ($sortColumn == 'rating' && $sortDirection == 'asc'))
                            <x-sort-asc></x-sort-asc>
                        @else
                            <x-sort-desc></x-sort-desc>
                        @endif
                    </div>
                </x-th>
                <x-th class="text-center">Runtime</x-th>
                <x-th class="text-center">Release date</x-th>
                <x-th class="text-center">Published</x-th>
                <x-th class="text-center">Action</x-th>
            </x-thead-tr>
            <tbody>
                @forelse ($movies as $table_movie)
                    <tr class="bg-gray-50 border-t border-indigo-100 shadow">
                        <x-td class="text-left">
                            <span wire:click="showMovieDetail({{ $table_movie->id }})"
                                class="text-blue-800 font-bold hover:text-blue-900 cursor-pointer">
                                {{ $table_movie->title }}
                            </span>
                        </x-td>
                        <x-td class="text-ms flex justify-center items-center py-1">
                            <img src="https://image.tmdb.org/t/p/w500/{{ $table_movie->poster_path }}"
                                alt="{{ $table_movie->title }}" class="w-12 h-12 rounded">
                        </x-td>
                        <x-td>
                            {{ $table_movie->rating }}
                        </x-td>
                        <x-td>
                            {{ date('H:i', mktime(0, $table_movie->runtime)) }}
                        </x-td>
                        <x-td>
                            {{ $table_movie->release_date }}
                        </x-td>
                        <x-td>
                            @if ($table_movie->is_public)
                                <span
                                    class="px-2 inline-flex text-xs leading-5 rounded-full bg-green-100 text-green-800">
                                    Published
                                </span>
                            @else
                                <span class="px-2 inline-flex text-xs leading-5 rounded-full bg-red-100 text-red-800">
                                    UnPublished
                                </span>
                            @endif
                        </x-td>

                        <x-td class="text-center ">
                            <x-m-button wire:click="showTrailerModal({{ $table_movie->id }})"
                                class="bg-indigo-600 hover:bg-indigo-700  focus:bg-indigo-700 active:bg-indigo-700 text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                </svg>
                            </x-m-button>
                            <x-m-button wire:click="showEditModal({{ $table_movie->id }})"
                                class="bg-blue-600 hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-700 text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </x-m-button>
                            <x-m-button wire:click="deleteMovie({{ $table_movie->id }})"
                                class="bg-red-600 hover:bg-red-700 focus:bg-red-700 active:bg-red-700 text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </x-m-button>
                        </x-td>
                    </tr>
                @empty
                    <tr>
                        <th class="px-4 py-3" colspan="9">No result</th>
                    </tr>
                @endforelse
            </tbody>
        </table>
        @if ($movies->count())
            <div class="m-2 p-2">
                {{ $movies->links() }}
            </div>
        @endif
    </x-wrapper>

    {{-- Modal Edit --}}
    <x-jet-dialog-modal wire:model="showMovieModal">
        <x-slot name="title">Update Movie</x-slot>
        <x-slot name="content">
            <div class="mt-5 sm:mt-0">
                <div class="mt-1 md:mt-0 md:col-span-2" x-data="{tab:0}">
                    <div class="flex bg-indigo-500 shadow overflow-hidden rounded-md mb-2">
                        <button class="border px-4 py-2 w-full text-white font-bold" x-on:click.prevent="tab=0">
                            Form
                        </button>
                        <button class="border px-4 py-2 w-full text-white font-bold" x-on:click.prevent="tab=1">
                            Tags
                        </button>
                        <button class="border px-4 py-2 w-full text-white font-bold" x-on:click.prevent="tab=2">
                            Casts
                        </button>
                    </div>
                    <div>
                        <div class="space-x-2" x-show="tab===0">
                            <form>
                                <div class="shadow overflow-hidden sm:rounded-md">
                                    <div class="px-1 py-1 bg-white sm:p-6">
                                        <div class="mb-4">
                                            <label class="block text-md font-bold text-black">
                                                Title
                                            </label>
                                            <input wire:model="title" type="text"
                                                class="mt-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                                            @error('title')
                                                <span class="text-red-500 text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-4">
                                            <label class="block text-md font-bold text-black">
                                                Runtime
                                            </label>
                                            <input wire:model="runtime" type="text"
                                                class="mt-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                                            @error('runtime')
                                                <span class="text-red-500 text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-4">
                                            <label class="block text-md font-bold text-black">
                                                Language
                                            </label>
                                            <input wire:model="lang" type="text"
                                                class="mt-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                                            @error('lang')
                                                <span class="text-red-500 text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-4">
                                            <label class="block text-md font-bold text-black">
                                                Video format
                                            </label>
                                            <input wire:model="video_format" type="text"
                                                class="mt-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                                            @error('video_format')
                                                <span class="text-red-500 text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-4">
                                            <label class="block text-md font-bold text-black">
                                                Rating
                                            </label>
                                            <input wire:model="rating" type="text"
                                                class="mt-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                                            @error('rating')
                                                <span class="text-red-500 text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-4">
                                            <label class="block text-md font-bold text-black">
                                                Poster
                                            </label>
                                            <input wire:model="poster_path" type="text"
                                                class="mt-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                                            @error('poster_path')
                                                <span class="text-red-500 text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-4">
                                            <label class="block text-md font-bold text-black">
                                                Backdrop
                                            </label>
                                            <input wire:model="backdrop_path" type="text"
                                                class="mt-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                                            @error('backdrop_path')
                                                <span class="text-red-500 text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-4">
                                            <label class="block text-md font-bold text-black">
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
                            </form>
                        </div>
                        <div class="space-x-2" x-show="tab===1">
                            @if ($movie)
                                <livewire:movie-tag :movie="$movie" />
                            @endif
                        </div>
                        <div class="space-x-2" x-show="tab===2">
                            @if ($movie)
                                <livewire:movie-cast :movie="$movie" />
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-m-button wire:click="updateMovie" class="bg-green-600 hover:bg-green-700 text-white">
                Update
            </x-m-button>
            <x-m-button wire:click="closeMovieModal" class="bg-gray-600 ml-3 hover:bg-gray-800 text-white">
                Cancel
            </x-m-button>
        </x-slot>
    </x-jet-dialog-modal>
    {{-- Modal Trailer --}}
    <x-jet-dialog-modal wire:model="showTrailer">
        <x-slot name="title">Trailer movie
        </x-slot>
        <x-slot name="content">
            @if ($movie)
                <div class="flex space-x-4 space-y-2 m-2">
                    @foreach ($movie->trailers as $trailer)
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
    {{-- Modal Detail --}}
    <x-jet-dialog-modal wire:model="showMovieDetailModal">
        <x-slot name="title">Movie Detail</x-slot>
        <x-slot name="content">
            <div class="mt-2 sm:mt-0 rounded-sm shadow-sm">
                <div class="mt-1 md:mt-0 md:col-span-2 ">
                    @if ($movie)
                        <dl class="">
                            <div
                                class="border-t border-gray-300  px-1 py-2 bg-white sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-bold font-bold text-black">ID</dt>
                                <dd class="mt-1 text-bold text-gray-900 sm:mt-0 sm:col-span-2">{{ $movie->id }}
                                </dd>
                            </div>
                            <div
                                class="border-t border-gray-300  px-1 py-2 bg-white sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-bold font-bold text-black">TMDB ID</dt>
                                <dd class="mt-1 text-bold text-gray-900 sm:mt-0 sm:col-span-2">{{ $movie->tmdb_id }}
                                </dd>
                            </div>
                            <div
                                class="border-t border-gray-300  px-1 py-2 bg-white sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-bold font-bold text-black">Title</dt>
                                <dd class="mt-1 text-bold text-gray-900 sm:mt-0 sm:col-span-2">{{ $movie->title }}
                                </dd>
                            </div>
                            <div
                                class="border-t border-gray-300  px-1 py-2 bg-white sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-bold font-bold text-black">Poster</dt>
                                <dd class="mt-1 text-bold text-gray-900 sm:mt-0 sm:col-span-2">
                                    <img src="https://image.tmdb.org/t/p/w500/{{ $movie->poster_path }}"
                                        alt="{{ $movie->title }}" class="w-24 h-32 rounded">
                                </dd>
                            </div>
                            <div
                                class="border-t border-gray-300  px-1 py-2 bg-white sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-bold font-bold text-black">Release Date</dt>
                                <dd class="mt-1 text-bold text-gray-900 sm:mt-0 sm:col-span-2">
                                    {{ $movie->release_date }}</dd>
                            </div>
                            <div
                                class="border-t border-gray-300  px-1 py-2 bg-white sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-bold font-bold text-black">Runtime</dt>
                                <dd class="mt-1 text-bold text-gray-900 sm:mt-0 sm:col-span-2">
                                    {{ date('H:i', mktime(0, $movie->runtime)) }}</dd>
                            </div>
                            <div
                                class="border-t border-gray-300  px-1 py-2 bg-white sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-bold font-bold text-black">Language</dt>
                                <dd class="mt-1 text-bold text-gray-900 sm:mt-0 sm:col-span-2">{{ $movie->lang }}
                                </dd>
                            </div>
                            <div
                                class="border-t border-gray-300  px-1 py-2 bg-white sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-bold font-bold text-black">Video format</dt>
                                <dd class="mt-1 text-bold text-gray-900 sm:mt-0 sm:col-span-2">
                                    {{ $movie->video_format }}
                                </dd>
                            </div>
                            <div
                                class="border-t border-gray-300  px-1 py-2 bg-white sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-bold font-bold text-black">Published</dt>
                                <dd class="mt-1 text-bold text-gray-900 sm:mt-0 sm:col-span-2">
                                    @if ($movie->is_public)
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 rounded-full bg-green-100 text-green-800">
                                            Published
                                        </span>
                                    @else
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 rounded-full bg-red-100 text-red-800">
                                            UnPublished
                                        </span>
                                    @endif
                                </dd>
                            </div>
                            <div
                                class="border-t border-gray-300  px-1 py-2 bg-white sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-bold font-bold text-black">Visits</dt>
                                <dd class="mt-1 text-bold text-gray-900 sm:mt-0 sm:col-span-2">
                                    {{ $movie->visits }}
                                </dd>
                            </div>
                            <div
                                class="border-t border-gray-300  px-1 py-2 bg-white sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-bold font-bold text-black">Rating</dt>
                                <dd class="mt-1 text-bold text-gray-900 sm:mt-0 sm:col-span-2">
                                    {{ $movie->rating }}
                                </dd>
                            </div>
                            <div
                                class="border-t border-gray-300  px-1 py-2 bg-white sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-bold font-bold text-black">Overview</dt>
                                <dd class="mt-1 text-bold text-gray-900 sm:mt-0 sm:col-span-2">
                                    <p class="w-full text-justify">{{ $movie->overview }}</p>
                                </dd>
                            </div>
                        </dl>
                    @endif

                </div>
            </div>

        </x-slot>
        <x-slot name="footer">
            <x-m-button wire:click="closeTrailerModal" class="bg-gray-600 p-4 hover:bg-gray-800 text-white">
                Close
            </x-m-button>
        </x-slot>
    </x-jet-dialog-modal>
</section>
