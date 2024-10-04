<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
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
     
 
 
<div class="installment-container">
    <h2>INSTALLMENT PROCESS</h2>
    <table>
        <thead>
            <tr>
                <th>Name</th>
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
    @foreach($installments as $installment)
    <tr>
            <td>
                <a href="#" class="customer-link" data-customer-id="{{ $installment->id }}">{{ $installment->name }}</a>
            </td>

            <form action="{{ route('installment.store') }}" method="POST">
            @csrf
            <input type="hidden" name="customer_id" value="{{ $installment->id }}"> <!-- Pass the customer ID here -->

            <td>      
    <select id="payment_method" name="payment_method">
        <option value="otc">OTC</option>
        <option value="online">Online</option>
    </select>
    </td>


    <td>
    <input type="number" name="amount" placeholder="Enter Amount">
    </td>

    <td>
    <input type="date" name="date">
    </td>
 
    <td>
    <select id="status" name="status">
        <option value="paid">Paid</option>
        <option value="not paid">Not Paid</option>
    </select>
    </td>

    <td>
    <input type="text" name="violation" placeholder="Enter Violation">
    </td>

    <td>
    <input type="text" name="comment" placeholder="Enter Comment">
    </td>

    <td>
    <button type="update">update</button>
    </td>
</form>

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
                    <p>Unit Price: <span id="modal-unitprice"></span></p>
                    <span id="modal-status"></span>
                </div>
            </div>
 
            <!-- Payment Schedule Table -->
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody id="payment-schedule-table-body">
                        <!-- Dynamic rows go here -->
                         
                    </tbody>
                </table>
            </div>


            <div class="tableee-container">
                <table>
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Payment Method</th>
                            <th>Violation</th>
                            <th>Comment</th>
                        </tr>
                    </thead>
                    <tbody id="installment-details-table-body">
        <!-- Rows will be added dynamically -->
    </tbody>
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
 
            // Fetch customer details and payment schedule from the server
            fetch(`/customer/${customerId}`)
                .then(response => response.json())
                .then(customerData => {
                    // Update modal content with fetched customer details
                    document.getElementById('modal-name').textContent = customerData.name;
                    document.getElementById('modal-email').textContent = customerData.email;
                    document.getElementById('modal-phone').textContent = customerData.phone_number;
                    document.getElementById('modal-address').textContent = customerData.address;
 
                    // Fetch payment schedule
                    return fetch(`/payment-schedule/${customerId}`);
                })
                .then(response => response.json())
                .then(paymentData => {
                    // Update unit price
                    document.getElementById('modal-unitprice').textContent = paymentData.unit_price;
        
 
                    // Populate payment schedule table
                    const tableBody = document.getElementById('payment-schedule-table-body');
                    tableBody.innerHTML = ''; // Clear existing rows
 
                    paymentData.payment_schedule.forEach(payment => {
                        const row = document.createElement('tr');
                        const dateCell = document.createElement('td');
                        const amountCell = document.createElement('td');
                        const statusCell = document.createElement('td');
 
                        dateCell.textContent = payment.date;
                        amountCell.textContent = payment.amount;
                        statusCell.textContent = payment.status;
 
                        row.appendChild(dateCell);
                        row.appendChild(amountCell);
                        row.appendChild(statusCell);
                        tableBody.appendChild(row);
                    });

                     // Populate installment process table
                const installmentTableBody = document.getElementById('installment-details-table-body');
                installmentTableBody.innerHTML = ''; // Clear existing rows

                paymentData.installment_process.forEach(detail => {
                    const row = document.createElement('tr');
                    const dateCell = document.createElement('td');
                    const amountCell = document.createElement('td');
                    const paymentMethodCell = document.createElement('td');
                    const violationCell = document.createElement('td');
                    const commentCell = document.createElement('td');

                    dateCell.textContent = detail.date;
                    amountCell.textContent = detail.amount;

                    // Format date for installment details
                    const installmentDate = new Date(detail.date);
                    dateCell.textContent = installmentDate.toLocaleDateString('en-GB', {
                        day: 'numeric',
                        month: 'long',
                        year: 'numeric'
                    });
                    
                    paymentMethodCell.textContent = detail.payment_method;
                    violationCell.textContent = detail.violation;
                    commentCell.textContent = detail.comment;

                    row.appendChild(dateCell);
                    row.appendChild(amountCell);
                    row.appendChild(paymentMethodCell);
                    row.appendChild(violationCell);
                    row.appendChild(commentCell);
                    installmentTableBody.appendChild(row);
                });

 
                    // Open modal
                    modal.style.display = 'block';
                })
                .catch(error => console.error('Error fetching data:', error));
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
 
        //darkmode
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
            <script src="{{ asset('js/admin/adinstallment.js') }}"></script>
            <script src="{{ asset('js/admin/toppsidenav.js') }}"></script>  
    </body>
</html>