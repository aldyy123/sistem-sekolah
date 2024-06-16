<li class="header">Main</li>
<li class="{{ Request::is('dashboard') ? 'active' : '' }}"><a href="{{ route('dashboard') }}"><i class="icon-home"></i><span>Dashboard</span></a></li>
<li class="{{ Request::is('statistik/*') ? 'active' : '' }} open">
    <a href="#" class="has-arrow"><i class="icon-user"></i><span>Kelola Akun</span></a>
    <ul>
        {{-- params sementara, nanti diganti data id roles --}}
        <li class="{{ Request::is('statistik/accounts/STUDENT') ? 'active' : '' }}"><a href="{{ route('admin.statistik.accounts', ['role' => "STUDENT"]) }}">Akun Siswa</a></li>
        <li class="{{ Request::is('statistik/accounts/TEACHER') ? 'active' : '' }}"><a href="{{ route('admin.statistik.accounts', ['role' => "TEACHER"]) }}">Akun Guru</a></li>
        <li class="{{ Request::is('statistik/accounts/ADMIN') ? 'active' : '' }}"><a href="{{ route('admin.statistik.accounts', ['role' => "ADMIN"]) }}">Akun Admin</a></li>
    </ul>
</li>
<li class="{{ Request::is('subjects') ? 'active' : '' }}"><a href="{{ route('admin.subjects') }}"><i class="icon-book-open"></i><span>Kelola Mapel</span></a></li>
<li class="{{ Request::is('batch*') ? 'active' : '' }}"><a href="{{ route('admin.batchs') }}"><i class="fa fa-hashtag"></i><span>Kelola Angkatan</span></a></li>
<li class="{{ Request::is('schedule*') ? 'active' : '' }}"><a href="{{ route('admin.schedule') }}"><i class="fa fa-calendar"></i><span>Kelola Jadwal</span></a></li>
