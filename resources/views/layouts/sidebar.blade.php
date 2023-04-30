<div class="sidebar">
    <div class="menu">
        <ul>
            <li>
                <a href="{{ url('/dashboard') }}"  class="{{ Request::is('dashboard*','home*') ? 'active' : '' }}">
                    <i class="fa-solid fa-grid-2"></i>
                    <span class="link_name">Dashboard</span>
                </a>
                <span class="tooltips">Dashboard</span>
            </li>
            <li>
                <a href="{{ url('/siswa') }}" class="{{ Request::is('siswa*') ? 'active' : '' }}">
                    <i class="fa-solid fa-user"></i>
                    <span class="link_name">Data Siswa</span>
                </a>
                <span class="tooltips">Data Siswa</span>
            </li>
            <li>
                <a href="{{ url('/petugas') }}" class="{{ Request::is('petugas*') ? 'active' : '' }}">
                    <i class="fa-solid fa-user-tie"></i>
                    <span class="link_name">Data Petugas</span>
                </a>
                <span class="tooltips">Data Petugas</span>
            </li>
            <li>
                <a href="{{ url('/pembayaran') }}" class="{{ Request::is('pembayaran*') ? 'active' : '' }}">
                    <i class="fa-solid fa-coins"></i>
                    <span class="link_name">Data Pembayaran</span>
                </a>
                <span class="tooltips">Dt. Pembayaran</span>
            </li>
            <li>
                <a href="">
                    <i class="fa-solid fa-clock-rotate-left"></i>
                    <span class="link_name">Riwayat Pembayaran</span>
                </a>
                <span class="tooltips">Rwt. Pembayaran</span>
            </li>
            <li>
                <a href="{{ url('/kelas') }}" class="{{ Request::is('kelas*') ? 'active' : '' }}">
                    <i class="fa-solid fa-landmark"></i>
                    <span class="link_name">Data Kelas</span>
                </a>
                <span class="tooltips">Data Kelas</span>
            </li>
            <li>
                <a href="/jurusan" class="{{ Request::is('jurusan*') ? 'active' : '' }}">
                    <i class="fa-solid fa-calendar-lines"></i>
                    <span class="link_name">Data Jurusan</span>
                </a>
                <span class="tooltips">Data Jurusan</span>
            </li>
            <li>
                <a href="/spp" class="{{ Request::is('spp*') ? 'active' : '' }}">
                    <i class="fa-solid fa-database"></i>
                    <span class="link_name">Data SPP</span>
                </a>
                <span class="tooltips">Data SPP</span>
            </li>
        </ul>
    </div>
    <div class="bg-opacity"></div>
</div>