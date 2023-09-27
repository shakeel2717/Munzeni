<li class="menu-title">Menu</li>

<li>
    <a href="{{ route('admin.dashboard.index') }}" class="waves-effect">
        <i class="ri-dashboard-line"></i>
        <span>Admin Dashboard</span>
    </a>
</li>

<li class="menu-title">Finance</li>

<li>
    <a href="{{ route('admin.finance.create') }}" class="waves-effect">
        <i class="ri-dashboard-line"></i>
        <span>Add Balance</span>
    </a>
</li>
<hr>
@include('inc.nav.user')
