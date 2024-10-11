<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link href="{{ url('css/admin/topnav_sidenav.css') }}" rel="stylesheet">
        <title>Editing_page</title>

        <style>
    body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 20px;
}

#searchName{
    width: 13%;
}

/* Modal Styles */
.modal {
    display: flex;
    justify-content: center;
    align-items: center;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgb(0, 0, 0);
    background-color: rgba(0, 0, 0, 0.4);
}

.modal-content {
    background-color: #fefefe;
    margin: 15% auto;
    padding: 20px;
    border: 1px solid #888;
    border-radius: 5px; /* Added border-radius for rounded corners */
    width: 80%;
}

/* Close Button */
.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}

/* Table Styles */
.table {
    width: 100%;
    border-collapse: collapse; /* Removes space between borders */
}

.table th, .table td {
    padding: 10px; /* Added padding for better spacing */
    text-align: left;
    border-bottom: 1px solid #ddd; /* Adds a bottom border to rows */
}

.table th {
    background-color: #f2f2f2; /* Light gray background for table headers */
    font-weight: bold; /* Bold font for header text */
}

/* Input and Button Styles */
.form-group {
    margin-bottom: 15px; /* Space between input groups */
}

.form-control {
    width: 100%; /* Full width input */
    padding: 10px; /* Padding for input */
    border: 1px solid #ccc; /* Light gray border */
    border-radius: 4px; /* Rounded corners for inputs */
    box-sizing: border-box; /* Include padding and border in element's total width and height */
}

.form-control:focus {
    border-color: #4A90E2; /* Border color on focus */
    outline: none; /* Remove default outline */
    box-shadow: 0 0 5px rgba(74, 144, 226, 0.5); /* Add subtle shadow on focus */
}

.btn {
    padding: 10px 15px; /* Padding for buttons */
    background-color: #4A90E2; /* Primary button color */
    color: white; /* Text color for buttons */
    border: none; /* Remove border */
    border-radius: 4px; /* Rounded corners for buttons */
    cursor: pointer; /* Pointer cursor on hover */
    transition: background-color 0.3s; /* Smooth transition for hover effect */
}

.btn:hover {
    background-color: #357ABD; /* Darker shade on hover */
}

/* Status Message Styles */
#statusMessage {
    font-weight: bold; /* Bold text for status messages */
    margin-top: 10px; /* Space above status message */
}

input[type="text"], input[type="email"], input[type="url"], input[type="date"], input[type="number"], select {
    width: calc(100% - 22px); /* Ensure input fields take full width with padding */
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    margin-top: 5px; /* Add spacing above input fields */
}




.modal {
    display: none; /* Hidden by default */
    position: fixed; 
    z-index: 1; 
    left: 0;
    top: 0;
    width: 100%; 
    height: 100%; 
    overflow: auto; 
    background-color: rgb(0,0,0); 
    background-color: rgba(0,0,0,0.4); 
    padding-top: 60px; 
}

.modal-content {
    background-color: #fefefe;
    margin: 5% auto; 
    padding: 20px;
    border: 1px solid #888;
    width: 80%; 
}

.close-button {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close-button:hover,
.close-button:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}

</style>
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
<br><br>
<br><br>

<div class="container">
    <h2>Edit Customer Information</h2>

  <!-- Search Bar -->
<div class="search-bar mb-3">
    <input type="text" id="searchName" placeholder="Search by name..." />
    <button id="searchButton">Search</button>
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
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="phone_number">Phone Number:</label>
                    <input type="text" id="phone_number" name="phone_number" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="streetaddress">Street Address:</label>
                    <input type="text" id="streetaddress" name="streetaddress" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="date_of_birth">Date of Birth:</label>
                    <input type="date" id="date_of_birth" name="date_of_birth" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="age">Age:</label>
                    <input type="number" id="age" name="age" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="facebook">Facebook:</label>
                    <input id="facebook" name="facebook" class="form-control">
                </div>

                <div class="form-group">
                    <label for="gender">Gender:</label>
                    <select id="gender" name="gender" class="form-control">
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="other">Other</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="telephone_number">Telephone Number:</label>
                    <input type="text" id="telephone_number" name="telephone_number" class="form-control">
                </div>

                <button type="submit" class="btn btn-primary">Update Customer</button>
                <div id="statusMessage" style="margin-top: 10px;"></div>
            </form>
        </div>
    </div>
