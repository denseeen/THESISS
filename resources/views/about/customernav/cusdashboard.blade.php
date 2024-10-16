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
   

    <div class= "design">

        <!-- Top Navbar -->
        <nav class="top_navbar">
                <a href="{{ route('cusdasboard.show') }}">
                    <img src="/image/logoBillnWow3.png" class="TopNav-BillnWoWlogo" alt="BillnWoWLogo" style="margin-top:-1.3%">
                    <!-- <a class= "des" style="margin-left: -58%;
    font-variant: unicase;">Billn'WOW</a> -->
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
        <!-- <img src="/image/dashbboard_bg.jpg" alt="bg-dashboard" class="bg-image"> -->
            <h1>Dashboard</h1>
        </div>

        <!-- Content -->
        <div class="Unitname_Unitprice">
            <div class="button-container">
            <button id="contractBtn" class="button">Contract</button>
            <button id="rulesBtn" class="button">REFUND/CHANGING TERMS POLICY</button>
            </div>

            <div class="nameprice" style="display: flex; justify-content: space-around;">
    <div class="accountnumber-section" style="text-align: center;">
        <h2 class="accountnumber-label">Account Number:</h2>
        <a id="accountnumber" style="font-size: 181%; color:black;">[Account Number Here]</a> <!-- account number from installment_process -->
    </div>
    <div class="unitname-section" style="text-align: center;">
        <h2 class="unitname-label">Unit Names:</h2> 
        <div id="unitname">[Unit Names Here]</div> <!-- Unit names will be updated here -->
    </div>
    <div class="unitprice-section" style="text-align: center;">
        <h2 class="unitprice-label">Prices:</h2>
        <div id="unitprice">₱0.00</div> <!-- Unit prices will be updated here -->
    </div>
</div>

        </div>




            

           <!-- Contract Modal -->
           <div id="contractModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h3>CONTRACT/AGREEMENT</h3>
        <p style="text-align: justify;">
            KNOW ALL MEN BY THESE PRESENTS:
            <br><br>
            This [type of contract/agreement], made and entered into this ____ day of [Month], [Year] in __________, Philippines, by and between:
            <br><br>
            [Name of Corporation], a corporation duly organized and existing under Philippine law with office address at _____________________ hereinafter referred to as
            <br><br>
            the [indicate a label for the First Party for easy identification, example “VENDOR”], represented by its [Representative’s Position], [Representative’s Name];
            <br><br>
            - AND -
            <br><br>
            (NAME), Filipino and with residence and postal address at (Address), hereinafter referred to as the LESSEE / married to (Name of spouse if any), Filipino,
            <br><br>
            and with residence and postal address at (Address), hereinafter referred to as the LESSOR.
            <br><br>
            WITNESSETH:
            <br><br>
            WHEREAS, [the WHEREAS clauses contain the object and consideration/s of the contract/agreement]
            <br><br>
            NOW THEREFORE, [the THEREFORE clause contains the consent of both parties]
            <br><br>
            <strong>TERMS AND CONDITIONS:</strong> [of the contract/agreement]
            <br><br>
            IN WITNESS WHEREOF, the parties herein affixed their signatures on the date and place above written.
            <br><br>
            [Name of Corporate Representative]
            <br><br>
            _________________________ 
            <br><br>
            [Name of Second Party]
            <br><br>
            _________________________
            <br><br>
            [Name of Corporation] 
            _____________________________
            <br><br>
            Signed in the presence of:
            <br><br>
            _____________________________
        </p>
    </div>
</div>


            <!-- Rules & Regulations Modal -->
