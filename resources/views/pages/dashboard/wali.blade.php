<div>
    <div class="bg-white text-base-content border border-gray-200 rounded-2xl p-5 mb-3">
        <h2 class="text-lg font-semibold text-gray-700">Data Anak</h2>
        <table class="leading-7 mt-3">
            <tr>
                <td class="pe-2">NIS</td>
                <td>: {{ auth()->user()->students->first()->nis }}</td>
            </tr>
            <tr>
                <td class="pe-2">Nama</td>
                <td>: {{ auth()->user()->students->first()->name }}</td>
            </tr>
            <tr>
                <td class="pe-2">Kelas</td>
                <td>: {{ auth()->user()->students->first()->class->name }}</td>
            </tr>
            <tr>
                <td class="pe-2">Tahun Masuk</td>
                <td>: {{ auth()->user()->students->first()->year }}</td>
            </tr>
        </table>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="stat bg-white text-base-content border border-gray-200 rounded-2xl p-5">
            <i class='bx bx-currency-notes inline-flex w-max text-4xl p-3 bg-slate-500 text-white rounded-lg '></i>
            <div class=" text-gray-500 my-3">Total Tagihan</div>
            <div class="text-3xl font-bold">{{ $bills }} <span
                    class="text-sm text-gray-500 font-semibold">Total</span></div>
        </div>
        <div class="stat bg-white text-base-content border border-gray-200 rounded-2xl p-5">
            <i class='bx bx-check inline-flex w-max text-4xl p-3 bg-green-500 rounded-lg '></i>
            <div class=" text-gray-500 my-3">Sudah Dibayar</div>
            <div class="text-3xl font-bold">{{ $approvedPayment }} <span
                    class="text-sm text-gray-500 font-semibold">Total</span></div>
        </div>
        <div class="stat bg-white text-base-content border border-gray-200 rounded-2xl p-5">
            <i class='bx bx-history inline-flex w-max text-4xl p-3 bg-yellow-500 rounded-lg '></i>
            <div class=" text-gray-500 my-3">Menunggu Verifikasi</div>
            <div class="text-3xl font-bold">{{ $pendingPayment }} <span
                    class="text-sm text-gray-500 font-semibold">Total</span></div>
        </div>
        <div class="stat bg-white text-base-content border border-gray-200 rounded-2xl p-5">
            <i class='bx bx-x inline-flex w-max text-4xl p-3 bg-red-500 rounded-lg text-white'></i>
            <div class=" text-gray-500 my-3">Ditolak</div>
            <div class="text-3xl font-bold">{{ $rejectedPayment }} <span
                    class="text-sm text-gray-500 font-semibold">Total</span></div>
        </div>
    </div>
</div>
