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
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=print" />
   
   
       
        <!-- Font Awesome for icons (sideNav-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
       
    </head>
 
    <body>
        <!-- Top Navbar -->
        <nav class="top_navbar">
        <li>Anonas Branch</li>
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
                        <li><a href="{{ route('FullyPaid_Customer.show') }}"><span class="icon"><i class="fa fa-book"></i></span><span class="text">Cash</span></a></li>
                        <li><a href="{{ route('installments.archived') }}"><span class="icon"><i class="fa fa-question-circle"></i></span><span class="text">Fully Paid</span></a></li>      
                    </ul>
                </div>
            </div>
        </div>
 
       
        <div class="installment-design">
        <img src="/image/installment_bg.jpg" alt="bg-installment" class="bg-image">
         <h2>CASH PROCESS</h2>
        </div>
       
 
<div class="installment-container">
 
 
        <div class="container" style="margin-bottom: 1%;">
 
            <form id="searchCustomerForm"  style="width:50%; display:flex;">
           
                <input type="text" id="customerName" placeholder="Search by name..." required>
                <button type="submit">Search</button>
                <div id="searchStatusMessage" class="status-message"> </div>
            </form>
        </div>
 
        <table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Account Number</th>
            <th>Payment Method</th>
            <th>Amount</th>
            <th>Date</th>
            <th>Status</th>
            <th>Violation</th>
            <th>Comment</th>
            <th>Update</th>
            <th>Archive</th>
        </tr>
    </thead>
    <tbody>
        @foreach($finalInstallments as $installment)
        <tr>
            <td>
                <a href="#" class="customer-link" data-customer-id="{{ $installment['id'] }}">{{ $installment['name'] }}</a>
            </td>
 
            <!-- Form for updating the installment -->
            <form action="{{ route('installment.store') }}" method="POST">
                @csrf
                <input type="hidden" name="customer_id" value="{{ $installment['id'] }}"> <!-- Pass the customer ID here -->
 
                <td>
                    <input type="number" name="account_number" placeholder="Enter Account Number" required>
                </td>
 
                <td>
                    <select id="payment_method" name="payment_method" required>
                        <option value="otc">OTC</option>
                        <option value="online">Online</option>
                    </select>
                </td>
 
                <td>
                    <input type="number" name="amount" placeholder="Enter Amount" required>
                </td>
 
                <td>
                    <input type="date" name="date" required>
                </td>
 
                <td>
                    <select id="status" name="status" required>
                        <option value="paid">Paid</option>
                        <option value="not_paid">Not Paid</option>
                    </select>
                </td>
 
                <td>
                    <input type="text" name="violation" placeholder="Enter Violation">
                </td>
 
                <td>
                    <input type="text" name="comment" placeholder="Enter Comment">
                </td>
 
                <td>
                    <button type="submit">UPDATE</button>
                </td>
            </form>
 
            <!-- Form for archiving the installment -->
            <form action="{{ route('installment.archive') }}" method="POST" style="display:inline;">
                @csrf
                <input type="hidden" name="customer_id" value="{{ $installment['id'] }}">
                <td>
                    <button type="submit">ARCHIVE</button>
                </td>
            </form>
        </tr>
        @endforeach
    </tbody>
</table>
 
</div>
 
 
 
 
 <!-- Modal for search/edit transaction -->
 <div id="searchResultsModal" class="modal">
        <div class="modal-content">
            <span class="close-button" style="float: inline-end; font-size:175%">&times;</span>
            <h2>Search Results</h2>
            <div id="searchResults"></div>
        </div>
    </div>
</div>
 
 
 
 
 <!-- Modal Structure -->
<div id="customer-modal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <div class="modal-body">
            <!-- Flex container for customer info and transaction records -->
            <div class="flex-columns">
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
                    <!-- <a href="{{ route('edit.show') }}" class="edit-button">Edit</a> -->
                   
                 
                </div>
 
                <div class="transaction-records">
                    <h2>Orders Details</h2>
                   
                    <p>Unit Price: <span id="modal-unitprice"></span></p>
                    <p>Balance: <span id="modal-balance"></span></p> <!-- Added closing span tag -->
   
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
 document.getElementById('searchCustomerForm').addEventListener('submit', function(event) {
    event.preventDefault();

    const name = document.getElementById('customerName').value;
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    console.log(`Searching for customer: ${name}`); // Debugging statement

    fetch(`/search-customer?name=${encodeURIComponent(name)}`, {
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json',
        },
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok: ' + response.statusText);
        }
        return response.json();
    })
    .then(data => {
        console.log(`Customer search results:`, data); // Debugging statement
        const resultsDiv = document.getElementById('searchResults');
        resultsDiv.innerHTML = '';

        if (data.length === 0) {
            resultsDiv.innerHTML = '<p>No customers found.</p>';
            showModal(); // Show modal even if no results
            return;
        }

        data.forEach(customer => {
            resultsDiv.innerHTML += `
                <div>
                    <h3>${customer.name}</h3>
                    <h4>Installment Processes:</h4>
                    <div id="installments-${customer.id}"></div>
                </div>
            `;

            console.log(`Fetching installments for customer ID: ${customer.id}`); // Debugging statement

            // Fetch installments for each customer
            fetch(`/get-installments/${customer.id}`, {
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                },
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok: ' + response.statusText);
                }
                return response.json();
            })
            .then(installments => {
                console.log(`Installments for customer ID ${customer.id}:`, installments); // Debugging statement
                const installmentsDiv = document.getElementById(`installments-${customer.id}`);
                installmentsDiv.innerHTML = ''; // Clear previous installment details

                if (installments.length === 0) {
                    installmentsDiv.innerHTML = '<p>No installments found.</p>';
                    return;
                }

                installments.forEach(installment => {
                    installmentsDiv.innerHTML += `
                        <div class="installment">
                            <h3>Installment Details</h3>
                            <p><strong>Payment Method:</strong> ${installment.payment_method}</p>
                            <p><strong>Amount:</strong> ${installment.amount}</p>
                            <p><strong>Date:</strong> ${installment.date}</p>
                            <p><strong>Status:</strong> ${installment.status}</p>
                            <button class="editButton" data-installment-id="${installment.id}">Edit</button>
                        </div>
                    `;
                });
            })
            .catch(error => {
                console.error('Error fetching installments:', error);
            });
        });

        showModal(); // Show modal with results
    })
    .catch(error => {
        console.error('Error fetching customers:', error);
        const statusMessage = document.getElementById('searchStatusMessage');
        statusMessage.innerText = 'An error occurred: ' + error.message;
        statusMessage.className = 'status-message status-error';
    });
});

