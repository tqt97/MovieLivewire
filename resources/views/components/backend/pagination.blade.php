@if ($pagination->count())
    <div class="px-3 py-2 border">
        {{ $pagination->links() }}
    </div>
@endif
