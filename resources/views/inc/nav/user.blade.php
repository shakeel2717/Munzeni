<nav class="navbar navbar-expand-lg mt-3">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-2 flex-column justify-content-center">
            @if (auth()->user()->role == 'admin')
                @include('inc.nav.admin')
            @endif

            <li class="list-unstyled nav-item {{ request()->is('user/dashboard*') ? 'active-nav' : '' }}">
                <a href="{{ route('user.dashboard.index') }}" class="nav-link text-center">
                    <i class="bi bi-grid-fill fs-3"></i>
                    <p class="nav-links mb-0">My Account</p>
                </a>
            </li>
            <li class="list-unstyled nav-item">
                <a href="#" class="nav-link text-center">
                    <i class="bi bi-box-arrow-in-down fs-3"></i>
                    <p class="nav-links mb-0">Deposit</p>
                </a>
            </li>
            <li class="{{ request()->is('user/withdraw*') ? 'active-nav' : '' }} ">
                <a href="{{ route('user.withdraw.create') }}" class="nav-link text-center">
                    <i class="bi bi-box-arrow-up fs-3"></i>
                    <p class="nav-links mb-0">Withdrawal</p>
                </a>
            </li>
            <li class="{{ request()->is('user/trading*') ? 'active-nav' : '' }}">
                <a href="{{ route('user.trading.index') }}" class="nav-link text-center">
                    <i class="bi bi-bar-chart fs-3"></i>
                    <p class="nav-links mb-0">Trading</p>
                </a>
            </li>
            <li class="{{ request()->is('user/plan*') ? 'active-nav' : '' }}">
                <a href="{{ route('user.plan.index') }}" class="nav-link text-center">
                    <i class="bi bi-hammer fs-3"></i>
                    <p class="nav-links mb-0">Mining</p>
                </a>
            </li>
            <li class="{{ request()->is('user/history*') ? 'active-nav' : '' }}">
                <a href="{{ route('user.history.deposits') }}" class="nav-link text-center">
                    <i class="bi bi-hourglass-bottom fs-3"></i>
                    <p class="nav-links mb-0">Transaction History</p>
                </a>
            </li>
            <li class="{{ request()->is('user/referral*') ? 'active-nav' : '' }}">
                <a href="{{ route('user.referral.index') }}" class="nav-link text-center">
                    <i class="bi bi-people fs-3"></i>
                    <p class="nav-links mb-0">Referral</p>
                </a>
            </li>
            <li class="{{ request()->is('user/profile*') ? 'active-nav' : '' }}">
                <a href="{{ route('user.profile.index') }}" class="nav-link text-center">
                    <i class="bi bi-gear fs-3"></i>
                    <p class="nav-links mb-0">Settings</p>
                </a>
            </li>
        </ul>
    </div>
</nav>
