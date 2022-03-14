<section class="text-gray-700 body-font">
    <div class="container px-5 py-2 mx-auto">
        <div class="flex flex-col text-center w-full mb-20">
            <h1 class="sm:text-4xl text-3xl title-font font-medium mb-4 text-gray-900">
                Welcome to admin panel - <span class="text-indigo-600 font-sans font-bold">Movie application</span>
            </h1>
            <p class="lg:w-2/3 mx-auto leading-relaxed text-base">
                Dashboard admin panel for movie application
            </p>
        </div>
        <div class="flex flex-wrap -m-4 mb-5 text-center">
            <div class="p-4 md:w-1/3 sm:w-1/2 w-full">
                <div class="border-2 border-gray-200 px-4 py-6 rounded-lg">
                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2" class="text-indigo-500 w-12 h-12 mb-3 inline-block" viewBox="0 0 24 24">
                        <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M23 21v-2a4 4 0 00-3-3.87m-4-12a4 4 0 010 7.75"></path>
                    </svg>
                    <h2 class="title-font font-medium text-3xl text-gray-900"> {{ $users->count() }}</h2>
                    <p class="leading-relaxed">Users</p>
                </div>
            </div>
            <div class="p-4 md:w-1/3 sm:w-1/2 w-full">
                <div class="border-2 border-gray-200 px-4 py-6 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        stroke-width="2" class="text-indigo-500 w-12 h-12 mb-3 inline-block">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z" />
                    </svg>
                    <h2 class="title-font font-medium text-3xl text-gray-900">{{ $movies->count() }}</h2>
                    <p class="leading-relaxed">Movies</p>
                </div>
            </div>
            <div class="p-4 md:w-1/3 sm:w-1/2 w-full">
                <div class="border-2 border-gray-200 px-4 py-6 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        stroke-width="2" class="text-indigo-500 w-12 h-12 mb-3 inline-block">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01" />
                    </svg>
                    <h2 class="title-font font-medium text-3xl text-gray-900">{{ $series->count() }}</h2>
                    <p class="leading-relaxed">Series</p>
                </div>
            </div>
            <div class="p-4 md:w-1/3 sm:w-1/2 w-full">
                <div class="border-2 border-gray-200 px-4 py-6 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        stroke-width="2" class="text-indigo-500 w-12 h-12 mb-3 inline-block">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M14 10l-2 1m0 0l-2-1m2 1v2.5M20 7l-2 1m2-1l-2-1m2 1v2.5M14 4l-2-1-2 1M4 7l2-1M4 7l2 1M4 7v2.5M12 21l-2-1m2 1l2-1m-2 1v-2.5M6 18l-2-1v-2.5M18 18l2-1v-2.5" />
                    </svg>
                    <h2 class="title-font font-medium text-3xl text-gray-900">{{ $casts->count() }}</h2>
                    <p class="leading-relaxed">Casts</p>
                </div>
            </div>
            <div class="p-4 md:w-1/3 sm:w-1/2 w-full">
                <div class="border-2 border-gray-200 px-4 py-6 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        stroke-width="2" class="text-indigo-500 w-12 h-12 mb-3 inline-block">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                    </svg>
                    <h2 class="title-font font-medium text-3xl text-gray-900">{{ $genres->count() }}</h2>
                    <p class="leading-relaxed">Genres</p>
                </div>
            </div>
            <div class="p-4 md:w-1/3 sm:w-1/2 w-full">
                <div class="border-2 border-gray-200 px-4 py-6 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        stroke-width="2" class="text-indigo-500 w-12 h-12 mb-3 inline-block">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                    </svg>
                    <h2 class="title-font font-medium text-3xl text-gray-900">{{ $tags->count() }}</h2>
                    <p class="leading-relaxed">Tags</p>
                </div>
            </div>
        </div>
    </div>
</section>
