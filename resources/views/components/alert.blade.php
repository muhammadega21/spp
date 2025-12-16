@if (session()->has('success'))
    @push('script')
        <script>
            Swal.fire({
                title: "Success!",
                text: "{{ session('success') }}",
                icon: "success"
            });
        </script>
    @endpush
@endif

@if (session()->has('error'))
    @push('script')
        <script>
            Swal.fire({
                title: "Error!",
                text: "{{ session('error') }}",
                icon: "error"
            });
        </script>
    @endpush
@endif

@push('script')
    <script>
        $(document).on('submit', '.delete-form', function(e) {
            e.preventDefault();

            const form = this;

            Swal.fire({
                title: "Yakin ingin menghapus?",
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, hapus!",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    </script>
@endpush


@push('script')
    <script>
        $(document).on('submit', '.confirm-with-note', function(e) {
            e.preventDefault();

            const form = this;
            const title = $(this).data('title');
            const text = $(this).data('text');
            const icon = $(this).data('icon');

            Swal.fire({
                title: title,
                input: 'textarea',
                inputLabel: 'Catatan Admin',
                inputPlaceholder: 'Tulis pesan untuk wali murid...',
                inputAttributes: {
                    'aria-label': 'Catatan admin'
                },
                showCancelButton: true,
                confirmButtonText: 'Kirim',
                cancelButtonText: 'Batal',
                icon: icon,
                showLoaderOnConfirm: true,
                preConfirm: (note) => {
                    if (!note) {
                        Swal.showValidationMessage('Catatan wajib diisi');
                    }
                    return note;
                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
                if (result.isConfirmed) {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'note';
                    input.value = result.value;

                    form.appendChild(input);
                    form.submit();
                }
            });
        });
    </script>
@endpush
