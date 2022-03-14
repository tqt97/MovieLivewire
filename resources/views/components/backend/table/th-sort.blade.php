<th {{ $attributes->merge(['class' => 'px-4 py-3 border border-gray-500 text-md cursor-pointer']) }}>
    <div class="flex space-x-4 items-center self-center justify-between content-center">
        {{ $slot }}
    </div>
</th>
