<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Profile</title>
        
        <!-- Stylesheets -->
        <link href="{!! url('css/admin/adminarchived.css') !!}" rel="stylesheet">
        <link href="{{ url('css/admin/topnav_sidenav.css') }}" rel="stylesheet">
    
        
        <!-- Font Awesome for icons (sideNav-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        
    </head>

    <body>
        <!-- Top Navbar -->
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

        <!-- Javascript -->
        <script>

        // Dark Mode
        function toggleDarkModeDashboard() {
            document.body.classList.toggle('dark-mode');
            document.querySelectorAll('').forEach(item => {
                item.classList.toggle('dark-mode');
            });
        }

            // Dropdown
            
        function toggleDropdown() {
            document.getElementById('dropdownMenu').classList.toggle('show');
        }

        window.onclick = function(event) {
            if (!event.target.closest('.profile-icon')) {
                var dropdowns = document.getElementsByClassName('dropdown-menu');
                for (var i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        }

        // SideNav
        document.addEventListener("DOMContentLoaded", function() {
        var li_items = document.querySelectorAll(".sidebar ul li");
        var hamburger = document.querySelector(".hamburger");

        li_items.forEach((li_item) => {
            li_item.addEventListener("mouseenter", () => {
            li_item.closest(".wrapper").classList.remove("hover_collapse");
            });
        });

        li_items.forEach((li_item) => {
            li_item.addEventListener("mouseleave", () => {
            li_item.closest(".wrapper").classList.add("hover_collapse");
            });
        });

        hamburger.addEventListener("click", () => {
            hamburger.closest(".wrapper").classList.toggle("hover_collapse");
        });
        });

        </script>

        <div class="topnav">
            <h3 style="padding: 1%;text-align: center;color: aliceblue; ">ADMIN PROFILE </h3>
        </div> 
        
        <div class="container">
            <h1>Admin Name:</h1>
            <h2>Mike Lopez</h2>

            <div class="admin-info">
                <p>Email: marian_naparan@gmail.com</p>
                <p>Phone Number: 0956946355</p>
                <p>Address: Quezon City Cubao</p>

                <div class="password-section">
                    <p class="password">Password: **********</p>
                    <button>Change</button>
                </div>
            </div>
        </div>    
    </body>
</html>