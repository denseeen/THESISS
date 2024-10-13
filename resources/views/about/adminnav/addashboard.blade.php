<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
   
        <title>Dashboard</title>

        <!-- Stylesheets -->
        <link href="{!! url('css/admin/admindashboard.css') !!}" rel="stylesheet">
        <link href="{{ url('css/admin/topnav_sidenav.css') }}" rel="stylesheet">
        <link href="{{ url('responsiv/adminnav/addashboard.css') }}" rel="stylesheet">

        <!-- Font Awesome for icons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=print" />
   
   s
    </head>

    <body>
        <!-- Top Navbar -->
        <nav class="top_navbar">
        <li style="font-size: 120%;  margin-left: 80%; display: block; color: aliceblue;">Anonas Branch</li>
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
 
 
        <div class="dashboard-design">
            <img src="/image/dashbboard_bg.jpg" alt="bg-dashboard" class="bg-image">
            <h2>Dashboard</h2>
          
        </div>

        <div class="sale-print" >

        <h3 style="margin-left:7%; color:gray;">Sales & Reports:</h3>

        <button class="btn-print" type="button" onclick="printSpecificArea()">
    <span class="material-symbols-outlined">print</span>
</button>

        </div>
        <!-- Content -->
        <!-- Billing Cards Section (Wrap with a div for printing) -->
<div id="billingCards">
    <div class="row">
        <div class="col">
            <!-- Billing card 1: Expected Income -->
            <div class="card border-start-primary">
                <div class="card-body">
                    <div class="small text-muted">Expected Income</div>
                    <div class="h3" id="expected-income">₱00.00</div>
                </div>
            </div>
        </div>
        <div class="col">
            <!-- Billing card 2: Payment Received -->
            <div class="card border-start-secondary">
                <div class="card-body">
                    <div class="small text-muted">Payment Received</div>
                    <div class="h3" id="payment-received">₱00.00</div>
                </div>
            </div>
        </div>
        <div class="col">
            <!-- Billing card 3: No. of Installment Customers -->
            <div class="card border-start-third">
                <div class="card-body">
                    <div class="small text-muted">No. of Installment Customers</div>
                    <div class="h3" id="installment-count">0</div>
                </div>
            </div>
        </div>
        <div class="col">
            <!-- Billing card 4: No. of Fully Paid Customers -->
            <div class="card border-start-forth">
                <div class="card-body">
                    <div class="small text-muted">No. of Fully Paid Customers</div>
                    <div class="h3" id="fully-paid-count">0</div>
                </div>
            </div>
        </div>
        <div class="col">
            <!-- Billing card 5: No. of Sales Units -->
            <div class="card border-start-fifth">
                <div class="card-body">
                    <div class="small text-muted">No. of Sales Units</div>
                    <div class="h3" id="sales-unit-count">0</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Other content that you do NOT want to print, like the customer list and modal, stays unchanged -->














 
             
            <!-- Customer List -->
            <div class="application-list" >
                <h2>Customer List</h2>

            <div class="search-bar mb-3" style="margin-bottom:1%;">
            <input type="text" id="searchName" placeholder="Search by name to edit info...." />
            <button id="searchButton">Search</button>
        </div>
                <table id="customerTable">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Balance</th>
                            <!-- <th>Status</th> -->
                            <th>Payment Service</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- JavaScript will populate this section -->
                    </tbody>
                </table>
            </div>
    
  
    
<!-- HTML for Modal -->
<div id="notifyModal" class="modal" style="display: none;">
    <div class="modal-content">
        <div class="modal-header">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2 id="modalTitle">Notify User</h2>
        </div>
        <div class="modal-body">
            <input type="hidden" id="recipientId" /> <!-- Hidden field to store recipient ID -->
            <textarea id="messageBox" rows="4" style="width: 100%; padding: 10px;" placeholder="Type your message here..."></textarea>
            <div id="modalFeedback" style="margin-top: 10px;"></div> <!-- Feedback message area -->
        </div>
        <div class="modal-footer">
            <button onclick="sendMessage()">Send</button>
        </div>
    </div>