function showModal() {
    const modal = document.getElementById("searchResultsModal");
    modal.style.display = "block";
}

function hideModal() {
    const modal = document.getElementById("searchResultsModal");
    modal.style.display = "none";
}

// Close the modal when the user clicks on <span> (x)
document.querySelector('.close-button').addEventListener('click', hideModal);

// Use event delegation to handle edit button clicks dynamically
document.getElementById('searchResults').addEventListener('click', function(event) {
    if (event.target.classList.contains('editButton')) {
        const installmentId = event.target.dataset.installmentId;
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        console.log(`Fetching details for installment ID: ${installmentId}`); // Debugging statement

        // Fetch installment data
        fetch(`/get-installment/${installmentId}`, {
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json',
            },
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok: ' + response.statusText);
            }
            return response.json();
        })
        .then(installment => {
            console.log(`Installment details for ID ${installmentId}:`, installment); // Debugging statement
            // Check if the form already exists to avoid duplicates
            const installmentDiv = event.target.closest('.installment');
            const existingForm = installmentDiv.querySelector('.updateInstallmentForm');

            // Remove existing form if it's already there
            if (existingForm) {
                existingForm.remove();
            }

            // Build the form HTML
            const formHTML = `
                <form class="updateInstallmentForm" data-installment-id="${installmentId}">
                    <h2>Update Installment Process</h2>
                    <div class="form-group">
                        <label for="payment_method">Payment Method:</label>
                        <input type="text" name="payment_method" value="${installment.payment_method}" required>
                    </div>
                    <div class="form-group">
                        <label for="amount">Amount:</label>
                        <input type="number" name="amount" value="${installment.amount}" required>
                    </div>
                    <div class="form-group">
                        <label for="date">Date:</label>
                        <input type="date" name="date" value="${installment.date}" required>
                    </div>
                    <div class="form-group">
                        <label for="status">Status:</label>
                        <input type="text" name="status" value="${installment.status}" required>
                    </div>
                    <div class="form-group">
                        <label for="violation">Violation:</label>
                        <input type="text" name="violation" value="${installment.violation || ''}">
                    </div>
                    <div class="form-group">
                        <label for="comment">Comment:</label>
                        <textarea name="comment">${installment.comment || ''}</textarea>
                    </div>
                    <button type="submit" class="update-button">Update Installment Process</button>
                    <div class="status-message"></div>
                </form>
            `;

            // Append the form below the clicked installment entry
            installmentDiv.insertAdjacentHTML('beforeend', formHTML);
        })
        .catch(error => {
            console.error('Error fetching installment:', error);
        });
    }
});

