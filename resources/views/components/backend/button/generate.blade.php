<button type="button"
    {{ $attributes->merge(['class' =>'group inline-flex items-center justify-center w-full h-full py-2 px-4 border border-transparent text-base leading-6 font-medium rounded-r-md text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:border-gray-700 focus:shadow-outline-gray active:bg-gray-900 transition duration-150 ease-in-out disabled:opacity-50']) }}>
    {{ $slot }}
    <span>Generate</span>
</button>
