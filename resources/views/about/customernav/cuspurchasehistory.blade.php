<!DOCTYPE html>
<html lang="en">
    <head>
        
        <link href="{!! url('css/customer/cuspurhistory.css') !!}" rel="stylesheet">
        <link href="{{ url('css/customer/topnav.css') }}" rel="stylesheet">
        <title>History</title>

        <style>
       
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
                        <a href="{{ route('cussecurity.show') }}">Security</a>
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

<script>
            // darkmode
        function toggleDarkModeDashboard() {
            document.body.classList.toggle('dark-mode');

            let darkModeEnabled = document.body.classList.contains('dark-mode');

            // Send AJAX request to update dark mode preference in the database
            fetch('/update-dark-mode', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ dark_mode: darkModeEnabled })
            }).then(response => response.json())
            .then(data => {
                if (data.success) {
                    console.log('Dark mode preference updated successfully.');
                }
            });
        }

        // Apply saved dark mode preference from the database when the page loads
        function applySavedDarkModePreferenceFromDB() {
            const darkMode = {{ Auth::user()->dark_mode ? 'true' : 'false' }};

            if (darkMode) {
                document.body.classList.add('dark-mode');
            }
        }

        // Call the function when the page loads
        applySavedDarkModePreferenceFromDB();

    
</script> 


 <script src="{{ asset('js/customer/cusdashboard.js') }}"></script> 
 <script src="{{ asset('js/customer/topnav.js') }}"></script>  
</body>

</html>