</div>
 
 



<!-- Modal for Search Results and Edit Form -->
<div id="resultModal" class="modal" style="display: none;">
    <div class="modal-content">
        <span class="close" id="closeModal">&times;</span>
        <div id="resultContainer" class="result">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="resultBody"></tbody>
            </table>
            
            <!-- Edit Customer Form inside the result modal -->
            <form id="editCustomerForm" method="POST" action="/update-customer" style="display: none;">
                @csrf
                <input type="hidden" name="id" id="customerId" value="">

                <div class="form-group">
                    <label for="name" style="font-size: 50%;">Name:</label>
                    <input type="text" id="name" name="name" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="email" style="font-size: 50%;">Email:</label>
                    <input type="email" id="email" name="email" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="phone_number" style="font-size: 50%;">Phone Number:</label>
                    <input type="text" id="phone_number" name="phone_number" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="streetaddress" style="font-size: 50%;">Street Address:</label>
                    <input type="text" id="streetaddress" name="streetaddress" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="date_of_birth" style="font-size: 50%;">Date of Birth:</label>
                    <input type="date" id="date_of_birth" name="date_of_birth" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="age" style="font-size: 50%;">Age:</label>
                    <input type="number" id="age" name="age" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="facebook" style="font-size: 50%;">Facebook:</label>
                    <input id="facebook" name="facebook" class="form-control">
                </div>

                <div class="form-group">
                    <label for="gender" style="font-size: 50%;">Gender:</label>
                    <select id="gender" name="gender" class="form-control">
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="other">Other</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="telephone_number" style="font-size: 50%;">Telephone Number:</label>
                    <input type="text" id="telephone_number" name="telephone_number" class="form-control">
                </div>

                <button type="submit" class="btn btn-primary">Update Customer</button>
                
            </form>
            <div id="statusMessage" style="margin-top: 10px;"></div>
        </div>
    </div>
</div>

 
 
<script>
function printSpecificArea() {
    // Get the billing cards section
    const billingCards = document.getElementById('billingCards').outerHTML;

    // Clone the customer list to manipulate it
    const customerListContainer = document.querySelector('.application-list').cloneNode(true);

    // Remove the search input and the search button from the cloned customer list
    const searchInput = customerListContainer.querySelector('#searchName');
    const searchButton = customerListContainer.querySelector('#searchButton');
    
    if (searchInput) {
        searchInput.parentNode.removeChild(searchInput);
    }
    if (searchButton) {
        searchButton.parentNode.removeChild(searchButton);
    }

    // Remove the "Action" column header and corresponding cells
    const tableHeader = customerListContainer.querySelector('thead tr');
    if (tableHeader) {
        const actionHeader = tableHeader.querySelector('th:nth-child(5)'); // Assuming "Action" is the 5th column
        if (actionHeader) {
            actionHeader.parentNode.removeChild(actionHeader);
        }
    }

    // Remove the corresponding "Action" cells in the table body
    const tableBodyRows = customerListContainer.querySelectorAll('tbody tr');
    tableBodyRows.forEach(row => {
        const actionCell = row.querySelector('td:nth-child(5)'); // Assuming "Action" is the 5th column
        if (actionCell) {
            actionCell.parentNode.removeChild(actionCell);
        }
    });

    // Create a new hidden iframe for printing
    const printFrame = document.createElement('iframe');
    document.body.appendChild(printFrame);
    printFrame.style.display = 'none'; // Hide the iframe

    const doc = printFrame.contentWindow.document;
    doc.open();
    doc.write('<html><head><title>Print</title>');
    doc.write('<link rel="stylesheet" href="path/to/your/styles.css">'); // Link to your styles if needed
    doc.write('</head><body>');
    doc.write('<h1>Sales and Report</h1>'); // Optional header for the printout
    doc.write(billingCards);
    doc.write(customerListContainer.outerHTML); // Use modified customer list directly
    doc.write('</body></html>');
    doc.close();

    // Print the content of the iframe
    printFrame.contentWindow.focus();
    printFrame.contentWindow.print();

    // Optionally remove the iframe after printing
    printFrame.onload = function() {
        setTimeout(() => {
            document.body.removeChild(printFrame);
        }, 1000); // Delay removal to ensure print dialog is closed
    };
}




