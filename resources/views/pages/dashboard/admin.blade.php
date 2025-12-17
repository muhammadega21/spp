 <div>
     <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
         <div class="stat bg-white text-base-content border border-gray-200 rounded-2xl p-5">
             <i class='bx bx-group inline-flex w-max text-4xl p-3 bg-sky-500 text-white rounded-lg '></i>
             <div class=" text-gray-500 my-3">Total Siswa</div>
             <div class="text-3xl font-bold">{{ $students }}</div>
         </div>
         <div class="stat bg-white text-base-content border border-gray-200 rounded-2xl p-5">
             <i class='bx bx-currency-notes inline-flex w-max text-4xl p-3 bg-slate-500 text-white rounded-lg '></i>
             <div class=" text-gray-500 my-3">Total Tagihan Aktif</div>
             <div class="text-3xl font-bold">{{ $bills }} <span
                     class="text-sm text-gray-500 font-semibold">Total</span></div>
         </div>
         <div class="stat bg-white text-base-content border border-gray-200 rounded-2xl p-5">
             <i class='bx bx-history inline-flex w-max text-4xl p-3 bg-yellow-500 rounded-lg '></i>
             <div class=" text-gray-500 my-3">Pembayaran Pending</div>
             <div class="text-3xl font-bold">{{ $pendingPayment }} <span
                     class="text-sm text-gray-500 font-semibold">Total</span></div>
         </div>
         <div class="stat bg-white text-base-content border border-gray-200 rounded-2xl p-5">
             <i class='bx bx-x inline-flex w-max text-4xl p-3 bg-red-500 text-white rounded-lg '></i>
             <div class=" text-gray-500 my-3">Pembayaran Ditolak</div>
             <div class="text-3xl font-bold">{{ $rejectedPayment }} <span
                     class="text-sm text-gray-500 font-semibold">Total</span></div>
         </div>
         <div class="stat bg-white text-base-content border border-gray-200 rounded-2xl p-5">
             <i class='bx bx-check inline-flex w-max text-4xl p-3 bg-green-500 rounded-lg '></i>
             <div class=" text-gray-500 my-3">Pembayaran Disetujui</div>
             <div class="text-3xl font-bold">{{ $approvedPayment }} <span
                     class="text-sm text-gray-500 font-semibold">Total</span></div>
         </div>
     </div>
     <div class="bg-white mt-4 border border-gray-200 rounded-2xl p-5">
         <h2 class="mb-2 text-lg font-semibold text-gray-700">Grafik Pembayaran Per Bulan ({{ date('Y') }})</h2>
         <canvas id="paymentChart" height="100"></canvas>
     </div>
 </div>

 @push('script')
     <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

     <script>
         const ctx = document.getElementById('paymentChart');

         new Chart(ctx, {
             type: 'line',
             data: {
                 labels: @json($graphLabels),
                 datasets: [{
                         label: 'Diterima',
                         data: @json(array_values($graphApproved)),
                         backgroundColor: '#22c55e'
                     },
                     {
                         label: 'Pending',
                         data: @json(array_values($graphPending)),
                         backgroundColor: '#facc15'
                     },
                     {
                         label: 'Ditolak',
                         data: @json(array_values($graphRejected)),
                         backgroundColor: '#ef4444'
                     }
                 ]
             },
             options: {
                 responsive: true,
                 plugins: {
                     legend: {
                         position: 'top'
                     }
                 },
                 scales: {
                     y: {
                         beginAtZero: true,
                         ticks: {
                             precision: 0
                         }
                     }
                 }
             }
         });
     </script>
 @endpush
