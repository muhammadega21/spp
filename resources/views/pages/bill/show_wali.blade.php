@push('style')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endpush

@if ($package->type == 'monthly')
    <table class="table">
        <thead>
            <tr>
                <th>Bulan</th>
                <th>Nominal</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @php
                $student = $data->first();
            @endphp
            @for ($month = 1; $month <= 12; $month++)
                @php
                    $bill = $student->billMonths->firstWhere('month', $month);
                @endphp

                <tr>
                    <td>{{ \Carbon\Carbon::create()->month($month)->translatedFormat('F') }}</td>
                    <td>Rp {{ number_format($package->amount) }}</td>
                    <td>
                        @if (!$bill)
                            <span class="badge badge-error">Belum Ada</span>
                        @elseif ($bill->status === 'paid')
                            <span class="badge badge-success">Sudah Bayar</span>
                        @elseif ($bill->status === 'pending')
                            <span class="badge badge-warning">Menunggu Konfirmasi</span>
                        @else
                            <span class="badge badge-error">Belum Bayar</span>
                        @endif
                    </td>
                </tr>
            @endfor
        </tbody>

    </table>

    <x-modals.modal-pay id="modal_pay_month" title="Form Pembayaran"
        action="{{ route('dashboard.payment.pay.month', $package->id) }}" :studentId="$student->id" :amount="$package->amount">
        <div class="mb-3">
            <label class="label">
                <span class="label-text">Pilih Bulan</span>
            </label>

            <select id="months" name="months[]" multiple="multiple" class="select select-bordered w-full" required>
                @foreach ($unpaidMonths as $month)
                    <option value="{{ $month['id'] }}">
                        {{ $month['name'] }}
                    </option>
                @endforeach
            </select>

            <span class="text-xs text-gray-500">
                * Bisa pilih lebih dari satu bulan
            </span>
        </div>
    </x-modals.modal-pay>
@endif

@push('script')
    <script>
        $(document).ready(function() {
            $('#months').select2({
                dropdownParent: $('#modal_pay_month'),
                width: '100%',
                placeholder: 'Pilih bulan'
            });
        });
    </script>
@endpush
