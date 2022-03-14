<section class="container mx-auto">
    <x-backend.generate>
        <x-slot name="input">
            <input wire:model="tmdb_id" class="px-3 py-2 border border-gray-500 hover:border-gray-500 rounded" placeholder="TMDB ID" />
        </x-slot>
        <x-backend.button.generate wire:click="generateMovie">
            <x-backend.icon.spin wire:loading wire:target="generateMovie" />
        </x-backend.button.generate>
    </x-backend.generate>
    <x-search />

    <x-backend.table.table>
        <x-slot name="thead">
            <x-backend.table.th-sort wire:click="sortByColumn('title')">
                <span> Title </span>
                @if (!$sortColumn || ($sortColumn == 'title' && $sortDirection == 'asc'))
                    <x-backend.icon.sort-asc />
                @else
                    <x-backend.icon.sort-desc />
                @endif
            </x-backend.table.th-sort>
            <x-backend.table.th-center>Poster</x-backend.table.th-center>
            <x-backend.table.th-center>Rating</x-backend.table.th-center>
            <x-backend.table.th-center>Runtime</x-backend.table.th-center>
            <x-backend.table.th-center>Release date</x-backend.table.th-center>
            <x-backend.table.th-center>Published</x-backend.table.th-center>
            <x-backend.table.th-center>Action</x-backend.table.th-center>
        </x-slot>
        <x-slot name="tbody">
            @forelse ($movies as $table_movie)
                <x-backend.table.tbody-tr>
                    <x-backend.table.td-left>
                        <span wire:click="showMovieDetail({{ $table_movie->id }})" title="Click to view detail"
                            class="flex-1 text-blue-800 font-bold hover:text-blue-900 hover:underline hover:decoration-blue-600 cursor-pointer">
                            {{ $table_movie->title }}
                        </span>
                        <span title="Show trailer movie" class="flex text-sm hover:animate-pulse px-4 z-10">
                            <x-backend.icon.trailer />
                        </span>
                        <a href="{{ url('/movies', $table_movie->slug) }}" target="_blank"
                            title="Link this movie to website" class="flex text-sm hover:animate-pulse px-4 z-10">
                            <x-backend.icon.eyes />
                        </a>
                    </x-backend.table.td-left>
                    <x-backend.table.td-center class="flex justify-center items-center py-1">
                        <img src="https://image.tmdb.org/t/p/w500/{{ $table_movie->poster_path }}"
                            alt="{{ $table_movie->title }}" class="w-12 h-12 rounded">
                    </x-backend.table.td-center>
                    <x-backend.table.td-center>
                        {{ $table_movie->rating }}
                    </x-backend.table.td-center>
                    <x-backend.table.td-center>
                        {{ date('H:i', mktime(0, $table_movie->runtime)) }}
                    </x-backend.table.td-center>
                    <x-backend.table.td-center>
                        {{ $table_movie->release_date }}
                    </x-backend.table.td-center>
                    <x-backend.table.td-center>
                        @if ($table_movie->is_public)
                            <x-backend.publish />
                        @else
                            <x-backend.unpublish />
                        @endif
                    </x-backend.table.td-center>
                    <x-backend.table.td-center>
                        <x-backend.button.trailer wire:click="showTrailerModal({{ $table_movie->id }})" />
                        <x-backend.button.edit wire:click="showEditModal({{ $table_movie->id }})" />
                        <x-backend.button.delete wire:click="deleteMovie({{ $table_movie->id }})" />
                    </x-backend.table.td-center>
                </x-backend.table.tbody-tr>
            @empty
                <x-backend.no-result colspan="9" />
            @endforelse
        </x-slot>
        <x-slot name="pagination">
            <x-backend.pagination :pagination="$movies" />
        </x-slot>
    </x-backend.table.table>


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
                                            <textarea wire:model="overview" class="mt-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
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
