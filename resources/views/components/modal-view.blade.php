<dialog id="{{ $id }}" class="modal">
    <div class="modal-box max-w-lg">
        <h3 class="text-lg font-bold mb-4">{{ $title }}</h3>

        <div class="space-y-3">
            {{ $slot }}
        </div>

        <div class="modal-action">
            <form method="dialog">
                <button class="btn">Close</button>
            </form>
        </div>
    </div>
</dialog>
