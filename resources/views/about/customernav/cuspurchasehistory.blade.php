<!DOCTYPE html>
<html lang="en">
    <head>
        <link href="{!! url('css/customer/cuspurhistory.css') !!}" rel="stylesheet">
        <link href="{{ url('css/customer/topnav.css') }}" rel="stylesheet">
        <title>History</title>
    </head>

    <body>
         <!-- Top Navbar -->
         <nav class="top_navbar">
            <a href="{{ route('cusdasboard.show') }}">
                <img src="/image/logoBillnWow3.png" class="TopNav-BillnWoWlogo" alt="BillnWoWLogo" style="margin-top:-1.3%">
            </a>

            <!-- <h3 class="navbar-text">Anonas</h3> -->
            <!-- Navigation Links -->
            <div class="icons">
                <ul class="navigation-menu">
                    <li><a href="{{ route('cusdasboard.show') }}">Dashboard</a></li>
                    <li><a href="{{ route('cuspurchasehistory.show') }}">history</a></li>
                    <li><a href="#contact">Contact Us</a></li>
                </ul>

                <!-- Dark Mode -->
                <div class="icon sun-icon" onclick="toggleDarkModeDashboard()">
                    <img src="/image/7721593.png" alt="Sun Icon">
                </div>

                <div class="icon profile-icon img" onclick="toggleDropdown()">   
                    <img src="/image/4174470.png" alt="Profile Icon">
                    <!-- <span class="profile-text">Account Profile</span> -->

                    <!-- Dropdown -->
                    <div class="dropdown-menu" id="dropdownMenu">
                        <a href="{{ route('cusprofile.show') }}">Profile</a>
                        <a href="#">Change Password</a>
                        <a href="{{ route('about.layout') }}">Logout</a>
                    </div>
                </div>
            </div>
        </nav>
 <script src="{{ asset('js/customer/cusdashboard.js') }}"></script>   
</body>

</html>