</div>






<div class="container">
    <h1>Search Customer</h1>
    <form id="searchCustomerForm">
        <label for="customerName">Customer Name:</label>
        <input type="text" id="customerName" required>
        <button type="submit">Search</button>
        <div id="searchStatusMessage" class="status-message"></div>
    </form>

    <!-- Modal Structure -->
    <div id="searchResultsModal" class="modal">
        <div class="modal-content">
            <span class="close-button">&times;</span>
            <h2>Search Results</h2>
            <div id="searchResults"></div>
        </div>
    </div>
</div>




<script>
// Search customer and display installment processes
document.getElementById('searchCustomerForm').addEventListener('submit', function(event) {
    event.preventDefault();

    const name = document.getElementById('customerName').value;
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

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
        const resultsDiv = document.getElementById('searchResults');
        resultsDiv.innerHTML = ''; // Clear previous results

        if (data.length === 0) {
            resultsDiv.innerHTML = '<p>No customers found.</p>';
            showModal(); // Show modal even if no results found
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

            // Fetch the customer's installment processes
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
                const installmentsDiv = document.getElementById(`installments-${customer.id}`);
                installments.forEach(installment => {
                    installmentsDiv.innerHTML += `
                        <div class="installment">
                            <p>Payment Method: ${installment.payment_method}</p>
                            <p>Amount: ${installment.amount}</p>
                            <p>Date: ${installment.date}</p>
                            <p>Status: ${installment.status}</p>
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

// Function to show modal
function showModal() {
    const modal = document.getElementById("searchResultsModal");
    modal.style.display = "block";
}

// Function to hide modal
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

        fetch(`/update-installment/${installmentId}`, {
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
            // Populate a form with the installment data
            const formHTML = `
                <form class="updateInstallmentForm" data-installment-id="${installment.id}">
                    <label for="payment_method">Payment Method:</label>
                    <input type="text" name="payment_method" value="${installment.payment_method}" required>

                    <label for="amount">Amount:</label>
                    <input type="number" name="amount" value="${installment.amount}" required>

                    <label for="date">Date:</label>
                    <input type="date" name="date" value="${installment.date}" required>

                    <label for="status">Status:</label>
                    <input type="text" name="status" value="${installment.status}" required>

                    <label for="violation">Violation:</label>
                    <input type="text" name="violation" value="${installment.violation || ''}" required>

                    <label for="comment">Comment:</label>
                    <input type="text" name="comment" value="${installment.comment || ''}" required>

                    <button type="submit">Update Installment Process</button>
                    <div class="status-message"></div>
                </form>
            `;

            // Insert the form into the clicked installment
            const installmentDiv = event.target.closest('.installment');
            installmentDiv.innerHTML = formHTML + installmentDiv.innerHTML;
        })
        .catch(error => {
            console.error('Error fetching installment:', error);
        });
    }
});

// Handle installment update form submission
document.getElementById('searchResults').addEventListener('submit', function(event) {
    if (event.target.classList.contains('updateInstallmentForm')) {
        event.preventDefault();
        const form = event.target;
        const installmentId = form.dataset.installmentId;
        const formData = new FormData(form);
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

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
            const statusMessage = form.querySelector('.status-message');
            statusMessage.innerText = data.success || 'Installment updated successfully!';
            statusMessage.className = 'status-message status-success';
        })
        .catch(error => {
            console.error('Error updating installment:', error);
            const statusMessage = form.querySelector('.status-message');
            statusMessage.innerText = 'An error occurred: ' + error.message;
            statusMessage.className = 'status-message status-error';
        });
    }
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
<script src="{{ asset('js/admin/toppsidenav.js') }}"></script>    
</body>

</html>

