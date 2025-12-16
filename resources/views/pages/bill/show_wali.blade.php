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
                        @else
                            <span class="badge badge-warning">Belum Bayar</span>
                        @endif
                    </td>
                </tr>
            @endfor
        </tbody>

    </table>
@endif