<div id="rulesModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h3>REFUND/CHANGING TERMS POLICY FOR NEW UNITS</h3>
        <p style="text-align: justify;">
            Your e-bike is a big investment. Our priority is to ensure that you are truly interested in an electric bike and have selected the correct one before we deliver it to you. As returning is not easy, we stand behind everything we sell.
            <br><br>
            <strong>Ø RETURNS ARE ACCEPTABLE ON THESE CONDITIONS:</strong>
            <br><br>
            <strong>A. EXCHANGE UNIT AND REFUND POLICY</strong>
            <br><br>
            1. The exchange item must be returned within 7 days, including the day it was purchased.
            <br>
            2. Items must be presented with ORIGINAL RECEIPTS OR SALES INVOICES.
            <br>
            3. Items must be of EQUAL VALUE to be exchanged. The customer must pay the difference of the exceeding value of returned item/s.
            <br>
            4. Freebies such as battery and charger are not included in the returned parts once the definite items are in good condition and compatible with the exchanged unit.
            <br>
            5. Management will refund 100% or replace the e-bike within thirty (30) days, including the date of purchase, if it is found to be defective in its major parts as stated below:
            <br>
            &nbsp;&nbsp;&nbsp;&nbsp;• CHASSIS<br>
            &nbsp;&nbsp;&nbsp;&nbsp;• DYNAMO<br>
            &nbsp;&nbsp;&nbsp;&nbsp;• CONTROLLER<br>
            &nbsp;&nbsp;&nbsp;&nbsp;• BATTERY<br>
            6. For installment purchases, the due date of your payment will follow the date you purchased the first unit.
            <br><br>
            <strong>B. RETURNS ARE NOT ACCEPTABLE ON THESE CONDITIONS:</strong>
            <br><br>
            1. Change of mind (Under RA 7394).
            <br>
            2. Sales transaction was over 7 days / 30 days.
            <br>
            3. No RECEIPTS OR SALES INVOICES.
            <br>
            4. Damages due to WRONG usage or application, caused by negligence, mishandling, acts of nature, and in-transport relocation.
            <br><br>
            <strong>Ø CHANGING TERMS</strong>
            <br>
            • Good as cash or units that can be availed in 3-month terms. The 100 pesos rebate is not included.
            <br>
            • For installment customers who decide to pay in cash, they can avail the cash fix discount within seven (7) days, including the day the unit was purchased.
            <br>
            • For installment customers who decide to pay in cash, they can avail half of the cash fix discount within 8-30 days, including the day the unit was purchased.
            <br><br>
            I hereby state that I fully understand the preceding guidelines and hereby declare that I will strictly observe its provisions stated above. I signed to prove my willingness to adhere to it of my free will without pressure from anybody.
            <br><br>
            <em>“The Company reserves the right for the final explanation.”</em>
        </p>
    </div>
</div>


            <div class="container">
    
                <div class="row">
                    <div class="col">
                        <!-- Billing card 1 -->
                        <div class="card border-start-primary">
                            <div class="card-body">
                                <div class="small text-muted">Current Monthly Bill</div>
                                <div class="h3" id="current-monthly-bill">₱0.00</div> <!-- This will display the amount -->
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <!-- Billing card 2 -->
                        <div class="card border-start-secondary">
                            <div class="card-body">
                                <div class="small text-muted">Current Payment Due</div>
                                <div class="h3" id="next-payment-due">N/A</div> <!-- This will display the date -->
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
                                        <div class="h3">Pesos: 0.00</div> <!-- This will display the balance -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- payment Schedule -->
                <div class="card">
                    <div class="card-header">Monthly Due</div>

                    <!-- Loading Indicator -->
                    <div id="loading" style="display: none;">Loading...</div>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Amount</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody id="payment-schedule-table-body">
                            <!-- Dynamic rows will be inserted here by JavaScript -->
                        </tbody>
                    </table>
                </div>


                <!-- Billing history -->
                <div class="card" style="margin-top: 5%;"> 
                    <div class="card-header">Billing History</div>
                    <div class="card-body p-0">
                        <!-- Billing history table -->
                        <div class="table-responsive table-billing-history">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Account#</th>
                                        <th>Date</th>
                                        <th>Amount</th>
                                        <th>Payment Method</th>
                                        <th>Penalty</th>
                                        <th>Comment</th>
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
    </div>





    


