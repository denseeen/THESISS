<!DOCTYPE html>
<html lang="en">
    <head>
        
        <link href="{!! url('css/customer/cuspurchasehistory.css') !!}" rel="stylesheet">
        <link href="{{ url('css/customer/topnav.css') }}" rel="stylesheet">
        <title>History</title>

        <style>
        body {
            background: #eee;
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            margin-top:5%;
        }
        .panel {
            background: #fff;
            border-radius: 4px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .panel-heading {
            padding: 15px;
            border-bottom: 1px solid #ddd;
            background: #f5f5f5;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .panel-heading strong {
            font-size: 18px;
        }
        .btn-group {
            position: relative;
        }
        .btn-group button {
            padding: 5px 10px;
            font-size: 12px;
            border: 1px solid #ccc;
            background: #f5f5f5;
            cursor: pointer;
            border-radius: 3px;
        }
        .btn-group .dropdown-menu {
            position: absolute;
            top: 25px;
            right: 0;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 3px;
            list-style: none;
            padding: 10px;
            display: none;
        }
        .btn-group:hover .dropdown-menu {
            display: block;
        }
        .dropdown-menu li {
            padding: 5px 0;
        }
        .dropdown-menu li a {
            color: #333;
            text-decoration: none;
        }
        .panel-body {
            padding: 0;
        }
        .panel-footer {
            padding: 15px;
            background: #f5f5f5;
            border-top: 1px solid #ddd;
            font-size: 12px;
            color: #555;
        }
        .row {
            display: flex;
            align-items: center;
            padding: 15px;
            border-bottom: 1px solid #ccc;
        }
        .row:last-child {
            border-bottom: 0;
        }
        .col-md-1 {
            text-align: center;
        }
        .col-md-1 img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
        }
        .col-md-11 {
            padding-left: 15px;
            border-left: 1px solid #ccc;
            width: calc(100% - 70px);
        }
        .col-md-12 {
            padding: 7px 0;
            font-size: 14px;
        }
        .label {
            padding: 5px;
            border-radius: 3px;
            font-size: 12px;
            display: inline-block;
        }
        .label-danger {
            background-color: #d9534f;
            color: #fff;
        }
        .label-info {
            background-color: #5bc0de;
            color: #fff;
        }
        .label-success {
            background-color: #5cb85c;
            color: #fff;
        }
        .btn-xs {
            font-size: 10px;
            padding: 5px 10px;
            margin-right: 5px;
            border: 1px solid #ccc;
            border-radius: 3px;
            cursor: pointer;
            background-color: #f5f5f5;
        }
        .btn-xs.glyphicon {
            margin-right: 0;
        }
    </style>
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
                    
                    <li>       
                         <div class="notification-container">
                            <!-- Bell Icon -->
                            <span class="bell-icon">&#128276;</span>
                            <!-- Notification Count -->
                            <span class="notification-count">3</span>

                            <!-- Dropdown Menu -->
                            <div class="dropdown-notification">
                                <!-- Recent Notifications -->
                                <div class="box shadow-sm rounded bg-white mb-3">
                                    <div class="box-title border-bottom p-3">
                                        <h6 class="m-0" style="color:black;">Recent</h6>
                                    </div>
                                    <div class="box-body p-0">
                                    
                                        <div class="notification-item">
                                            <div class="notification-content">
                                              
                                                <div class="notification-sender" style="color:red; margin-bottom:2%;">{{ Auth::user()->name }}</div>
                                                <div class="notification-message">Income tax sops on the cards, The bias in VC funding, and other top news for you</div>
                                            </div>
                                            <span class="delete-icon">&#10060;</span>
                                        </div>
                                        <div class="notification-item">
                                            <div class="notification-content">
                                            <div class="notification-sender" style="color:red; margin-bottom:2%;">{{ Auth::user()->name }}</div>
                                                <div class="notification-message">Vivamus imperdiet venenatis est...</div>
                                            </div>
                                            <span class="delete-icon">&#10060;</span>
                                        </div>
                                    </div>
                                </div>
                                <!-- Earlier Notifications -->
                                <div class="box shadow-sm rounded bg-white mb-3">
                                    <div class="box-title border-bottom p-3">
                                        <h6 class="m-0" style="color:black;">Earlier</h6>
                                    </div>
                                    <div class="box-body p-0">
                                        <div class="notification-item">
                                            <div class="notification-content">
                                            <div class="notification-sender" style="color:red; margin-bottom:2%;">{{ Auth::user()->name }}</div>
                                                <div class="notification-message">Nunc purus metus, aliquam vitae venenatis sit amet, porta non est.</div>
                                            </div>
                                            <span class="delete-icon">&#10060;</span>
                                        </div>
                                        <div class="notification-item">
                                            <div class="notification-content">
                                            <div class="notification-sender" style="color:red; margin-bottom:2%;">{{ Auth::user()->name }}</div>
                                                <div class="notification-message">Pellentesque semper ex diam, at tristique ipsum varius sed. Pellentesque non metus ullamcorper</div>
                                            </div>
                                            <span class="delete-icon">&#10060;</span>
                                        </div>
                                        <div class="notification-item">
                                            <div class="notification-content">
                                            <div class="notification-sender" style="color:red; margin-bottom:2%;">{{ Auth::user()->name }}</div>
                                                <div class="notification-message">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque ipsum elit.</div>
                                            </div>
                                            <span class="delete-icon">&#10060;</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    
                    
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
                        <a href="{{ route('cuspurchasehistory.show') }}">Order History</a>
                        <a href="#">Security</a>
                        <a href="{{ route('about.layout') }}">Logout</a>
                    </div>
                </div>
            </div>
        </nav>

