@extends('layouts.main')
@section('content')
    @push('style')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @endpush
    @if (Auth::user()->role == 'admin')
        <div class="grid grid-cols-1 md:grid-cols-[2fr_1fr] gap-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="stat bg-white text-base-content border border-gray-200 rounded-2xl p-5">
                    <i class='bx bx-group inline-flex w-max text-4xl p-3 bg-sky-500 text-white rounded-lg '></i>
                    <div class=" text-gray-500 my-3">Jumlah Siswa</div>
                    <div class="text-3xl font-bold">25</div>
                </div>
                <div class="stat bg-white text-base-content border border-gray-200 rounded-2xl p-5">
                    <i class='bx bx-x inline-flex w-max text-4xl p-3 bg-red-500 text-white rounded-lg '></i>
                    <div class=" text-gray-500 my-3">Tagihan Belum Bayar</div>
                    <div class="text-3xl font-bold">5 <span class="text-sm text-gray-500 font-semibold">Total</span></div>
                </div>
                <div class="stat bg-white text-base-content border border-gray-200 rounded-2xl p-5">
                    <i class='bx bx-history inline-flex w-max text-4xl p-3 bg-yellow-500 rounded-lg '></i>
                    <div class=" text-gray-500 my-3">Tagihan Pending</div>
                    <div class="text-3xl font-bold">3 <span class="text-sm text-gray-500 font-semibold">Total</span></div>
                </div>
                <div class="stat bg-white text-base-content border border-gray-200 rounded-2xl p-5">
                    <i class='bx bx-check inline-flex w-max text-4xl p-3 bg-green-500 rounded-lg '></i>
                    <div class=" text-gray-500 my-3">Tagihan Sudah Bayar</div>
                    <div class="text-3xl font-bold">10 <span class="text-sm text-gray-500 font-semibold">Total</span></div>
                </div>
            </div>

            <div class="bg-white text-base-content border border-gray-200 rounded-2xl p-5">
                <canvas id="myChart"></canvas>
            </div>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-[2fr_1fr] gap-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="stat bg-white text-base-content border border-gray-200 rounded-2xl p-5">
                    <i class='bx bx-x inline-flex w-max text-4xl p-3 bg-red-500 text-white rounded-lg '></i>
                    <div class=" text-gray-500 my-3">Tagihan Belum Bayar</div>
                    <div class="text-3xl font-bold">5 <span class="text-sm text-gray-500 font-semibold">Total</span></div>
                </div>
                <div class="stat bg-white text-base-content border border-gray-200 rounded-2xl p-5">
                    <i class='bx bx-history inline-flex w-max text-4xl p-3 bg-yellow-500 rounded-lg '></i>
                    <div class=" text-gray-500 my-3">Tagihan Menunggu Verifikasi</div>
                    <div class="text-3xl font-bold">3 <span class="text-sm text-gray-500 font-semibold">Total</span></div>
                </div>
                <div class="stat bg-white text-base-content border border-gray-200 rounded-2xl p-5">
                    <i class='bx bx-check inline-flex w-max text-4xl p-3 bg-green-500 rounded-lg '></i>
                    <div class=" text-gray-500 my-3">Tagihan Lunas</div>
                    <div class="text-3xl font-bold">10 <span class="text-sm text-gray-500 font-semibold">Total</span></div>
                </div>
            </div>
            <div class="bg-white text-base-content border border-gray-200 rounded-2xl p-5">
                <canvas id="myChart"></canvas>
            </div>
        </div>
    @endif

    @php
        if (Auth::user()->role == 'admin') {
            $labels = ['Belum Bayar', 'Pending', 'Lunas'];
            $data = [5, 3, 10];
            $colors = ['#EF4444', '#FBBF24', '#22C55E'];
        } else {
            $labels = ['Belum Bayar', 'Menunggu Verifikasi', 'Lunas'];
            $data = [5, 3, 10];
            $colors = ['#EF4444', '#FBBF24', '#22C55E'];
        }
    @endphp

    @push('script')
        <script>
            var ctx = document.getElementById('myChart').getContext('2d');

            var myChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: @json($labels),
                    datasets: [{
                        data: @json($data),
                        backgroundColor: @json($colors),
                        hoverOffset: 4
                    }]
                },
                options: {
                    plugins: {
                        legend: {
                            position: 'top',
                        }
                    }
                }
            });
        </script>
    @endpush
@endsection
