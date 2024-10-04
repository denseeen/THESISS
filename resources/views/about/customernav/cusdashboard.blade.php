<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="{{ asset('responsiv/customer/rescusdashboard.css') }}" rel="stylesheet">
        <link href="{{ url('responsiv/customer/restopnav.css') }}" rel="stylesheet">

        <link href="{!! url('css/customer/cusdashboard.css') !!}" rel="stylesheet">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="{{ url('css/customer/topnav.css') }}" rel="stylesheet">
        <title>Customer dashboard</title>
    </head>

    <body>

        <!-- Top Navbar -->
        <nav class="top_navbar">
            <a href="{{ route('cusdasboard.show') }}">
                <img src="/image/logoBillnWow3.png" class="TopNav-BillnWoWlogo" alt="BillnWoWLogo" style="margin-top:-1.3%">
            </a>
            <div class="icons">
            <ul class="navigation-menu">
                <li><a href="{{ route('cusdasboard.show') }}">Anonas Branch</a></li>
                    <li>       
                    <div class="notification-container">
    <!-- Bell Icon -->
    <span class="bell-icon" id="bellIcon">&#128276;</span>

    <!-- Notification Count -->
    <span class="notification-count" style="display: none;">0</span>

    <!-- Dropdown Menu -->
    <div class="dropdown-notification" id="dropdownNotification">
        <div class="box shadow-sm rounded bg-white mb-3">
            <div class="box-title border-bottom p-3">
                <h6 class="m-0" style="color:black;">Notification</h6>
            </div>
            <div class="box-body p-0"></div>
        </div>
    </div>
</div>


                    </li>
                </ul>

               
                <!-- Dark Mode -->
                <div class="icon sun-icon" onclick="toggleDarkModeDashboard()">
                    <img src="/image/7721593.png" alt="Sun Icon">
                </div>
                  <!-- user -->
                <div class="icon profile-icon img" onclick="toggleDropdown()">   
                    <img src="/image/4174470.png" alt="Profile Icon">
                    <!-- <span class="profile-text">Account Profile</span> -->

                    <!-- user Dropdown -->
                    <div class="dropdown-menu" id="dropdownMenu">
                        <a href="{{ route('cusprofile.show') }}">Profile</a>
                        <!-- <a href="{{ route('cuspurchasehistory.show') }}">Order history</a> -->
                        <a href="{{ route('cussecurity.show') }}">Security</a>
                        <a href="{{ route('about.layout') }}">Logout</a>
                    </div>
                </div>
            </div>
        </nav>

        
        <div class ="viewtitle">
        <h1>Dashboard</h1>
        </div>

    <!-- Content -->

            <div class="button-container">
                <button id="contractBtn" class="button">Contract</button>
                <button id="rulesBtn" class="button">Rules & Regulations</button>
            </div>

            <!-- Error Message -->
    <div id="error-message" style="display: none; color: red; text-align: center; margin-top: 20px;">
        An error occurred while fetching notifications. Please try again later.
    </div>

            <!-- Contract Modal -->
            <div id="contractModal" class="modal">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <p>This is your contract content!</p>
                </div>
            </div>

            <!-- Rules & Regulations Modal -->
            <div id="rulesModal" class="modal">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <p>These are the rules and regulations!</p>
                </div>
            </div>

    <div class="container">
    
            <div class="row">
                <div class="col">
                    <!-- Billing card 1 -->
                    <div class="card border-start-primary">
                        <div class="card-body">
                            <div class="small text-muted">Current monthly bill</div>
                            <div class="h3" id="current-monthly-bill">$20.00</div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <!-- Billing card 2 -->
                    <div class="card border-start-secondary">
                        <div class="card-body">
                            <div class="small text-muted">Next payment due</div>
                            <div class="h3" id="next-payment-due">September 15</div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <!-- Billing card 3 -->
                    <div class="card border-start-success">
                        <div class="card-body">
                            <div class="small text-muted">Balance</div>
                            <div class="d-flex align-items-center">
                                <div id="balance">
                                    <div class="h3">Pesos: 5000</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Billing history -->
            <!--  -->
            <div class="card" style="margin-top: 5%";> 
                <div class="card-header">Billing History</div>
                <div class="card-body p-0">
                    <!-- Billing history table -->
                    <div class="table-responsive table-billing-history">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>transaction #</th>
                                    <th>Date</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <!-- <th>Payment Method</th> -->
                                </tr>
                            </thead>
                            <tbody id="billing-history-body">
                                <!-- Data will be injected here by JavaScript -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        fetch('/billing-data')
            .then(response => response.json())
            .then(data => {
                // Update billing cards
                document.getElementById('current-monthly-bill').textContent = data.currentMonthlyBill;
                document.getElementById('next-payment-due').textContent = data.nextPaymentDue;
                document.getElementById('balance').innerHTML = `<div class="h3">${data.balance}</div>`;
                
                // Update billing history table
                const tbody = document.getElementById('billing-history-body');
                tbody.innerHTML = ''; // Clear any existing data

                data.history.forEach(item => {
                    const tr = document.createElement('tr');
                    tr.innerHTML = `
                        <td>${item.id}</td>
                        <td>${item.date}</td>
                        <td>${item.amount}</td>
                        <td><span class="badge ${item.status === 'Paid' ? 'bg-success' : 'bg-light text-dark'}">${item.status}</span></td>
                        <td>${item.method}</td>
                    `;
                    tbody.appendChild(tr);
                });
            })
            .catch(error => console.error('Error fetching billing data:', error));


            
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


        // Get the modal elements
        var contractModal = document.getElementById("contractModal");
        var rulesModal = document.getElementById("rulesModal");

        // Get the button elements
        var contractBtn = document.getElementById("contractBtn");
        var rulesBtn = document.getElementById("rulesBtn");

        // Get the <span> elements that close the modals
        var closeButtons = document.getElementsByClassName("close");

        // Open the contract modal when the contract button is clicked
        contractBtn.onclick = function() {
            contractModal.style.display = "block";
        }

        // Open the rules modal when the rules button is clicked
        rulesBtn.onclick = function() {
            rulesModal.style.display = "block";
        }

        // Close the modals when the close buttons are clicked
        for (let i = 0; i < closeButtons.length; i++) {
            closeButtons[i].onclick = function() {
                contractModal.style.display = "none";
                rulesModal.style.display = "none";
            }
        }

        // Close the modal when clicking outside of it
        window.onclick = function(event) {
            if (event.target == contractModal) {
                contractModal.style.display = "none";
            }
            if (event.target == rulesModal) {
                rulesModal.style.display = "none";
            }
        }


</script>






<script src="{{ asset('js/customer/cusdashboard.js') }}"></script>
<script src="{{ asset('js/customer/topnav.js') }}"></script>
<script src="{{ asset('js/darkmode.js') }}"></script>
</body>

</html>