<!-- Modal for Unit Pull-out Reminder -->
<div class="modal" id="pulloutReminderModal" style=" transition: opacity 0.3s ease; opacity: 0; position: fixed;  ; top: 0; width: 100%; height: 100vh; background-color: rgba(0, 0, 0, 0.5); display: flex; justify-content: center; align-items: center;">
    <div class="modal-content" style="width: 30%;  background-color: white;  box-shadow: 0 5px 15px rgba(0,0,0,0.3);">
        <div class="modal-header">
            <h5 class="modal-title" style="color: red;">Important Reminder</h5>
        </div>
        <div class="modal-body">
            Reminder: The unit will be pulled out if payment is not made within 15 days of the due date.
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" style="float: right;" onclick="closeModal()">Close</button>
        </div>
    </div>
</div>


<script>

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

// Close the contract modal
closeButtons[0].onclick = function() {
    contractModal.style.display = "none";
}

// Close the rules modal
closeButtons[1].onclick = function() {
    rulesModal.style.display = "none";
}

// Close the modals when clicking outside of them
window.onclick = function(event) {
    if (event.target == contractModal) {
        contractModal.style.display = "none";
    }
    if (event.target == rulesModal) {
        rulesModal.style.display = "none";
    }
}





document.addEventListener('DOMContentLoaded', function() {
    // Fetch billing information
    function fetchBillingInfo() {
        fetch("{{ url('/payment-schedule/customer') }}")
            .then(response => response.json())
            .then(data => {
                console.log('Fetched Data:', data); // Log fetched data

                if (data.error) {
                    console.error('Error fetching billing info:', data.error);
                    // Display an error message to the user
                    alert("Failed to fetch billing information. Please try again later.");
                    return; // Stop execution if there's an error
                }

                // Removed populatePaymentSchedule(data.payment_schedule);
                checkForOverduePayments(data.payment_schedule, data.nextPaymentDue);
            })
            .catch(error => {
                console.error('Error fetching billing info:', error);
                alert("An unexpected error occurred. Please refresh the page.");
            });
    }

    function checkForOverduePayments(paymentSchedule, nextPaymentDue) {
        if (!nextPaymentDue) {
            console.warn('No next payment due date provided.');
            return; // Early return if no due date is available
        }

        const currentDate = new Date(); // Get the current date
        const currentDatePhilippines = new Date(currentDate.toLocaleString('en-US', { timeZone: 'Asia/Manila' })); // Convert to Philippine timezone
        console.log('Current Date (Philippines):', currentDatePhilippines); // Log the current date

        // Convert nextPaymentDue to a Date object
        const dueDate = new Date(nextPaymentDue);
        console.log('Parsed Due Date:', dueDate);

        const timeDifference = currentDatePhilippines - dueDate;
        const daysDifference = timeDifference / (1000 * 3600 * 24); // Convert milliseconds to days

        console.log('Next Payment Due:', nextPaymentDue);
        console.log('Days Difference:', daysDifference);

        // Check if the status of the most recent payment is 'not paid'
        const isPaymentNotPaid = paymentSchedule.some(schedule => {
            console.log('Checking schedule:', schedule); // Log each payment schedule
            return schedule.date === nextPaymentDue && schedule.status === 'not paid';
        });

        console.log('Is Payment Not Paid:', isPaymentNotPaid); // Log the result of payment check

        // Show the pullout reminder modal if the conditions are met
        if (isPaymentNotPaid && daysDifference > 14) {
    console.log('Conditions met. Showing the modal now.');
    showModal();
}

    }

    // Show modal with a smooth transition
    function showModal() {
    const reminderModal = document.getElementById('pulloutReminderModal');
    
    if (!reminderModal) {
        console.error('Modal element not found');
        return;
    }
    
    reminderModal.style.display = 'flex'; // Ensure it's visible
    setTimeout(() => {
        reminderModal.style.opacity = '1'; // Smoothly transition to visible
    }, 10); // Delay to trigger the CSS transition

    console.log('Modal is now showing');
}


    // Close modal with a smooth transition
   window.closeModal = function() {
    const reminderModal = document.getElementById('pulloutReminderModal');
    reminderModal.style.opacity = '0'; // Transition to hidden
    setTimeout(() => {
        reminderModal.style.display = 'none'; // Hide after transition completes
    }, 300); // Match the transition duration (0.3s or 300ms)
};


    // Fetch the billing info when the page loads
    fetchBillingInfo();
});