<!-- Content -->

<div class="container">
    <div class="panel panel-default panel-order">
        <div class="panel-heading">
            <strong>Order history</strong>
            
        </div>

        <div class="panel-body">
            <div class="row">
               
                <div class="col-md-11">
                    <div class="row">
                        <div class="col-md-12">
                            <span><strong>Unit Order:</strong> Some Order</span><br />
                            <span><strong>Buyer Name:</strong> Jane Doe</span><br />
                            <span><strong>Date Order:</strong> 05/31/2014</span><br />
                            <span><strong>Cost:</strong> $323.13</span><br />
                            <span><strong>Status:</strong> 
                                <label class="label label-danger">Rejected</label> <!-- Example of a status label -->
                                <span></span> <!-- Explanation of status -->
                            </span><br />
                        </div>
                    </div>
                </div>

            </div>

            <div class="row">
               
                <div class="col-md-11">
                    <div class="row">
                        <div class="col-md-12">
                            <span><strong>Unit Order:</strong> Some Order</span><br />
                            <span><strong>Buyer Name:</strong> Jane Doe</span><br />
                            <span><strong>Date Order:</strong> 05/31/2014</span><br />
                            <span><strong>Cost:</strong> $323.13</span><br />
                            <span><strong>Status:</strong> 
                                <label class="label label-danger">Rejected</label> <!-- Example of a status label -->
                                <span></span> <!-- Explanation of status -->
                            </span><br />
                        </div>
                    </div>
                </div>

            </div>

            <div class="row">
               
                <div class="col-md-11">
                    <div class="row">
                        <div class="col-md-12">
                            <span><strong>Unit Order:</strong> Some Order</span><br />
                            <span><strong>Buyer Name:</strong> Jane Doe</span><br />
                            <span><strong>Date Order:</strong> 05/31/2014</span><br />
                            <span><strong>Cost:</strong> $323.13</span><br />
                            <span><strong>Status:</strong> 
                                <label class="label label-danger">Rejected</label> <!-- Example of a status label -->
                                <span></span> <!-- Explanation of status -->
                            </span><br />
                        </div>
                    </div>
                </div>

            </div>

            <div class="row">
               
                <div class="col-md-11">
                    <div class="row">
                        <div class="col-md-12">
                            <span><strong>Unit Order:</strong> Some Order</span><br />
                            <span><strong>Buyer Name:</strong> Jane Doe</span><br />
                            <span><strong>Date Order:</strong> 05/31/2014</span><br />
                            <span><strong>Cost:</strong> $323.13</span><br />
                            <span><strong>Status:</strong> 
                                <label class="label label-danger">Rejected</label> <!-- Example of a status label -->
                                <span></span> <!-- Explanation of status -->
                            </span><br />
                        </div>
                    </div>
                </div>

            </div>
        </div>
      
    </div>
</div>




 <script src="{{ asset('js/customer/cusdashboard.js') }}"></script>   
</body>

</html>