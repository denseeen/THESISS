<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Archived</title>
    
        <!-- Stylesheets -->
        <link href="{!! url('css/admin/adminarchived.css') !!}" rel="stylesheet">
        <link href="{!! url('css/admin/admininstallment.css') !!}" rel="stylesheet">
        <link href="{!! url('css/admin/topnav_sidenav.css') !!}" rel="stylesheet">
 
        <!-- Font Awesome for icons (sideNav-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">   
    </head>

    <body>
        <!-- Top Navbar -->
        <nav class="top_navbar">
        <li style="font-size: 128%; margin-leftt: 11%; margin-left: 80%; display: block; color: aliceblue;">Anonas Branch</li>
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
                        <li><a href="{{ route('addashboard.show') }}"><span class="icon"><i class="fa fa-qrcode"></i></span><span class="text">Dashboard</span></a></li>
                        <li><a href="{{ route('adrequest.show') }}"><span class="icon"><i class="fa fa-link"></i></span><span class="text">Application</span></a></li>
                        <li><a href="{{ route('Installment_Customer.show') }}"><span class="icon"><i class="fa fa-eye"></i></span><span class="text">Installment</span></a></li>
                        <li><a href="{{ route('FullyPaid_Customer.show') }}"><span class="icon"><i class="fa fa-book"></i></span><span class="text">Fully Paid</span></a></li>
                        <li><a href="{{ route('installments.archived') }}"><span class="icon"><i class="fa fa-question-circle"></i></span><span class="text">Archived</span></a></li>             
                    </ul>
                </div>
            </div>
        </div>



       

        
        <div class="archive-container">
    <h2>Archived</h2>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Contract Number</th>
                <th>Unit Name</th>
                <th>Contact Number</th>
                <th>View</th>
                <th>Delete</th>
            </tr>
        </thead>

        <tbody>
            @foreach($yourSpecificIdsArray as $customerId => $customer)
                <tr>
                    <td>{{ $customer['customer_name'] }}</td>
                    <td>{{ $customer['account_number'] ?? 'N/A' }}</td> {{-- Assuming you might have to define how to get this --}}
                    <td>
                        {{ implode(', ', $customer['unit_names']->toArray()) }} {{-- Join unit names with a comma --}}
                    </td>
                    <td>{{ $customer['customer_phoneNum'] ?? 'N/A' }}</td> {{-- Assuming you might have to define how to get this --}}
                    <td>
                        <button type="submit" class="customer-link" data-customer-id="{{ $customerId }}">VIEW</button>
                    </td>
                    <td>
                        <form action="{{ route('customer.destroy', $customerId) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this customer?');">Delete</button>
                        </form>
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
                    <h2><strong id="modal-name"></strong></h2>
                    <p>Email: <span id="modal-email"></span></p>
                    <p>Phone Number: <span id="modal-phone"></span></p>
                    <p>Address: <span id="modal-address"></span></p>
                    <a href="#" class="edit-button">Edit</a>
                </div>
 
                <div class="transaction-records">
                    <h2>Transaction Records</h2>
                    <p>Unit Price: <span id="modal-unitprice"></span></p>
                    <p>Balance: <span id="modal-balance"></p>
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
                            <!-- <th>Balance</th> -->
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
                            <th>Amount Paid</th>
                            <th>Payment Method</th>
                            <th>Penalty</th>
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

               
                    // Fetch unit price from paymentData and normalize it
                    const unitPriceString = paymentData.unit_price; // Assume this is in string format
                    const unitPrice = parseFloat(unitPriceString.replace(/,/g, '')) || 0; // Remove commas before parsing

                    console.log("Unit Price: ", unitPrice); // Log to check the value

                    // Calculate total amount paid from installment process
                    const totalPaid = paymentData.installment_process.reduce((sum, payment) => {
                    return sum + (parseFloat(payment.amount) || 0); // Ensure each amount is a number
                    }, 0);

                    console.log("Total Paid: ", totalPaid); // Log to check the total paid

                    // Calculate remaining balance
                    const balance = Math.max(0, unitPrice - totalPaid);
                    console.log("Remaining Balance: ", balance); // Log to check the remaining balance

                    // Format balance to include commas and two decimal places
                    const formattedBalance = new Intl.NumberFormat('en-US', {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2,
                    }).format(balance);

                    // Update balance in modal
                    document.getElementById('modal-balance').textContent = formattedBalance; // Format to currency


       
                    // Populate payment schedule table
                    const tableBody     = document.getElementById('payment-schedule-table-body');
                    tableBody.innerHTML = ''; // Clear existing rows
 
                    paymentData.payment_schedule.forEach(payment => {
                        const row         = document.createElement('tr');
                        const dateCell    = document.createElement('td');
                        const amountCell  = document.createElement('td');
                        const statusCell  = document.createElement('td');
                        // const balanceCell = document.createElement('td'); // New cell for balance
 
                        dateCell.textContent    = payment.date;
                        amountCell.textContent  = payment.amount;
                        statusCell.textContent  = payment.status;
                        // balanceCell.textContent = payment.balance; // Add remaining balance
                       
 
                        row.appendChild(dateCell);
                        row.appendChild(amountCell);
                        row.appendChild(statusCell);
                        // row.appendChild(balanceCell); // Append balance to the row
                        tableBody.appendChild(row);
                    });
 
                     // Populate installment process table
                const installmentTableBody = document.getElementById('installment-details-table-body');
                installmentTableBody.innerHTML = ''; // Clear existing rows
 
                paymentData.installment_process.forEach(detail => {
                    const row               = document.createElement('tr');
                    const dateCell          = document.createElement('td');
                    const amountCell        = document.createElement('td');
                    const paymentMethodCell = document.createElement('td');
                    const violationCell     = document.createElement('td');
                    const commentCell       = document.createElement('td');
 
                    dateCell.textContent   = detail.date;
                    amountCell.textContent = detail.amount;
 
                    // Format date for installment details
                    const installmentDate = new Date(detail.date);
                    dateCell.textContent  = installmentDate.toLocaleDateString('en-GB', {
                        day: 'numeric',
                        month: 'long',
                        year: 'numeric'
                    });
                   
                    paymentMethodCell.textContent = detail.payment_method;
                    violationCell.textContent     = detail.violation;
                    commentCell.textContent       = detail.comment;
 
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


// document.addEventListener('DOMContentLoaded', (event) => {
//     const deleteButtons = document.querySelectorAll('.delete-button');

//     deleteButtons.forEach(button => {
//         button.addEventListener('click', function() {
//             const customerId = this.getAttribute('data-customer-id');
//             if (confirm('Are you sure you want to delete this customer?')) {
//                 fetch(`/customer/${customerId}`, {
//                     method: 'DELETE',
//                     headers: {
//                         'Content-Type': 'application/json',
//                         'X-CSRF-TOKEN': '{{ csrf_token() }}', // Include CSRF token if needed
//                     }
//                 })
//                 .then(response => {
//                     if (!response.ok) {
//                         throw new Error('Network response was not ok');
//                     }
//                     return response.json();
//                 })
//                 .then(data => {
//                     alert(data.message); // Notify user of success
//                     // Optionally remove the row from the table
//                     // this.closest('tr').remove(); // Remove the customer row
//                     location.reload(); // Reload the page to reflect the changes
//                 })
//                 .catch(error => {
//                     console.error('Error deleting customer:', error);
//                 });
//             }
//         });
//     });
// });

       
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
        
        <script src="{{ asset('js/admin/adarchived.js') }}"></script>
        <script src="{{ asset('js/admin/toppsidenav.js') }}"></script>  
    </body>
</html>