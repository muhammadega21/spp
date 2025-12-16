@if ($package->type == 'monthly')
    <table class="table">
        <thead>
            <tr>
                <th>Bulan</th>
                <th>Nominal</th>
                <th>Total Siswa</th>
                <th>Sudah Bayar</th>
                <th>Belum Bayar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @for ($month = 1; $month <= 12; $month++)
                @php
                    // Ambil semua billMonths untuk bulan ini
                    $monthData = $data->pluck('billMonths')->flatten()->where('month', $month);

                    $total = $monthData->count();
                    $paid = $monthData->where('status', 'paid')->count();
                    $unpaid = $monthData->where('status', 'unpaid')->count();
                @endphp

                <tr>
                    <td>{{ \Carbon\Carbon::create()->month($month)->translatedFormat('F') }}</td>
                    <td>Rp {{ number_format($package->amount) }}</td>
                    <td>{{ $total }}</td>
                    <td class="text-green-600 font-semibold">{{ $paid }}</td>
                    <td class="text-red-600 font-semibold">{{ $unpaid }}</td>
                    <td>
                        <a href="{{ route('dashboard.bill.detail', [$package->id, $month]) }}"
                            class="btn btn-sm btn-primary">Lihat
                            Siswa</a>
                    </td>
                </tr>
            @endfor
        </tbody>

    </table>
@endif
