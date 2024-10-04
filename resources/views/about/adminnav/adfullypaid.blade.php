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
            <a href="{{ route('admin_dashboard.show') }}">
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
                        <a href="{{ route('adsecurity.show') }}">Security</a>
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
                        <li><a href="{{ route('admin_dashboard.show') }}"><span class="icon"><i class="fa fa-qrcode"></i></span><span class="text">Dashboard</span></a></li>
                        <li><a href="{{ route('adrequest.show') }}"><span class="icon"><i class="fa fa-link"></i></span><span class="text">Application</span></a></li>
                        <li><a href="{{ route('Installment_Customer.show') }}"><span class="icon"><i class="fa fa-eye"></i></span><span class="text">Installment</span></a></li>
                        <li><a href="{{ route('FullyPaid_Customer.show') }}"><span class="icon"><i class="fa fa-book"></i></span><span class="text">Fully Paid</span></a></li>
                        <li><a href="{{ route('adarchived.show') }}"><span class="icon"><i class="fa fa-question-circle"></i></span><span class="text">Archived</span></a></li>       
                    </ul>
                </div>
            </div>
        </div>

<!-- content -->
<div class="installment-container">
                <h2>Fully Paid PROCESS</h2>
                <table>
                    <thead>
                        <tr>
                            <th style= "width:20%;">Name</th>
                           
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
                    @foreach($fullpaids as $fullpaid)
                <tr>
                    <td><a href="#" class="customer-link" data-customer-id="{{ $fullpaid->id }}">{{ $fullpaid->name }}</a></td>
                    <td>
                        <select name="payment_method">
                            <option value="OTC">OTC</option>
                            <option value="ONLINE">ONLINE</option>
                        </select>
                    </td>
                    <td><input type="number" name="amount" placeholder="Enter Amount"></td>
                    <td><input type="date" name="date"></td>
                    <td>
                        <select name="status">
                            <option value="paid">Paid</option>
                            <option value="not_paid">Not Paid</option>
                            <option value="fully_paid">Fully Paid</option>
                        </select>
                    </td>
                    <td><input type="text" name="violation" placeholder="Enter Violation"></td>
                    <td><input type="text" name="comment" placeholder="Enter Comment"></td>
                    <td>
                        <select class="action-dropdown">
                            <option value="update">Update</option>
                            <option value="archive">Archive</option>
                        </select>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
 
 
 
               
                <!-- Modal Structure -->
                <div id="customer-modal" class="modal">
                    <div class="modal-content">
                        <span class="close">&times;</span>
                        <div class="modal-body">
                            <!-- Flex container for customer info and transaction records -->
                            <div class="flex-columns">
                                <div class="customer-info">
                                    <h2>Customer Name:</h2>
                                    <p><strong id="modal-name"></strong></p>
                                    <p>Email: <span id="modal-email"></span></p>
                                    <p>Phone Number: <span id="modal-phone"></span></p>
                                    <p>Address: <span id="modal-address"></span></p>
                                    <a href="#" class="edit-button">Edit</a>
                                </div>
 
                                <div class="transaction-records">
                                    <h2>Transaction Records</h2>
                                    <p>Unit Price: ERVS3 59,800</p>
                                    <p>Balance: 30,500</p>
                                </div>
                            </div>
 
                            <!-- Table below the customer info and transaction records -->
                            <div class="table-container">
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
                    </div>
                </div>
 
 
 
    <script>
 
    document.addEventListener('DOMContentLoaded', (event) => {
        const modal = document.getElementById('customer-modal');
        const closeButton = document.querySelector('.close');
        const customerLinks = document.querySelectorAll('.customer-link');
 
        customerLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const customerId = this.getAttribute('data-customer-id');
 
                // Fetch customer details from the server
                fetch(`/customer/${customerId}`)
                    .then(response => response.json())
                    .then(data => {
                        // Update modal content with fetched data
                        document.getElementById('modal-name').textContent = data.name;
                        document.getElementById('modal-email').textContent = data.email;
                        document.getElementById('modal-phone').textContent = data.phone_number;
                        document.getElementById('modal-address').textContent = data.address;
 
                        // Open modal
                        modal.style.display = 'block';
                    })
                    .catch(error => console.error('Error fetching customer details:', error));
            });
        });
 
        // Close modal
        closeButton.addEventListener('click', function() {
            modal.style.display = 'none';
        });
 
        // Close modal if outside click
        window.addEventListener('click', function(event) {
            if (event.target === modal) {
                modal.style.display = 'none';
            }
        });
    });

    </script> 
    <script src="{{ asset('js/admin/adfullypaid.js') }}"></script>     
    <script src="{{ asset('js/admin/toppsidenav.js') }}"></script>  
</body>
</html>