//Customer order display unit&price
document.addEventListener('DOMContentLoaded', function () {
    // Function to fetch unit details and account number
    function fetchUnitDetails() {
        fetch('/api/unit-details')
            .then(response => response.json())
            .then(data => {
                if (data) {
                    // Update the account number on the page
                    document.getElementById('accountnumber').textContent = data.account_number ? data.account_number : '[Account Number Not Available]';

                    // Update the unit names and prices on the page
                    const unitnameContainer = document.getElementById('unitname');
                    const unitpriceContainer = document.getElementById('unitprice');

                    if (data.units.length > 0) {
                        // Clear existing content
                        unitnameContainer.innerHTML = '';
                        unitpriceContainer.innerHTML = '';

                        // Loop through each unit and append to the container
                        data.units.forEach(unit => {
                            const unitNameElement = document.createElement('div');
                            unitNameElement.textContent = unit.unitname;

                            const unitPriceElement = document.createElement('div');
                            unitPriceElement.textContent = `₱${parseFloat(unit.unitprice).toLocaleString('en-US', {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                            })}`;


                            unitnameContainer.appendChild(unitNameElement);
                            unitpriceContainer.appendChild(unitPriceElement);
                        });
                    } else {
                        unitnameContainer.textContent = '[No Units Available]';
                        unitpriceContainer.textContent = '₱0.00';
                    }
                }
            })
            .catch(error => console.error('Error fetching unit details:', error));
    }

    // Call the function to fetch unit details on page load
    fetchUnitDetails();
});



function fetchPaymentSchedule() {
    const loadingIndicator = document.getElementById('loading'); 
    loadingIndicator.style.display = 'block';

    fetch('/payment-schedule/customer')
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok ' + response.statusText);
            }
            return response.json();
        })
        .then(data => {
            loadingIndicator.style.display = 'none'; 

            console.log(data); 

            const tableBody = document.getElementById('payment-schedule-table-body');
            tableBody.innerHTML = ''; 

            let firstNotPaidAmount = null; 

            data.payment_schedule.forEach(payment => {
                const row = document.createElement('tr');
                let statusBadge = '';

                const paymentScheduleDate = new Date(payment.date);
                const actualPaymentDate = payment.actual_payment_date ? new Date(payment.actual_payment_date) : null;
                const today = new Date();

                // Payment status logic
                if (payment.status === 'paid') {
                    statusBadge = '<span class="badge" style="background-color: #28a745; color: white; padding: 0.5em 1em; border-radius: 0.5em; font-weight: bold;">Paid</span>';
                } else if (actualPaymentDate && actualPaymentDate > paymentScheduleDate && payment.status === 'paid late') {
                    statusBadge = '<span class="badge" style="background-color: #ffc107; color: black; padding: 0.5em 1em; border-radius: 0.5em; font-weight: bold;">Paid Late</span>';
                } else if (payment.status === 'paid in advance') {
                    statusBadge = '<span class="badge" style="background-color: green; color: white; padding: 0.5em 1em; border-radius: 0.5em; font-weight: bold;">Paid In Advance</span>';
                } else if (today > paymentScheduleDate) {
                    statusBadge = '<span class="badge" style="background-color: #dc3545; color: white; padding: 0.5em 1em; border-radius: 0.5em; font-weight: bold;">Overdue</span>';
                } else {
                    statusBadge = '<span class="badge" style="background-color: white; color: black; padding: 0.5em 1em; border-radius: 0.5em; font-weight: bold;">Not Paid</span>';
                    if (firstNotPaidAmount === null) {
                        firstNotPaidAmount = payment.amount; 
                    }
                }

                // Format payment date for display
                const formattedPaymentDate = paymentScheduleDate.toLocaleDateString('en-US', {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                });

                row.innerHTML = `
                    <td>${formattedPaymentDate}</td>
                    <td>₱${payment.amount}</td>
                    <td>${statusBadge}</td>
                `;
                tableBody.appendChild(row);
            });

            // Update billing card values
            document.getElementById('current-monthly-bill').textContent = firstNotPaidAmount ? `₱${firstNotPaidAmount}` : '₱0.00'; 
            document.getElementById('next-payment-due').textContent = data.nextPaymentDue ? data.nextPaymentDue : 'N/A';

            // Validate and format the balance to avoid NaN issues
            const balance = isNaN(Number(data.balance)) ? 0 : Number(data.balance); 
            document.querySelector('#balance .h3').textContent = `Pesos: ${balance.toLocaleString('en-US', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            })}`;

            document.getElementById('unit-price').textContent = `₱${data.unit_price}`; 
        })
        .catch(error => {
            console.error('There was a problem with the fetch operation:', error);
            loadingIndicator.style.display = 'none'; 
        });
}

