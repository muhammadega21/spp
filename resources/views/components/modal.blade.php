<dialog id="{{ $id }}" class="modal">
    <div class="modal-box">
        <h3 class="text-lg font-bold">{{ $title }}</h3>
        <form action="{{ $action }}" method="{{ strtoupper($method) === 'PUT' ? 'POST' : $method }}"
            id="form_{{ $id }}" class="mt-3">
            @csrf
            @if (strtoupper($method) === 'PUT')
                @method('PUT')
            @endif

            @foreach ($inputs as $input)
                <x-forms.input :id="$input['id']" :label="$input['label']" :type="$input['type']" :name="$input['name']" :value="$input['value']"
                    :isRequired="$input['isRequired']" />
            @endforeach

        </form>
        <div class="modal-action">
            <button class="btn btn-primary"
                form="form_{{ $id }}">{{ $method === 'POST' ? 'Tambah' : 'Update' }}</button>
            <form method="dialog">
                <button class="btn">Close</button>
            </form>
        </div>
    </div>
</dialog>

@if ($errors->any())
    @push('script')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const modal = document.getElementById('{{ $id }}');
                if (modal) {
                    modal.showModal();
                }
            });
        </script>
    @endpush
@endif
