<x-front-layout>
    <main class="max-w-6xl mx-auto mt-6 min-h-screen">
        <section class="bg-gray-200 dark:bg-gray-900 text-white mt-4 p-2 pb-4 rounded shadow">
            <div class="m-2 p-2 text-2xl font-bold text-indigo-600 dark:text-indigo-100">
                <h1>{{ $genre->title }}</h1>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4 rounded">
                @foreach ($movies as $movie)
                    <x-movie-card>
                        <x-slot name="image">
                            <a href="{{ route('movies.show', $movie->slug) }}">
                                <div class="aspect-w-2 aspect-h-3">
                                    <img src="https://image.tmdb.org/t/p/w500/{{ $movie->poster_path }}" alt=""
                                        class="object-cover">
                                    <div
                                        class="absolute left-1 top-1 h-6 w-12 text-yellow-500 text-center rounded group-hover:text-yellow-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="absolute inset-0 z-10 bg-gradient-to-t from-black to-transparent"></div>
                                <div
                                    class="absolute inset-y-0 left-5 z-10 invisible group-hover:visible flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 rounded"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <div
                                        class="absolute transition opacity-0 duration-500 ease-in-out transform group-hover:opacity-100 group-hover:translate-x-16 group-hover:pr-2 text-white font-bold">
                                        PLAY
                                    </div>
                                </div>
                                <div
                                    class="absolute z-10 bottom-2 left-2 text-indigo-300 text-sm font-bold group-hover:text-indigo-500">
                                    @foreach ($movie->genres as $genre)
                                        {{ $genre->title }}
                                    @endforeach
                                </div>
                            </a>
                        </x-slot>
                        <a href="{{ route('movies.show', $movie->slug) }}"
                            class="dark:text-white font-bold group-hover:text-blue-600 text-center justify-center w-full">
                            {{ $movie->title }}
                        </a>
                    </x-movie-card>
                @endforeach
            </div>
            <div class="m-2 p-2">
                {{ $movies->links() }}
            </div>
        </section>
    </main>
</x-front-layout>