document.addEventListener("DOMContentLoaded", function() {
    // Fetch Expected Income
    fetch('/api/expected-income')
        .then(response => response.json())
        .then(data => {
            document.getElementById('expected-income').textContent = '₱' + parseFloat(data.expected_income).toFixed(2);
        });

    // Fetch Payment Received
    fetch('/api/payment-received')
        .then(response => response.json())
        .then(data => {
            document.getElementById('payment-received').textContent = '₱' + parseFloat(data.payment_received).toFixed(2);
        });

    // Fetch Installment Count
    fetch('/api/installment-count')
        .then(response => response.json())
        .then(data => {
            document.getElementById('installment-count').textContent = data.installment_count;
        });

    // Fetch Fully Paid Count
    fetch('/api/fully-paid-count')
        .then(response => response.json())
        .then(data => {
            document.getElementById('fully-paid-count').textContent = data.fully_paid_count;
        });

    // Fetch Sales Unit Count
    fetch('/api/sales-unit-count')
        .then(response => response.json())
        .then(data => {
            document.getElementById('sales-unit-count').textContent = data.sales_unit_count;
        });
});










// Search functionality
document.getElementById('searchButton').addEventListener('click', function () {
    const name = document.getElementById('searchName').value;

    fetch(`/search-customer?name=${name}`)
        .then(response => response.json())
        .then(data => {
            const resultBody = document.getElementById('resultBody');
            resultBody.innerHTML = ''; // Clear previous results

            if (data.length > 0) {
                data.forEach(customer => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${customer.name}</td>
                        <td>${customer.email}</td>
                        <td>${customer.phone_number}</td>
                        <td>
                            <button class="edit-btn" onclick="editCustomer(${customer.id})">Edit</button>
                        </td>
                    `;
                    resultBody.appendChild(row);
                });
            } else {
                resultBody.innerHTML = '<tr><td colspan="4">No customers found</td></tr>';
            }
            // Show the search results modal
            document.getElementById('resultModal').style.display = 'block';
        })
        .catch(error => console.error('Error:', error));
});

// Edit customer functionality
function editCustomer(id) {
    // Fetch customer data to pre-fill the form for editing
    fetch(`/edit-customer/${id}`)
        .then(response => response.json())
        .then(data => {
            if (!data.error) {
                document.getElementById('customerId').value = data.id;
                document.getElementById('name').value = data.name;
                document.getElementById('email').value = data.email;
                document.getElementById('phone_number').value = data.phone_number;
                document.getElementById('streetaddress').value = data.streetaddress;
                document.getElementById('date_of_birth').value = data.date_of_birth;
                document.getElementById('age').value = data.age;
                document.getElementById('facebook').value = data.facebook;
                document.getElementById('gender').value = data.gender;
                document.getElementById('telephone_number').value = data.telephone_number;

                // Show the edit customer form
                document.getElementById('editCustomerForm').style.display = 'block';
            } else {
                alert(data.error);
            }
        })
        .catch(error => console.error('Error:', error));
}

// Form submission for updating customer
document.getElementById('editCustomerForm').addEventListener('submit', function (event) {
    event.preventDefault(); // Prevent the default form submission

    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    fetch('/update-customer', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json',
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(Object.fromEntries(new FormData(this))) // Convert FormData to JSON
    })
    .then(response => response.json())
    .then(data => {
        const statusMessage = document.getElementById('statusMessage');
        if (data.success) {
            statusMessage.innerText = data.success;
            statusMessage.style.color = 'green';
            // Optionally, close the form or reset it
            document.getElementById('editCustomerForm').reset(); // Clear the form
            document.getElementById('editCustomerForm').style.display = 'none'; // Hide the form
        } else {
            // Handle validation errors
            if (data.errors) {
                const errorMessages = Object.values(data.errors).flat().join(', ');
                statusMessage.innerText = errorMessages; // Display validation errors
            } else {
                statusMessage.innerText = data.error;
            }
            statusMessage.style.color = 'red';
        }
    });
});


// Close modals functionality
document.getElementById('closeModal').addEventListener('click', function () {
    document.getElementById('resultModal').style.display = 'none';
});

// Close modal when clicking outside of the modal
window.addEventListener('click', function (event) {
    const resultModal = document.getElementById('resultModal');
    
    if (event.target === resultModal) {
        resultModal.style.display = 'none';
    }
});







  // Function to fetch and display customers in the table
function loadCustomers() {
    // Fetch data from your existing Laravel API endpoint
    fetch('/api/customers')
        .then(response => response.json())
        .then(data => {
            const tableBody = document.getElementById('customerTable').querySelector('tbody');
            tableBody.innerHTML = ''; // Clear existing rows

            // Loop through the fetched customer data and create table rows
            data.forEach(customer => {
                const row = document.createElement('tr');
                
                // Name column
                const nameCell = document.createElement('td');
                nameCell.textContent = customer.name;
                row.appendChild(nameCell);

                // Balance column (fetching from your 'remaining_balance' field)
                const balanceCell = document.createElement('td');
                balanceCell.textContent = customer.remaining_balance || 'N/A';
                row.appendChild(balanceCell);

                // Payment Service column (displaying installment or fully paid status)
                const paymentServiceCell = document.createElement('td');
                if (customer.installment) {
                    paymentServiceCell.textContent = 'Installment';
                } else if (customer.fullypaid) {
                    paymentServiceCell.textContent = 'Fully Paid';
                } else {
                    paymentServiceCell.textContent = '-';
                }
                row.appendChild(paymentServiceCell);

                // Action column
                const actionCell = document.createElement('td');

                // Notify button
                const notifyButton = document.createElement('button');
                notifyButton.textContent = 'Notify';
                notifyButton.onclick = () => openModal(customer.id, customer.name);
                actionCell.appendChild(notifyButton);

                row.appendChild(actionCell);
                tableBody.appendChild(row);
            });
        })
        .catch(error => console.error('Error fetching customers:', error));
}



// Open modal and clear feedback
function openModal(id, name) {
    document.getElementById('recipientId').value = id;
    document.getElementById('modalTitle').textContent = `Notify ${name}`;
    document.getElementById('notifyModal').style.display = 'block';
    
    // Clear the feedback message when the modal is opened
    document.getElementById('modalFeedback').textContent = '';
    document.getElementById('modalFeedback').style.color = ''; // Reset color
}



// Close modal and clear fields
function closeModal() {
    document.getElementById('notifyModal').style.display = 'none';
    document.getElementById('messageBox').value = '';
    document.getElementById('recipientId').value = '';

    // Clear the feedback message when the modal is closed
    document.getElementById('modalFeedback').textContent = '';
}

// Send message to the recipient
function sendMessage() {
    const recipientId = document.getElementById('recipientId').value;
    const message = document.getElementById('messageBox').value;

    if (!recipientId || !message) {
        console.error('Recipient ID or message is missing.');
        return;
    }

    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    fetch('/send-message', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
        },
        body: JSON.stringify({
            recipientId: recipientId,
            message: message,
        }),
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok ' + response.statusText);
        }
        return response.json();
    })
    .then(data => {
        const feedbackElement = document.getElementById('modalFeedback');

        if (data.success) {
            feedbackElement.textContent = 'Message sent successfully!';
            feedbackElement.style.color = 'green';
        } else {
            feedbackElement.textContent = 'Error: ' + data.message;
            feedbackElement.style.color = 'red';
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

// Load customers when the page loads
window.onload = loadCustomers;


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
        
<script src="{{ asset('js/admin/addashboard.js') }}"></script>
<script src="{{ asset('js/admin/toppsidenav.js') }}"></script>  
</body>
</html>
