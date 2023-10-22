<li class="list-unstyled nav-item {{ request()->is('admin/dashboard*') ? 'active-nav' : '' }}">
    <a href="{{ route('admin.dashboard.index') }}" class="nav-link text-center">
        <i class="bi bi-grid-fill fs-3"></i>
        <p class="nav-links mb-0">Admin Dashboard</p>
    </a>
</li>
<li class="list-unstyled nav-item {{ request()->is('admin/finance*') ? 'active-nav' : '' }}">
    <a href="{{ route('admin.finance.create') }}" class="nav-link text-center">
        <i class="bi bi-wallet2 fs-3"></i>
        <p class="nav-links mb-0">Add Balance</p>
    </a>
</li>
<li class="list-unstyled nav-item {{ request()->is('admin/history/users*') ? 'active-nav' : '' }}">
    <a href="{{ route('admin.history.users') }}" class="nav-link text-center">
        <i class="bi bi-people fs-3"></i>
        <p class="nav-links mb-0">All Users</p>
    </a>
</li>
<li class="list-unstyled nav-item {{ request()->is('admin/history/withdraws') ? 'active-nav' : '' }}">
    <a href="{{ route('admin.history.withdraw') }}" class="nav-link text-center">
        <i class="bi bi-layout-text-sidebar fs-3"></i>
        <p class="nav-links mb-0">Pending Withdrawal</p>
    </a>
</li>
<li class="list-unstyled nav-item {{ request()->is('admin/history/withdraws-approve*') ? 'active-nav' : '' }}">
    <a href="{{ route('admin.history.withdraw.approved') }}" class="nav-link text-center">
        <i class="bi bi-layout-text-sidebar fs-3"></i>
        <p class="nav-links mb-0">Approved Withdrawal</p>
    </a>
</li>
<li class="list-unstyled nav-item {{ request()->is('admin/history/deposits') ? 'active-nav' : '' }}">
    <a href="{{ route('admin.history.deposits') }}" class="nav-link text-center">
        <i class="bi bi-layout-text-sidebar fs-3"></i>
        <p class="nav-links mb-0">All Deposits</p>
    </a>
</li>
<li class="list-unstyled nav-item {{ request()->is('admin/history/all') ? 'active-nav' : '' }}">
    <a href="{{ route('admin.history.all') }}" class="nav-link text-center">
        <i class="bi bi-layout-text-sidebar fs-3"></i>
        <p class="nav-links mb-0">All Transactions</p>
    </a>
</li>

<li class="list-unstyled nav-item {{ request()->is('admin/history/setting') ? 'active-nav' : '' }}">
    <a href="{{ route('admin.history.setting') }}" class="nav-link text-center">
        <i class="bi bi-gear-wide-connected fs-3"></i>
        <p class="nav-links mb-0">Website Setting</p>
    </a>
</li>
<li class="list-unstyled nav-item {{ request()->is('admin/kyc*') ? 'active-nav' : '' }}">
    <a href="{{ route('admin.kyc.index') }}" class="nav-link text-center">
        <i class="bi bi-shield-lock fs-3"></i>
        <p class="nav-links mb-0">All Kyc Request</p>
    </a>
</li>
<li class="list-unstyled nav-item {{ request()->is('admin/plan*') ? 'active-nav' : '' }}">
    <a href="{{ route('admin.plan.index') }}" class="nav-link text-center">
        <i class="bi bi-layout-text-sidebar fs-3"></i>
        <p class="nav-links mb-0">Mining Plans</p>
    </a>
</li>

<li class="list-unstyled nav-item {{ request()->is('admin/trading*') ? 'active-nav' : '' }}">
    <a href="{{ route('admin.trading.index') }}" class="nav-link text-center">
        <i class="bi bi-layout-text-sidebar fs-3"></i>
        <p class="nav-links mb-0">Control Trading</p>
    </a>
</li>
