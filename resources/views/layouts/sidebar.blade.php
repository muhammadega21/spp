<div class="drawer-side is-drawer-close:overflow-visible">
    <label for="my-drawer-4" aria-label="close sidebar" class="drawer-overlay"></label>
    <div
        class="bg-base-100 border-r border-gray-200 flex min-h-full flex-col items-start is-drawer-close:w-14 is-drawer-open:w-64 w-64">
        <ul class="menu w-full grow text-lg">
            <li class="{{ Route::is('dashboard.index') ? 'bg-gray-200' : '' }} rounded">
                <a href="{{ route('dashboard.index') }}" class="is-drawer-close:tooltip is-drawer-close:tooltip-right "
                    data-tip="Dashboard">
                    <i class='bx bx-dashboard'></i>
                    <span class="is-drawer-close:hidden text-base">Dashboard</span>
                </a>
            </li>

            <span class="is-drawer-close:hidden text-sm text-gray-500 my-2 ps-4">Data Master</span>
            @can('admin')
                <li>
                    <a href="#" class="is-drawer-close:tooltip is-drawer-close:tooltip-right" data-tip="Data Siswa">
                        <i class='bx  bx-user'></i>
                        <span class="is-drawer-close:hidden text-base">Data Siswa</span>
                    </a>
                </li>
                <li class="{{ Route::is('dashboard.student-classes.index') ? 'bg-gray-200' : '' }} rounded">
                    <a href="{{ route('dashboard.student-classes.index') }}"
                        class="is-drawer-close:tooltip is-drawer-close:tooltip-right" data-tip="Data Siswa">
                        <i class='bx bx-school'></i>
                        <span class="is-drawer-close:hidden text-base">Data Kelas</span>
                    </a>
                </li>
            @endcan

            <li>
                <a href="#" class="is-drawer-close:tooltip is-drawer-close:tooltip-right" data-tip="Data Tagihan">
                    <i class='bx  bx-receipt'></i>
                    <span class="is-drawer-close:hidden text-base">Data Tagihan</span>
                </a>
            </li>

            <li>
                <a href="#" class="is-drawer-close:tooltip is-drawer-close:tooltip-right"
                    data-tip="Data Pembayaran">
                    <i class='bx  bx-wallet-note'></i>
                    <span class="is-drawer-close:hidden text-base">Data Pembayaran</span>
                </a>
            </li>

            <li>
                <a href="#" class="is-drawer-close:tooltip is-drawer-close:tooltip-right"
                    data-tip="Riwayat Pembayaran">
                    <i class='bx  bx-history'></i>
                    <span class="is-drawer-close:hidden text-base">Riwayat Pembayaran</span>
                </a>
            </li>

            <span class="is-drawer-close:hidden text-sm text-gray-500 my-2 ps-4">Pengaturan</span>

            <li>
                <a href="#" class="is-drawer-close:tooltip is-drawer-close:tooltip-right" data-tip="Profil">
                    <i class='bx  bx-cog'></i>
                    <span class="is-drawer-close:hidden text-base">Profil</span>
                </a>
            </li>

            <li>
                <a href="{{ route('logout') }}" class="is-drawer-close:tooltip is-drawer-close:tooltip-right"
                    data-tip="Logout">
                    <i class="bx bx-arrow-out-right-square-half"></i>
                    <span class="is-drawer-close:hidden text-base">Logout</span>
                </a>
            </li>
        </ul>
    </div>
</div>
