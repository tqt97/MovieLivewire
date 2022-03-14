{{-- <table {{ $attributes->merge(['class' => 'w-full table-auto border border-b-0']) }}>
    {{ $slot }}
</table> --}}
{{-- <table {{ $attributes->merge(['class' => 'w-full table-auto border border-b-0']) }}>
    <x-thead-tr>
        {{ $thead }}
    </x-thead-tr>
    <tbody>
        {{ $tbody }}
    </tbody>
</table>

<x-wrapper>

</x-wrapper> --}}

<div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
    <div class="w-full overflow-x-auto">
        <table class="w-full table-auto border border-b-0">
            <x-backend.table.thead-tr>
                {{ $thead }}
            </x-backend.table.thead-tr>
            <tbody>
                {{ $tbody }}

            </tbody>
        </table>
        {{ $pagination }}
    </div>
</div>
