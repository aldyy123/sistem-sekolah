<li class="header">Main</li>
<li class="{{ Request::is('dashboard') ? 'active' : '' }}"><a href="{{ route('dashboard') }}"><i class="icon-book-open"></i><span>Daftar Pelajaran</span></a></li>
<li class="{{ Request::is('student/leaderboard') ? 'active' : '' }}"><a href="{{ url('/student/leaderboard') }}"><i class="fa fa-trophy"></i><span>Leaderboard</span></a></li>
<li class="{{ Request::is('schedule*') ? 'active' : '' }}"><a href="{{ route('schedule') }}"><i class="fa fa-calendar"></i><span>Jadwal</span></a></li>
