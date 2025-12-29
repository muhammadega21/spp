<dialog id="{{ $id }}" class="modal">

    <div class="modal-box">
        <h3 class="text-lg font-bold">{{ $title }}</h3>
        <form action="{{ $action }}" method="POST" id="form_{{ $id }}" enctype="multipart/form-data"
            class="mt-3">
            @csrf
            <input type="hidden" name="student_id" id="student_id" value="{{ $studentId }}">
            <input type="hidden" name="amount" value="{{ $amount }}">
            <div class="flex flex-col gap-y-2 mb-3 w-full">
                <label class="text-base text-gray-700">Nominal</label>
                <input type="text" class="input w-full" value="{{ $amount }}" disabled />
            </div>
            {{-- Bank tujuan --}}
            <div class="mb-3">
                <label class="label mb-1">
                    <span class="label-text">Transfer ke Bank</span>
                </label>

                <select id="bank_select_{{ $id }}" class="select w-full"
                    onchange="showBankAccount_{{ $id }}(this.value)">
                    <option value="" disabled selected>Pilih Bank</option>
                    <option value="bca" {{ old('bank') == 'bca' ? 'selected' : '' }}>BCA</option>
                    <option value="btn" {{ old('bank') == 'btn' ? 'selected' : '' }}>BTN</option>
                    <option value="mandiri" {{ old('bank') == 'mandiri' ? 'selected' : '' }}>Mandiri
                    </option>
                </select>

                {{-- Nomor rekening --}}
                <div id="bank_account_{{ $id }}" class="mt-2 text-sm bg-base-200 p-3 rounded hidden">
                    <p class="font-semibold">Nomor Rekening Tujuan:</p>
                    <p id="bank_account_text_{{ $id }}" class="text-primary"></p>
                </div>
            </div>

            <div class="flex flex-col gap-y-2 mb-3 w-full">
                <label class="text-base text-gray-700">Bukti Pembayaran</label>
                <input type="file"
                    class="file-input w-full @error('image')
                    file-input-error
                @enderror"
                    name="image" id="image" accept="image/*" required />
                @error('image')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{ $slot }}

        </form>
        <div class="modal-action">
            <button class="btn btn-primary" form="form_{{ $id }}">Bayar</button>
            <form method="dialog">
                <button class="btn">Close</button>
            </form>
        </div>
    </div>
</dialog>

@push('script')
    <script>
        function showBankAccount_{{ $id }}(bank) {
            const wrapper = document.getElementById('bank_account_{{ $id }}');
            const text = document.getElementById('bank_account_text_{{ $id }}');

            const accounts = {
                bca: 'BCA - 1234567890 a.n Muhammad Ega Dermawan',
                btn: 'BTN - 0987654321 a.n Muhammad Ega Dermawan',
                mandiri: 'Mandiri - 1122334455 a.n Muhammad Ega Dermawan',
            };

            if (accounts[bank]) {
                text.innerText = accounts[bank];
                wrapper.classList.remove('hidden');
            } else {
                wrapper.classList.add('hidden');
                text.innerText = '';
            }
        }
    </script>
@endpush

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
