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
        
        <div class ="viewtitle">
        <h1>Dashboard</h1>
        </div>
    
        <!-- Content -->
            <div class="row">
                <div class="col">
                    <!-- Billing card 1 -->
                    <div class="card border-start-primary">
                        <div class="card-body">
                            <div class="small text-muted">Expected Income</div>
                            <div class="h3" id="current-monthly-bill">$00.00</div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <!-- Billing card 2 -->
                    <div class="card border-start-secondary">
                        <div class="card-body">
                            <div class="small text-muted">Payment Received</div>
                            <div class="h3" id="next-payment-due"></div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <!-- Billing card 3 -->
                    <div class="card border-start-third">
                        <div class="card-body">
                            <div class="small text-muted">No. of Installment Customer</div>
                            <div class="d-flex align-items-center">
                                <div id="balance">
                                    <div class="h3"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <!-- Billing card 4 -->
                    <div class="card border-start-forth">
                        <div class="card-body">
                            <div class="small text-muted">No. of Fully Paid</div>
                            <div class="d-flex align-items-center">
                                <div id="balance">
                                    <div class="h3"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <!-- Billing card 5 -->
                    <div class="card border-start-fifth">
                        <div class="card-body">
                            <div class="small text-muted">No. of Sales Unit</div>
                            <div class="d-flex align-items-center">
                                <div id="balance">
                                    <div class="h3"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    <!-- Customer List -->
<div class="application-list">
    <h2>Customer List</h2>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Balance</th>
                <th>Status</th>
                <th>Payment Service</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            <!-- Rows will be dynamically generated here by JavaScript -->
        </tbody>

            <tbody>
                @foreach ($customer as $customers)

                        <tr>

                    <tr>
                        <td>{{ $customers->name }}</td>
                        <td></td>
                        <td></td>
                        <td>

                            @php
                                // Fetch the payment details for the current customer
                                $customerPayment = $customerpm->firstWhere('id', $customers->id);
                            @endphp
                            @if ($customerPayment && $customerPayment->installment)
                                Installment
                            @elseif ($customerPayment && $customerPayment->fullypaid)
                                Fully Paid
                            @else
                                -
                            @endif

                    

                        </td>
                        <td><button onclick="openModal('{{ $customers->id }}', '{{ $customers->name }}')">Notify</button></td>
                    </tr>
                @endforeach
            </tbody>

    </table>
</div>


       <!-- Modal Structure -->
<div id="notifyModal" class="modal" style="display:none;">

    <div class="modal-content">
        <div class="modal-header">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2 id="modalTitle">Notify User</h2>
        </div>
        <div class="modal-body">
            <input type="hidden" id="recipientId" />
            <textarea class="textfield"id="messageBox" rows="4" style="width: 100%;" placeholder="Type your message here..."></textarea>
            <div id="modalFeedback" style="margin-top: 10px; color: green;"></div> <!-- Feedback Message -->
        </div>
        <div class="modal-footer">
       
            <button onclick="sendMessage()">Send</button>
          
        </div>
    </div>
</div>




<script>

document.addEventListener("DOMContentLoaded", function() {
    fetchCustomerData();
});

function fetchCustomerData() {
    fetch('/api/customers')
        .then(response => response.json())
        .then(data => {
            const tbody = document.querySelector('.application-list tbody');
            tbody.innerHTML = '';

            data.forEach(customer => {
                const tr = document.createElement('tr');
                
                const nameTd = document.createElement('td');
                nameTd.textContent = customer.name;

                const balanceTd = document.createElement('td');
                balanceTd.textContent = '-'; // Placeholder for balance

                const statusTd = document.createElement('td');
                statusTd.textContent = '-'; // Placeholder for status

                const paymentServiceTd = document.createElement('td');
                if (customer.installment) {
                    paymentServiceTd.textContent = 'Installment';
                } else if (customer.fullypaid) {
                    paymentServiceTd.textContent = 'Fully Paid';
                } else {
                    paymentServiceTd.textContent = '-';
                }

                const actionTd = document.createElement('td');
                const notifyButton = document.createElement('button');
                notifyButton.textContent = 'Notify';
                notifyButton.addEventListener('click', function() {
                    openModal(customer.id, customer.name);
                });
                actionTd.appendChild(notifyButton);

                tr.appendChild(nameTd);
                tr.appendChild(balanceTd);
                tr.appendChild(statusTd);
                tr.appendChild(paymentServiceTd);
                tr.appendChild(actionTd);

                tbody.appendChild(tr);
            });
        })
        .catch(error => {
            console.error('Error fetching customer data:', error);
        });
}





    //message
    function openModal(id, name) {
            document.getElementById('recipientId').value = id;
            document.getElementById('modalTitle').textContent = `Notify ${name}`;
            document.getElementById('notifyModal').style.display = 'block';

                    
            // Clear the feedback message when the modal is opened
            document.getElementById('modalFeedback').textContent = '';
        }

        function closeModal() {
            document.getElementById('notifyModal').style.display = 'none';
            document.getElementById('messageBox').value = '';
            document.getElementById('recipientId').value = '';

            // Optionally clear the feedback message when the modal is closed
            document.getElementById('modalFeedback').textContent = '';
        }

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
                feedbackElement.style.color = 'green'; // Optional: Set color for success
            } else {
                 feedbackElement.textContent = 'Error: ' + data.message;
                feedbackElement.style.color = 'red'; // Optional: Set color for error
            }
        })
        .catch(error => {
        console.error('Error:', error);
        });
    }

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
