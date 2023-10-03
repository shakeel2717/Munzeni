<nav class="navbar navbar-expand-lg">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-2 flex-column justify-content-center">
            <li class="list-unstyled nav-item">
                <a href="{{ route('user.dashboard.index') }}" class="nav-link text-center">
                    <i class="bi bi-grid-fill fs-3 text-primary"></i>
                    <p class="nav-links mb-0">My Account</p>
                </a>
            </li>
            <li class="list-unstyled nav-item">
                <a href="#" class="nav-link text-center">
                    <i class="bi bi-box-arrow-in-down fs-3 text-primary"></i>
                    <p class="nav-links mb-0">Deposit</p>
                </a>
            </li>
            <li class="list-unstyled nav-item">
                <a href="{{ route('user.withdraw.create') }}" class="nav-link text-center">
                    <i class="bi bi-box-arrow-up fs-3 text-primary"></i>
                    <p class="nav-links mb-0">Withdrawal</p>
                </a>
            </li>
            <li class="list-unstyled nav-item">
                <a href="#" class="nav-link text-center">
                    <i class="bi bi-hourglass-bottom fs-3 text-primary"></i>
                    <p class="nav-links mb-0">Transaction History</p>
                </a>
            </li>
            <li class="list-unstyled nav-item">
                <a href="{{ route('user.history.deposits') }}" class="nav-link text-center">
                    <i class="bi bi-easel2 fs-3 text-primary"></i>
                    <p class="nav-links mb-0">Trade History</p>
                </a>
            </li>
            <li class="list-unstyled nav-item">
                <a href="#" class="nav-link text-center">
                    <i class="bi bi-people fs-3 text-primary"></i>
                    <p class="nav-links mb-0">Referral</p>
                </a>
            </li>
            <li class="list-unstyled nav-item">
                <a href="#" class="nav-link text-center">
                    <i class="bi bi-gear fs-3 text-primary"></i>
                    <p class="nav-links mb-0">Settings</p>
                </a>
            </li>
        </ul>
    </div>
</nav>
