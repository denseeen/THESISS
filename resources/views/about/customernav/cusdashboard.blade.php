<!DOCTYPE html>
<html lang="en">
    <head>
        <link href="{!! url('css/customer/cusdashboard.css') !!}" rel="stylesheet">
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
                            <span class="bell-icon">&#128276;</span>
                            <!-- Notification Count -->
                            <span class="notification-count">3</span>

                            <!-- Dropdown Menu -->
                            <div class="dropdown-notification">
                                <!-- Recent Notifications -->
                                <div class="box shadow-sm rounded bg-white mb-3">
                                    <div class="box-title border-bottom p-3">
                                        <h6 class="m-0" style="color:black;">Recent</h6>
                                    </div>
                                    <div class="box-body p-0">
                                    
                                        <div class="notification-item">
                                            <div class="notification-content">
                                              
                                                <div class="notification-sender" style="color:red; margin-bottom:2%;">{{ Auth::user()->name }}</div>
                                                <div class="notification-message">Income tax sops on the cards, The bias in VC funding, and other top news for you</div>
                                            </div>
                                            <span class="delete-icon">&#10060;</span>
                                        </div>
                                        <div class="notification-item">
                                            <div class="notification-content">
                                            <div class="notification-sender" style="color:red; margin-bottom:2%;">{{ Auth::user()->name }}</div>
                                                <div class="notification-message">Vivamus imperdiet venenatis est...</div>
                                            </div>
                                            <span class="delete-icon">&#10060;</span>
                                        </div>
                                    </div>
                                </div>
                                <!-- Earlier Notifications -->
                                <div class="box shadow-sm rounded bg-white mb-3">
                                    <div class="box-title border-bottom p-3">
                                        <h6 class="m-0" style="color:black;">Earlier</h6>
                                    </div>
                                    <div class="box-body p-0">
                                        <div class="notification-item">
                                            <div class="notification-content">
                                            <div class="notification-sender" style="color:red; margin-bottom:2%;">{{ Auth::user()->name }}</div>
                                                <div class="notification-message">Nunc purus metus, aliquam vitae venenatis sit amet, porta non est.</div>
                                            </div>
                                            <span class="delete-icon">&#10060;</span>
                                        </div>
                                        <div class="notification-item">
                                            <div class="notification-content">
                                            <div class="notification-sender" style="color:red; margin-bottom:2%;">{{ Auth::user()->name }}</div>
                                                <div class="notification-message">Pellentesque semper ex diam, at tristique ipsum varius sed. Pellentesque non metus ullamcorper</div>
                                            </div>
                                            <span class="delete-icon">&#10060;</span>
                                        </div>
                                        <div class="notification-item">
                                            <div class="notification-content">
                                            <div class="notification-sender" style="color:red; margin-bottom:2%;">{{ Auth::user()->name }}</div>
                                                <div class="notification-message">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque ipsum elit.</div>
                                            </div>
                                            <span class="delete-icon">&#10060;</span>
                                        </div>
                                    </div>
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
                        <a href="{{ route('cuspurchasehistory.show') }}">Order history</a>
                        <a href="#">Security</a>
                        <a href="{{ route('about.layout') }}">Logout</a>
                    </div>
                </div>
            </div>
        </nav>


    <!-- Content -->

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
            <div class="card">
                <div class="card-header">Billing History</div>
                <div class="card-body p-0">
                    <!-- Billing history table -->
                    <div class="table-responsive table-billing-history">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Transaction ID</th>
                                    <th>Date</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Payment Method</th>
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



</script>






<script src="{{ asset('js/customer/cusdashboard.js') }}"></script>
</body>

</html>