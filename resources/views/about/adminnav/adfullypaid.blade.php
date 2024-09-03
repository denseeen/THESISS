<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Fully Paid</title>
    
        <!-- Stylesheets -->
        <link href="{!! url('css/admin/adminfullypaid.css') !!}" rel="stylesheet">
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

<!-- content -->
        <div class="container">
            <h2>FULLY PAID PROCESS</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Unit</th>
                            <th>Payment Method</th>
                            <th>Amount</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Violation</th>
                            <th>Comment</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                    <tr>
                        <td>Marian Naparan</td>
                        <td>ERV3</td>
                        <td>OTC</td>
                        <td>59,650</td>
                        <td>MARCH 30 2021</td>
                        <td>Paid</td>
                        <td></td>
                        <td></td>
                        <td class="update-button">UPDATE</td>
                    </tr>

                    <tr>
                        <td>Marian Naparan</td>
                        <td>ERV3</td>
                        <td>ONLINE</td>
                        <td>59,650</td>
                        <td>MARCH 30 2021</td>
                        <td>Paid</td>
                        <td></td>
                        <td></td>
                        <td class="update-button">UPDATE</td>
                    </tr>

                    <tr>
                        <td>Marian Naparan</td>
                        <td>ERV3</td>
                        <td>ONLINE</td>
                        <td>59,650</td>
                        <td>MARCH 30 2021</td>
                        <td>Paid</td>
                        <td></td>
                        <td></td>
                        <td class="update-button">UPDATE</td>
                    </tr>
                </tbody>
            </table>
        </div>      
    <script src="{{ asset('js/admin/adfullypaid.js') }}"></script>     
</body>
</html>