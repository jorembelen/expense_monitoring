<div id="sidebar-menu">
    <!-- Left Menu Start -->
    <ul class="metismenu list-unstyled" id="side-menu">
        <li class="menu-title" key="t-menu">Menu</li>

        <li>
            <a href="/" class="waves-effect">
                <i class="bx bx-home-circle"></i>
                <span key="t-dashboards">Dashboards</span>
            </a>
        </li>

        <li class="mm-">
            <a href="{{ route('users') }}" class="waves-effect ">
                <i class="bx bxs-user-circle"></i>
                <span key="t-chat">Users</span>
            </a>
        </li>
        <li class="mm-">
            <a href="{{ route('employees') }}" class="waves-effect ">
                <i class="bx bxs-user-detail"></i>
                <span key="t-chat">Employees</span>
            </a>
        </li>
        <li class="mm-">
            <a href="{{ route('gl-codes') }}" class="waves-effect ">
                <i class="bx bx-file"></i>
                <span key="t-chat">GL Codes</span>
            </a>
        </li>
        <li class="mm-">
            <a href="{{ route('unpaid-cash-report') }}" class="waves-effect ">
                <i class="bx bx-task"></i>
                <x-cash-report-for-voucher totalCrfv/>
                <span key="t-chat">For Voucher</span>
            </a>
        </li>
        <li class="mm-">
            <a href="{{ route('cash-report') }}" class="waves-effect ">
                <i class="bx bxs-report"></i>
                <x-cash-report-for-approved totalCra/>
                <span key="t-chat">Cash Report</span>
            </a>
        </li>
        <li class="mm-">
            <a href="{{ route('cash-advance') }}" class="waves-effect ">
                <i class="bx bx-dollar-circle"></i>
                <x-cash-advance-for-job totalCafj/>
                <x-cash-advance-for-payment totalCaa/>
                <span key="t-chat">Cash Advance</span>
            </a>
        </li>
        <li class="mm-">
            <a href="{{ route('cash-book') }}" class="waves-effect ">
                <i class="bx bx-dollar-circle"></i>
                <span key="t-chat">Cash Book</span>
            </a>
        </li>
        <li class="mm-">
            <a href="{{ route('reports') }}" class="waves-effect ">
                <i class="bx bxs-bar-chart-alt-2"></i>
                <span key="t-chat">Reports</span>
            </a>
        </li>
        <li class="mm-">
            <a hhref="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form2').submit();" class="waves-effect ">
                <i class="bx bx-power-off"></i>
                <span key="t-chat">Logout</span>
                <form id="logout-form2" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </a>
        </li>

    </ul>
</div>
