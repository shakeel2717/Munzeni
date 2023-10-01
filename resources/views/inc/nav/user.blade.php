<li class="menu-title">Menu</li>

<li>
    <a href="{{ route('user.dashboard.index') }}" class="waves-effect">
        <i class="ri-dashboard-line"></i>
        <span>Dashboard</span>
    </a>
</li>

<li class="menu-title">Finance</li>

<li>
    <a href="{{ route('user.withdraw.create') }}" class="waves-effect">
        <i class="ri-dashboard-line"></i>
        <span>Withdraw Request</span>
    </a>
</li>
<li>
    <a href="{{ route('user.wallet.index') }}" class="waves-effect">
        <i class="ri-dashboard-line"></i>
        <span>Withdraw Methods</span>
    </a>
</li>

<li class="menu-title">Investment Plans</li>

<li>
    <a href="{{ route('user.plan.index') }}" class="waves-effect">
        <i class="ri-dashboard-line"></i>
        <span>Investment Plan</span>
    </a>
</li>


<li class="menu-title">Trading Section</li>

<li>
    <a href="{{ route('user.trading.index') }}" class="waves-effect">
        <i class="ri-dashboard-line"></i>
        <span>Start Trading</span>
    </a>
</li>

<li class="menu-title">Account Statement</li>
<li>
    <a href="{{ route('user.history.deposits') }}" class="waves-effect">
        <i class="ri-dashboard-line"></i>
        <span>Deposit Statement</span>
    </a>
</li>
<li>
    <a href="{{ route('user.history.withdrawals') }}" class="waves-effect">
        <i class="ri-dashboard-line"></i>
        <span>Withdrawals Statement</span>
    </a>
</li>
<li>
    <a href="{{ route('user.history.direct_commissions') }}" class="waves-effect">
        <i class="ri-dashboard-line"></i>
        <span>Direct Commission</span>
    </a>
</li>
<li>
    <a href="{{ route('user.history.indirect_commissions') }}" class="waves-effect">
        <i class="ri-dashboard-line"></i>
        <span>In-Direct Commission</span>
    </a>
</li>
<li>
    <a href="{{ route('user.history.trades') }}" class="waves-effect">
        <i class="ri-dashboard-line"></i>
        <span>Trade History</span>
    </a>
</li>

<li class="menu-title">Account Settings</li>

<li>
    <a href="{{ route('user.profile.index') }}" class="waves-effect">
        <i class="ri-dashboard-line"></i>
        <span>My Profile</span>
    </a>
</li>
<li>
    <a href="{{ route('user.kyc.create') }}" class="waves-effect">
        <i class="ri-dashboard-line"></i>
        <span>KYC Verification</span>
    </a>
</li>
<li>
    <a href="{{ route('user.password.index') }}" class="waves-effect">
        <i class="ri-dashboard-line"></i>
        <span>Change Password</span>
    </a>
</li>
