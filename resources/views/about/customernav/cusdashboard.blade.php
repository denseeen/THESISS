<!DOCTYPE html>
<html lang="en">
<head>
    <link href="{!! url('css/customer/cusdashboard.css') !!}" rel="stylesheet">
    <link href="{!! url('assets/bootstrap/css/bootstrap.min.css') !!}" rel="stylesheet">

 <!-- CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500&display=swap">
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
 <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
 <link rel="stylesheet" href="assets/css/jquery.mCustomScrollbar.min.css">
 <link rel="stylesheet" href="assets/css/animate.css">
 <link rel="stylesheet" href="assets/bootstrap/css/style.css">
 <link rel="stylesheet" href="assets/bootstrap/css/media-queries.css">

 <!-- Favicon and touch icons -->
 <!-- <link rel="shortcut icon" href="assets/ico/favicon.png">
 <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
 <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
 <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
 <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png"> -->


    <title>Customer</title>
</head>
<body>
<!-- Wrapper -->
<div class="wrapper">
    <!-- Sidebar -->
    <nav class="sidebar">
 
        <!-- close sidebar menu -->
        <div class="dismiss">
            <i class="fas fa-arrow-left"></i>
        </div>
 
        <div class="logo">
            <img src="/image/baba.jpg" alt="gg" width="80%">
        </div>
 
        <ul class="list-unstyled menu-elements">
            <li class="active"><a class=" a" href="{{ route('cusprofile.show') }}"><i class="fas fa-home"></i> Profile</a></li>
            <li><a class="b " href="{{ route('cusdasboard.show') }}"><i class="fas fa-home"></i> Dashboard</a></li>
            <li><a class="c " href="{{ route('cuspurchasehistory.show') }}"><i class="fas fa-home"></i> Purchase History</a></li>
            <li><a class="d " href="{{ route('about.layout') }}"><i class="fas fa-home"></i> Log Out</a></li>
        </ul>
    </nav>
    <!-- End sidebar -->
 
    <!-- Dark overlay -->
    <div class="overlay"></div>
 
    <!-- Content -->
    <div class="content">
 
        <!-- open sidebar menu -->
        <a class="btn btn-primary btn-customized open-menu" href="#" role="button">
            <i class="fas fa-align-left"></i> <span></span>
        </a>
 
        <!-- ... -->
 
        <!-- here is the page's content (not shown here) -->
 
        <!-- ... -->
 
    </div>
    <!-- End content -->
 
</div>
<!-- End wrapper -->


<!-- Edited -->
    <div class="container">
        <div class="headerCusTopnav">
            
            <div class="title">
                <h1>Billn'WOW Anonas </h1>
            </div>

            <div class="icons">

                 <div class="icon sun-icon" onclick="toggleDarkMode()">
                    <img src="/image/7721593.png" alt="Sun Icon">
                </div>
               
                <div class="icon profile-icon img" onclick="toggleDropdown()">   
                     <img src="/image/4174470.png" alt="Profile Icon">
                </div>

                <div class="dropdown-menuCusTopNav" id="dropdownMenu">
                    <a href="{{ route('about.layout') }}">Logout</a>
                    <a href="#">Change Password</a>
                </div>

            </div>
</div>
    </div>


        <!-- <header>
            <div class="title">
                <h1>Bill n' <span class="wow">WoW</span> Anonas</h1>
            </div>
            <div class="icons">
                <div class="icon sun-icon" onclick="toggleDarkMode()">
                    <img src="/image/7721593.png" alt="Sun Icon">
                </div>
                
                <div class="icon profile-icon" onclick="toggleDropdown()">
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="/image/4174470.png" alt="Profile Icon">
                        </button>

                        <div class="dropdown-menu" id="dropdownMenu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="{{ route('about.layout') }}">Logout</a>
                            <a class="dropdown-item" href="#">Change Password</a>
                        </div>
                    </div> -->


                    <!-- <div class="dropdown-menu" id="dropdownMenu">
                        <a href="{{ route('about.layout') }}">Logout</a>
                        <a href="#">Change Password</a>
                    </div> -->
                <!-- </div>
            </div>
        </header> -->


    <!-- <script>
        function toggleDarkMode() {
            document.body.classList.toggle('dark-mode');
        }

        function toggleDropdown() {
            document.getElementById('dropdownMenu').classList.toggle('show');
        }

        window.onclick = function(event) {
            if (!event.target.matches('.profile-icon img')) {
                var dropdowns = document.getElementsByClassName('dropdown-menu');
                for (var i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        }
    </script> -->

      


        <!-- Javascript -->
        <!-- <script src="assets/js/jquery-3.3.1.min.js"></script> -->
        <!-- <script src="assets/js/jquery-migrate-3.0.0.min.js"></script> -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <!-- <script src="assets/js/jquery.backstretch.min.js"></script> -->
        <script src="assets/js/wow.min.js"></script>
        <script src="assets/js/jquery.waypoints.min.js"></script>
        <script src="assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
        <script src="assets/bootstrap/js/scripts.js"></script>
</body>
</html>