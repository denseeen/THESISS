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
                <th>Account Number</th>
                <th>Unit Name</th>
                <th>Contact Number</th>
                <th>Payment Service</th>  <!-- New column added here -->
                <th>View</th>
                <th>Delete</th>
            </tr>
        </thead>
 
        <tbody>
            @foreach($yourSpecificIdsArray as $customerId => $customer)
                <tr>
                    <td>{{ $customer['customer_name'] }}</td>
                    <td>{{ $customer['account_number'] ?? 'N/A' }}</td>
                    <td>
                        {{ implode(', ', $customer['unit_names']->toArray()) }}
                    </td>
                    <td>{{ $customer['customer_phoneNum'] ?? 'N/A' }}</td>
                    <td>  {{ $customer['payment_service']['is_installment'] ? 'Installment' : 'Fully Paid' }}</td> <!-- New data cell for Payment Service -->
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
                    <!-- <a href="#" class="edit-button">Edit</a> -->
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
 
 
            <!-- Installment Details Table -->
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Account Number</th>
                            <th>Date</th>
                            <th>Amount Paid</th>
                            <th>Payment Method</th>
                            <th>Status</th>
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
 
            // Fetch customer details from the server
            fetch(`/customer/${customerId}`)
                .then(response => {
                    if (!response.ok) throw new Error('Failed to fetch customer data');
                    return response.json();
                })
                .then(customerData => {
                    // Update modal content with fetched customer details
                    document.getElementById('modal-name').textContent = customerData.name || "N/A";
                    document.getElementById('modal-email').textContent = customerData.email || "N/A";
                    document.getElementById('modal-phone').textContent = customerData.phone_number || "N/A";
                    document.getElementById('modal-address').textContent = customerData.address || "N/A";
 
                    // Fetch payment schedule
                    return fetch(`/payment-schedule/${customerId}`);
                })
                .then(response => {
                    if (!response.ok) {
                        // Handle case where payment schedule is not found
                        handleNoPaymentSchedule();
                        return;
                    }
                    return response.json();
                })
                .then(paymentData => {
                    // Validate payment data
                    if (!paymentData || typeof paymentData.unit_price === 'undefined') {
                        handleNoPaymentSchedule();
                        return;
                    }
 
                    // Display the unit price
                    const unitPrice = parseFloat(paymentData.unit_price.replace(/,/g, '')) || 0;
                    document.getElementById('modal-unitprice').textContent = unitPrice.toLocaleString('en-US', { minimumFractionDigits: 2 });
 
                    // Calculate total paid and balance
                    const installmentProcess = paymentData.installment_process || [];
                    const totalPaid = installmentProcess.reduce((sum, payment) => sum + (parseFloat(payment.amount) || 0), 0);
                    const balance = Math.max(0, unitPrice - totalPaid);
                   
                    // Display balance or fully paid message
                    if (balance === 0) {
                        document.getElementById('modal-balance').textContent = "Fully Paid";
                    } else {
                        document.getElementById('modal-balance').textContent = balance.toLocaleString('en-US', { minimumFractionDigits: 2 });
                    }
 
                    // Populate payment schedule table
                    populatePaymentScheduleTable(paymentData.payment_schedule);
 
                    // Populate installment details table
                    populateInstallmentDetailsTable(installmentProcess);
 
                    modal.style.display = 'block';
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                    handleNoPaymentSchedule();
                });
        });
    });
 
    closeButton.addEventListener('click', function() {
        modal.style.display = 'none';
    });
 
    window.addEventListener('click', function(event) {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });
 
    function handleNoPaymentSchedule() {
        document.getElementById('modal-unitprice').textContent = "N/A";
        document.getElementById('modal-balance').textContent = "N/A";
        document.getElementById('payment-schedule-table-body').innerHTML = "<tr><td colspan='3'>No payment schedule available.</td></tr>";
        document.getElementById('installment-details-table-body').innerHTML = "<tr><td colspan='3'>No installment detail available.</td></tr>";
        modal.style.display = 'block';
    }
 
    function populatePaymentScheduleTable(paymentSchedule) {
        const tableBody = document.getElementById('payment-schedule-table-body');
        tableBody.innerHTML = '';
        if (paymentSchedule && paymentSchedule.length > 0) {
            paymentSchedule.forEach(payment => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${payment.date || "N/A"}</td>
                    <td>${payment.amount || "N/A"}</td>
                    <td>${payment.status || "N/A"}</td>
                `;
                tableBody.appendChild(row);
            });
        } else {
            const noPaymentsRow = document.createElement('tr');
            noPaymentsRow.innerHTML = `<td colspan="3">No payment schedule available for this customer.</td>`;
            tableBody.appendChild(noPaymentsRow);
        }
    }
 
    function populateInstallmentDetailsTable(installmentProcess) {
        const installmentTableBody = document.getElementById('installment-details-table-body');
        installmentTableBody.innerHTML = '';
        if (installmentProcess.length > 0) {
            installmentProcess.forEach(detail => {
                const row = document.createElement('tr');
                const installmentDate = new Date(detail.date).toLocaleDateString('en-GB', {
                    day: 'numeric',
                    month: 'long',
                    year: 'numeric'
                });
                row.innerHTML = `
                    <td>${detail.account_number || "N/A"}</td>
                    <td>${installmentDate       || "N/A"}</td>
                    <td>${detail.amount         || "N/A"}</td>
                    <td>${detail.payment_method || "N/A"}</td>
                    <td>${detail.violation      || "N/A"}</td>
                    <td>${detail.comment        || "N/A"}</td>
                `;
                installmentTableBody.appendChild(row);
            });
        } else {
            const noInstallmentsRow = document.createElement('tr');
            noInstallmentsRow.innerHTML = `<td colspan="5">No installment details available for this customer.</td>`;
            installmentTableBody.appendChild(noInstallmentsRow);
        }
    }
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