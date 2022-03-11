<x-front-layout>
    <main class="max-w-6xl mx-auto mt-6 min-h-screen">

        <section class="bg-gray-200 dark:bg-gray-900 text-white mt-4 p-2 pb-4 rounded shadow">
            <div class="m-2 p-2 text-2xl font-bold text-indigo-600 dark:text-indigo-100">
                <h1>Series</h1>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4 rounded">
                @foreach ($series as $serie)
                    <x-movie-card>
                        <x-slot name="image">
                            <a href="{{ route('series.show', $serie->slug) }}">
                                <div class="aspect-w-2 aspect-h-3">
                                    <img src="https://image.tmdb.org/t/p/w500/{{ $serie->poster_path }}"
                                        alt="{{ $serie->name }}" class="object-cover">
                                    <div
                                        class="absolute left-1 top-1 h-6 w-12 text-yellow-500 text-center rounded group-hover:text-yellow-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                                        </svg>
                                    </div>
                                </div>
                                <div
                                    class="absolute z-10 bottom-2 left-2 text-indigo-300 text-sm font-bold group-hover:text-indigo-500">
                                    {{ $serie->seasons_count }} Season/s
                                </div>
                            </a>
                        </x-slot>
                        <a href="{{ route('series.show', $serie->slug) }}"
                            class="dark:text-white font-bold group-hover:text-blue-500 text-center">
                            {{ $serie->name }}
                        </a>
                    </x-movie-card>
                @endforeach
            </div>
            <div class="m-2 p-2">
                {{ $series->links() }}
            </div>
        </section>
    </main>
    </main>
</x-front-layout>
