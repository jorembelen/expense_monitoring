<div id="sidebar-menu">
    <!-- Left Menu Start -->
    <ul class="metismenu list-unstyled" id="side-menu">
        <li class="menu-title" key="t-menu">Menu</li>

        <li>
            <a href="/" class="waves-effect">
                <i class="bx bx-home-circle"></i>
                <span key="t-dashboards">Manager Dashboard</span>
            </a>
        </li>

        <li class="mm-">
            <a href="{{ route('ca-approval') }}" class="waves-effect ">
                <i class="bx bx-task"></i>
                <x-cash-advance-for-approval totalCA/>
                <span key="t-chat">Cash Advance</span>
            </a>
        </li>
        <li class="mm-">
            <a href="{{ route('for-approval-list') }}" class="waves-effect ">
                <i class="bx bx-task"></i>
                <x-cash-report-for-approval total/>
                <span key="t-chat">Cash Report</span>
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