fetchPaymentSchedule();


// transaction history
document.addEventListener('DOMContentLoaded', function() {
    fetchBillingHistory();
});

function fetchBillingHistory() {
    // Make an AJAX request to get the billing history
    fetch('{{ route('billing.history') }}')
        .then(response => response.json())
        .then(data => {
            // Check if there's an error
            if (data.error) {
                console.error(data.error);
                return;
            }

            // Get the billing history table body
            const billingHistoryBody = document.getElementById('billing-history-body');
            billingHistoryBody.innerHTML = ''; // Clear previous entries

            // Loop through the data and add each row to the table
            data.forEach(item => {
                const row = document.createElement('tr');

                // Add customer ID (Account#)
                const customerIdCell = document.createElement('td');
                customerIdCell.textContent = item.customer_id;
                row.appendChild(customerIdCell);

                // Add date
                const dateCell = document.createElement('td');
                dateCell.textContent = formatDate(item.date); // Format the date if needed
                row.appendChild(dateCell);

                // Add amount
                const amountCell = document.createElement('td');
                amountCell.textContent = item.amount ? parseFloat(item.amount).toFixed(2) : '0.00'; // Ensure 2 decimal places
                row.appendChild(amountCell);

                // Add payment method
                const paymentMethodCell = document.createElement('td');
                paymentMethodCell.textContent = item.payment_method || 'N/A'; // Handle null values
                row.appendChild(paymentMethodCell);

                // Add violation
                const violationCell = document.createElement('td');
                violationCell.textContent = item.violation || 'None';
                row.appendChild(violationCell);

                // Add comment
                const commentCell = document.createElement('td');
                commentCell.textContent = item.comment || 'No comment';
                row.appendChild(commentCell);

                // Append the row to the table
                billingHistoryBody.appendChild(row);
            });
        })
        .catch(error => console.error('Error fetching billing history:', error));
}

// Utility function to format date
function formatDate(dateString) {
    const options = { year: 'numeric', month: 'long', day: 'numeric' };
    const date = new Date(dateString);
    return date.toLocaleDateString(undefined, options); // e.g., "October 5, 2024"
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






<script src="{{ asset('js/customer/cusdashboard.js') }}"></script>
<script src="{{ asset('js/customer/topnav.js') }}"></script>
<script src="{{ asset('js/darkmode.js') }}"></script>
</body>

</html>