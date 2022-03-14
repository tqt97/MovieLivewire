<?php
$genres = App\Models\Genre::all();
$movies = App\Models\Movie::all();
$series = App\Models\Serie::all();
$casts = App\Models\Cast::all();
$users = App\Models\User::all();
$tags = App\Models\Tag::all();
?>
<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin') }}
        </h2>
    </x-slot> --}}

    <div class="py-12">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-admin-welcome :genres="$genres" :movies="$movies" :series="$series" :casts="$casts" :users="$users" :tags="$tags">
                </x-admin-welcome>
            </div>
        </div>
    </div>
</x-app-layout>