// Handle installment update form submission
// Handle installment update form submission
document.getElementById('searchResults').addEventListener('submit', function(event) {
    if (event.target.classList.contains('updateInstallmentForm')) {
        event.preventDefault();
        const form = event.target;
        const installmentId = form.dataset.installmentId; // Getting the ID here
        const formData = new FormData(form);
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        console.log(`Updating installment with ID: ${installmentId}`); // Log the ID for debugging

        fetch(`/update-installment/${installmentId}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json',
            },
            body: formData,
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok: ' + response.statusText);
            }
            return response.json();
        })
        .then(data => {
    console.log('Update response:', data); // Log the entire response object

    // Check if the message is in the response
    if (data.message) {
        const statusMessage = form.querySelector('.status-message');
        statusMessage.innerText = data.message; // Display only the success message
        statusMessage.className = 'status-message status-success';
    } else {
        console.error('Unexpected response structure:', data);
        const statusMessage = form.querySelector('.status-message');
        statusMessage.innerText = 'An error occurred: installment details not found.';
        statusMessage.className = 'status-message status-error';
    }
})
        .catch(error => {
            console.error('Error updating installment:', error);
            const statusMessage = form.querySelector('.status-message');
            statusMessage.innerText = 'An error occurred: ' + error.message;
            statusMessage.className = 'status-message status-error';
        });
    }
});



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
    const modal = document.getElementById("searchResultsModal");
    const closeButton = modal.querySelector('.close-button');

    closeButton.addEventListener('click', hideModal);
    window.addEventListener('click', function(event) {
        if (event.target === modal) {
            hideModal();
        }
    });
});



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

                    // Normalize and calculate values
                    const unitPrice = parseFloat(paymentData.unit_price.replace(/,/g, '')) || 0;
                    const totalPaid = paymentData.installment_process.reduce((sum, payment) => {
                        return sum + (parseFloat(payment.amount) || 0);
                    }, 0);

                    let balance = Math.max(0, unitPrice - totalPaid);

                    // Populate payment schedule table
                    const tableBody = document.getElementById('payment-schedule-table-body');
                    tableBody.innerHTML = ''; // Clear existing rows

                    paymentData.payment_schedule.forEach((paymentSchedule, index) => {
                        const row = document.createElement('tr');
                        const dateCell = document.createElement('td');
                        const amountCell = document.createElement('td');
                        const statusCell = document.createElement('td');

                        dateCell.textContent = paymentSchedule.date;
                        amountCell.textContent = paymentSchedule.amount;
                        statusCell.textContent = 'Pending'; // Default status

                        const paymentDate = new Date(paymentSchedule.date);  // Scheduled payment due date
                        const currentInstallment = paymentData.installment_process[index];  // Actual installment made by the customer

                        if (currentInstallment) {
                            const installmentDate = new Date(currentInstallment.date);  // Date when the customer made the payment

                            console.log(`Installment Date: ${installmentDate}`);
                            console.log(`Payment Date: ${paymentDate}`);

                            if (installmentDate < paymentDate) {
                                // Paid in advance: Apply discount
                                const discountAmount = 100;
                                balance = Math.max(0, balance - discountAmount);
                                statusCell.textContent = 'Paid Advance';
                                console.log(`Discount applied: -${discountAmount}. New balance: ${balance}`);
                            } else if (installmentDate.getTime() === paymentDate.getTime()) {
                                // Paid exactly on time: No discount or penalty
                                statusCell.textContent = 'Paid';
                                console.log("Paid on time, no discount or penalty.");
                            } else if (installmentDate > new Date(paymentDate.getTime() + 3 * 24 * 60 * 60 * 1000)) {
                                // Late payment by more than 3 days: Apply penalty
                                const penaltyAmount = paymentSchedule.amount * 0.10;
                                balance += penaltyAmount;
                                statusCell.textContent = 'Paid Late';
                                console.log(`Penalty applied: +${penaltyAmount.toFixed(2)}. New balance: ${balance}`);
                            } else {
                                // Paid within the 3-day grace period: No penalty
                                statusCell.textContent = 'Paid';
                                console.log("Paid within 3-day grace period, no penalty. Balance remains: " + balance);
                            }

                            // Log the balance after each decision
                            console.log(`Current balance after processing this payment: ${balance}`);
                        }

                        row.appendChild(dateCell);
                        row.appendChild(amountCell);
                        row.appendChild(statusCell);
                        tableBody.appendChild(row);
                    });

                    // Format the final balance after all adjustments
                    const formattedBalance = new Intl.NumberFormat('en-US', {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2,
                    }).format(balance);
                    
                    // Update balance in the modal
                    document.getElementById('modal-balance').textContent = formattedBalance;

                    // Populate installment process table
                    const installmentTableBody = document.getElementById('installment-details-table-body');
                    installmentTableBody.innerHTML = '';

                    paymentData.installment_process.forEach(detail => {
                        const row = document.createElement('tr');
                        const dateCell = document.createElement('td');
                        const amountCell = document.createElement('td');
                        const paymentMethodCell = document.createElement('td');
                        const violationCell = document.createElement('td');
                        const commentCell = document.createElement('td');

                        const installmentDate = new Date(detail.date);
                        dateCell.textContent = installmentDate.toLocaleDateString('en-GB', {
                            day: 'numeric',
                            month: 'long',
                            year: 'numeric'
                        });

                        amountCell.textContent = detail.amount;
                        paymentMethodCell.textContent = detail.payment_method;
                        violationCell.textContent = detail.violation || '-';
                        commentCell.textContent = detail.comment || '-';

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