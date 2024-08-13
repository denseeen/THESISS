<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Installment</title>
        
        <!-- Stylesheets -->
        <link href="{!! url('css/admin/admininstallment.css') !!}" rel="stylesheet">
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
    
     <div class="topnav">
        <h3 style="padding: 1%;text-align: center;color: aliceblue; ">ADMIN INSTALLMENT </h3>
    </div> 
      
    
    <div class="installment-container">
        <h2>INSTALLMENT PROCESS</h2>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Unit</th>
                    <th>Installment Plan</th>
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
                    <td><a href="#">Marian Naparan</a></td>
                    <td>ERV3</td>
                    <td>6 MONTHS</td>
                    <td>OTC</td>
                    <td>10,000</td>
                    <td>MARCH 30 2021</td>
                    <td>Paid</td>
                    <td>-</td>
                    <td>-</td>
                    <td><a href="#" class="update-button">UPDATE</a></td>
                </tr>
                <tr>
                    <td><a href="#">Marian Naparan</a></td>
                    <td>ERV3</td>
                    <td>6 MONTHS</td>
                    <td>ONLINE</td>
                    <td>9,650</td>
                    <td>MARCH 30 2021</td>
                    <td>Paid</td>
                    <td>-</td>
                    <td>-</td>
                    <td><a href="#" class="update-button">UPDATE</a></td>
                </tr>
                <tr>
                    <td><a href="#">Marian Naparan</a></td>
                    <td>ERV3</td>
                    <td>6 MONTHS</td>
                    <td>ONLINE</td>
                    <td>9,650</td>
                    <td>MARCH 30 2021</td>
                    <td>Paid</td>
                    <td>-</td>
                    <td>-</td>
                    <td><a href="#" class="archive-button">ARCHIVED</a></td>
                </tr>
            </tbody>
        </table>
    </div>


    <div class="container">
        <div class="customer-info">
            <h2>Customer Name:</h2>
            <p><strong>Marian Naparan</strong></p>
            <p>Email: marian_naparan@gmail.com</p>
            <p>Phone Number: 0956946355</p>
            <p>Address: Quezon City Cubao</p>
            <a href="#" class="edit-button">Edit</a>
        </div>
        
        <div class="transaction-records">
            <h2>Transaction Records</h2>
            <p>Unit Price: ERVS3 59,800</p>
            <p>Balance: 30,500</p>

            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Unit</th>
                        <th>Installment Plan</th>
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
                        <td><a href="#">Marian Naparan</a></td>
                        <td>ERV3</td>
                        <td>6 MONTHS</td>
                        <td>OTC</td>
                        <td>10,000</td>
                        <td>MARCH 30 2021</td>
                        <td>Paid</td>
                        <td>-</td>
                        <td>-</td>
                        <td><a href="#" class="update-button">UPDATE</a></td>
                    </tr>

                    <tr>
                        <td><a href="#">Marian Naparan</a></td>
                        <td>ERV3</td>
                        <td>6 MONTHS</td>
                        <td>ONLINE</td>
                        <td>9,650</td>
                        <td>MARCH 30 2021</td>
                        <td>Paid</td>
                        <td>-</td>
                        <td>-</td>
                        <td><a href="#" class="update-button">UPDATE</a></td>
                    </tr>

                    <tr>
                        <td><a href="#">Marian Naparan</a></td>
                        <td>ERV3</td>
                        <td>6 MONTHS</td>
                        <td>ONLINE</td>
                        <td>9,650</td>
                        <td>MARCH 30 2021</td>
                        <td>Paid</td>
                        <td>-</td>
                        <td>-</td>
                        <td><a href="#" class="archive-button">ARCHIVED</a></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="container">
            <div class="customer-info">
                <h2>Customer Name:</h2>
                <p><strong>Marian Naparan</strong></p>
                <p>Email: marian_naparan@gmail.com</p>
                <p>Phone Number: 0956946355</p>
                <p>Address: Quezon City Cubao</p>
                <a href="#" class="edit-button">Edit</a>
            </div>

            <div class="transaction-records">
                <h2>Transaction Records</h2>
                <p>Unit Price: ERVS3 59,800</p>
                <p>Balance: 30,500</p>

                <table>
                    <tr>
                        <th>Date</th>
                        <th>Amount</th>
                    </tr>

                    <tr>
                        <td>March 30 2021</td>
                        <td>10,000</td>
                    </tr>

                    <tr>
                        <td>April 15 2021</td>
                        <td>9,650</td>
                    </tr>

                    <tr>
                        <td>May 15 2021</td>
                        <td>9,650</td>
                    </tr>
                </table>
            </div>
        </div>
        <script src="{{ asset('js/admin/adinstallment.js') }}"></script>
</body>
</html>