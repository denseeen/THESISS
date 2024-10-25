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
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=print" />
    
        <!-- Font Awesome for icons (sideNav-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">  
    </head>

    <body>
        <!-- Top Navbar -->
        <nav class="top_navbar">
        <li >Anonas Branch</li>
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

<!-- content -->

<div class="installment-design">
        <img src="/image/installment_bg.jpg" alt="bg-installment" class="bg-image">
         <h2>Fully Paid PROCESS</h2>
        </div>

<div class="installment-container">
             
                <table>
                    <thead>
                        <tr>
                            <th style= "width:20%;">Name</th>
                            <th>Account Number</th>
                            <th>Payment Method</th>
                            <th>Amount</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Update</th>
                            <th>Add Order</th>
                            <th>Archive</th>
                        </tr>
                    </thead>
                    <tbody>
                                @foreach($finalFullPaids as $fullpaid)
                <tr>
                    <!-- Accessing array values using ['key'] notation -->
                    <td><a href="#" class="customer-link" data-customer-id="{{ $fullpaid['id'] }}">{{ $fullpaid['name'] }}</a></td>
                    
                    <form action="{{ route('installment.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="customer_id" value="{{ $fullpaid['id'] }}"> <!-- Pass the customer ID here -->
                        
                        <td>
                            <input type="number" name="account_number" placeholder="Enter Account Number">
                        </td>

                        <td>      
                            <select id="payment_method" name="payment_method">
                                <option value="otc">OTC</option>
                                <option value="online">Online</option>
                            </select>
                        </td>

                        <td>
                            <input type="number" name="amount" placeholder="Enter Amount" step="0.01">
                        </td>

                        <td>
                            <input type="date" name="date">
                        </td>

                        <td>
                            <select id="status" name="status">
                                <option value="fully_paid">Fully Paid</option>
                                <option value="paid">Paid</option>
                                <option value="not_paid">Not Paid</option>
                            </select>
                        </td>

                        <input type="hidden" name="violation" value="" placeholder="Enter Violation">
                        <input type="hidden" name="comment" value="" placeholder="Enter Comment">

                        <td>
                            <button type="submit">UPDATE</button>
                        </td>
                    </form>

                    <td>
                        <button id="addOrderButton" class="addOrderButton" data-customer-id="{{ $fullpaid['id'] }}">Add Order</button>
                    </td>
                    
                    <!-- Form for archiving installment -->
                    <form action="{{ route('installment.archive') }}" method="POST" style="display:inline;">
                        @csrf
                        <input type="hidden" name="customer_id" value="{{ $fullpaid['id'] }}">
                        <td>
                            <button type="submit">ARCHIVE</button>
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
            <div class="flex-columns">
                <!-- Customer Info Section -->
                <div class="customer-info">
                    <div class="btn-print-design">
                        <h2>Customer Name:</h2>
                        <button class="btn-print" type="button" onclick="printModal('customer-modal')">
                            <span class="material-symbols-outlined">print</span>
                        </button>
                    </div>
                        <h2><strong id="modal-name"></strong></h2>
                        <p>Email: <span id="modal-email"></span></p>
                        <p>Phone Number: <span id="modal-phone"></span></p>
                        <p>Address: <span id="modal-address"></span></p>
                </div>

                <!-- Transaction Records Section -->
                <div class="transaction-records">
                <h2>Order Details</h2>
                    <p>Unit Name: <span id="modal-unitname"></span></p>
                    <p>Unit Price: <span id="modal-unitprice"></span></p>
                    <p>Balance: <span id="modal-balance"></span></p>
                    <span id="modal-status"></span>
                </div>
            </div>

            <!-- invoice Details Table -->
            <div class="table-container">
                <h2>Transaction Records</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>Account Number</th>
                                <th>Date</th>
                                <th>Amount Paid</th>
                                <th>Payment Method</th>
                                <th>Status</th>     
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


       <!-- Add Order Modal -->
<div id="addOrderModal" class="modal" style="display:none;">
    <div class="modal-content">
        <span class="close" id="closeModal">&times;</span>
        <h2>Add Order</h2>
        <form id="orderForm" action="{{ route('add.order') }}" method="POST">
            @csrf
            <input type="hidden" id="customer_id" name="customer_id"> <!-- This will be set dynamically -->
            <table>
                <tr>
                    <td><label for="orderNumber">Order Number:</label></td>
                    <td><input type="text" id="orderNumber" name="orderNumber" required></td>
                </tr>
                <tr>
                    <td><label for="unitName">Unit Name:</label></td>
                    <td><input type="text" id="unitName" name="unitName" required></td>
                </tr>
                <tr>
                    <td><label for="dateOrder">Date of Order:</label></td>
                    <td><input type="date" id="dateOrder" name="dateOrder" required></td>
                </tr>
                <tr>
                    <td><label for="unitprice">Unit Price:</label></td>
                    <td><input type="number" id="unitprice" name="unitprice" step="0.01" required></td>
                </tr>
                <tr>
                    <td><label for="unitDescription">Unit Description:</label></td>
                    <td><input type="text" id="unitDescription" name="unitDescription" required></td>
                </tr>
            </table>
            <button type="submit">Save Order</button>
        </form>
    </div>
</div>

    <script> 

     // PrintButton
function printModal(modalId) {
    // Get the modal element by its ID
    var modalContent = document.getElementById(modalId).innerHTML;

    // Save the current page's content
    var originalContent = document.body.innerHTML;

    // Replace the page's content with the modal's content
    document.body.innerHTML = modalContent;

    // Trigger the print function
    window.print();

    // Restore the original page content after printing
    document.body.innerHTML = originalContent;

    // Re-run any scripts or JavaScript necessary to reset the page's functionality
    window.location.reload();
}


document.addEventListener('DOMContentLoaded', (event) => {
    const modal = document.getElementById('customer-modal');
    const closeButton = document.querySelector('.close');
    const customerLinks = document.querySelectorAll('.customer-link');
    const installmentDetailsTableBody = document.getElementById('installment-details-table-body');

    customerLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const customerId = this.getAttribute('data-customer-id');

            // Fetch customer details from the server
            fetch(`/customer/${customerId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        console.error(data.error); // Handle error appropriately
                        return;
                    }

                    // Update modal content with fetched data
                    document.getElementById('modal-name').textContent = data.name;
                    document.getElementById('modal-email').textContent = data.email;
                    document.getElementById('modal-phone').textContent = data.phone_number;
                    document.getElementById('modal-address').textContent = data.address;
                    document.getElementById('modal-unitname').textContent = data.unitnames; // Updated to use unitnames
                    document.getElementById('modal-unitprice').textContent = data.unit_price; // Update unit price
                    document.getElementById('modal-balance').textContent = data.balance;

                    // Clear existing installment details
                    installmentDetailsTableBody.innerHTML = '';

                    // Populate installment details
                    data.installments.forEach(installment => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td>${installment.account_number}</td>
                            <td>${installment.date}</td>
                            <td>${installment.amount}</td>
                            <td>${installment.payment_method}</td>
                            <td>${installment.status}</td>
                           
                        `;
                        installmentDetailsTableBody.appendChild(row);
                    });

                    // Open modal
                    modal.style.display = 'block';
                })
                .catch(error => console.error('Error fetching customer details:', error));
        });
    });

    // Close modal on click
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




document.addEventListener('DOMContentLoaded', function () {
    const addOrderButtons = document.querySelectorAll('.addOrderButton'); // All add buttons
    const modal = document.getElementById('addOrderModal');
    const closeModal = document.getElementById('closeModal');
    const orderForm = document.getElementById('orderForm');
    const customerIdInput = document.getElementById('customer_id');

    // Event listener for each add order button
    addOrderButtons.forEach(button => {
        button.addEventListener('click', function () {
            // Set the customer ID dynamically
            const customerId = this.getAttribute('data-customer-id');
            customerIdInput.value = customerId; // Set the hidden input field value
            modal.style.display = 'block'; // Show the modal
        });
    });

    closeModal.addEventListener('click', function () {
        modal.style.display = 'none'; // Hide modal
    });

    window.onclick = function (event) {
        if (event.target === modal) {
            modal.style.display = 'none'; // Hide modal if clicked outside
        }
    };
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
    <script src="{{ asset('js/admin/adfullypaid.js') }}"></script>     
    <script src="{{ asset('js/admin/toppsidenav.js') }}"></script>  
</body>
</html>