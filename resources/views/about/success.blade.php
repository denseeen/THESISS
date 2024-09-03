<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Success</title>
        
        <!-- Stylesheets -->
        <link href="{!! url('css/success.css') !!}" rel="stylesheet">
        <link href="{{ url('css/admin/topnav_sidenav.css') }}" rel="stylesheet">
    
        
        <!-- Font Awesome for icons (sideNav-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">   
    </head>

    <body>
        <!-- !-- Top Navbar -->
        <nav class="top_navbar">
            <a href="{{ route('addashboard.show') }}">
                <img src="/image/logoBillnWow3.png" class="TopNav-BillnWoWlogo" alt="BillnWoWLogo" style="margin-top:-1.3%">
            </a>

            <div class="icons">
                <!-- Dark Mode -->
                <div class="icon sun-icon" onclick="toggleDarkModeDashboard()">
                    <img src="/image/7721593.png" alt="Sun Icon">
                </div>
                
                <div class="icon profile-icon img" onclick="toggleDropdown()">   
                    <img src="/image/4174470.png" alt="Profile Icon">
                    <!-- <span class="profile-text">Account Profile</span> -->
                    <!-- Dropdown -->
                    <div class="dropdown-menu" id="dropdownMenu">
                        <a href="{{ route('adprofile.show') }}">Profile</a>
                        <a href="#">Change Password</a>
                        <a href="{{ route('about.layout') }}">Logout</a> 
                    </div>
                </div>
            </div>
        </nav>

        <!-- Sidebar -->
        <div class="wrapper hover_collapse">
            <div class="sidebar">
                <div class="sidebar_inner">
                    <ul>
                        <li><a href="{{ route('addashboard.show') }}"><span class="icon"><i class="fa fa-qrcode"></i></span><span class="text">Dashboard</span></a></li>
                        <li><a href="{{ route('adrequest.show') }}"><span class="icon"><i class="fa fa-link"></i></span><span class="text">Application</span></a></li>
                        <li><a href="{{ route('adinstallment.show') }}"><span class="icon"><i class="fa fa-eye"></i></span><span class="text">Installment</span></a></li>
                        <li><a href="{{ route('adfullypaid.show') }}"><span class="icon"><i class="fa fa-book"></i></span><span class="text">Fully Paid</span></a></li>
                        <li><a href="{{ route('adarchived.show') }}"><span class="icon"><i class="fa fa-question-circle"></i></span><span class="text">Archived</span></a></li>                
                    </ul>
                </div>
            </div>
        </div>

        
        <div class="container">
            <!-- <img src="/image/logoBillnWow3.png" alt="BillnWoWLogo" width="100%"> -->
        
            <h1>Successfully Created!</h1>
            <div class="divider"></div>
            <button onclick="redirectToRoute()">Back</button>
        </div>

    <script>
        function redirectToRoute() {
            window.location.href = "{{ route('adrequest.show') }}";
        }
    </script>

        <script src="{{ asset('js/admin/adrequest.js') }}"></script>  
    </body>
</html>