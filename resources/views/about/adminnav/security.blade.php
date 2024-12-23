<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Dashboard</title>

        <!-- Stylesheets -->
        <link href="{!! url('css/admin/adminsecurity.css') !!}" rel="stylesheet">
        <link href="{{ url('css/admin/topnav_sidenav.css') }}" rel="stylesheet">

        <!-- Font Awesome for icons -->
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
                        <li><a href="{{ route('FullyPaid_Customer.show') }}"><span class="icon"><i class="fa fa-book"></i></span><span class="text">Cash</span></a></li>
                        <li><a href="{{ route('installments.archived') }}"><span class="icon"><i class="fa fa-question-circle"></i></span><span class="text">Fully Paid</span></a></li>
                    </ul>
                </div>
            </div>
        </div>


        <!-- security content -->

        <div class="container">
    <h2>Set Your Security Questions</h2>
    <form id="security-questions-form">
        @csrf
        <!-- Correct question IDs -->
        <input type="hidden" id="question_id1" name="question_id1" value="1" />
        <label for="answer1">What is your mother's maiden name?</label>
        <input type="text" id="answer1" name="answer1" required />

        <input type="hidden" id="question_id2" name="question_id2" value="2" />
        <label for="answer2">What was the name of your first pet?</label>
        <input type="text" id="answer2" name="answer2" required />

        <input type="hidden" id="question_id3" name="question_id3" value="3" />
        <label for="answer3">What is the name of the street you grew up on?</label>
        <input type="text" id="answer3" name="answer3" required />

        <input type="hidden" id="question_id4" name="question_id4" value="4" />
        <label for="answer4">What is your favorite food?</label>
        <input type="text" id="answer4" name="answer4" required />

        <button type="submit">Submit</button>
    </form>
</div>


        <!-- <div class="card">
                <div class="card-header">Delete Account</div>
                <div class="card-body">
                    <p>Deleting your account is a permanent action and cannot be undone. If you are sure you want to delete your account, select the button below. Your account will be marked for deletion and will be permanently deleted after 30 days unless you log in within that period to cancel the deletion.</p>
                    <form id="delete-account-form" action="" method="POST">
                         @csrf
                        <button type="button" class="btn btn-danger-soft" onclick="confirmDeletion()">I understand, delete my account</button>
                    </form>
                </div>
        </div>
             -->


<script>

        document.getElementById('security-questions-form').addEventListener('submit', function (e) {
        e.preventDefault();

        const answers = {
            answer1: document.getElementById('answer1').value.trim(),
            answer2: document.getElementById('answer2').value.trim(),
            answer3: document.getElementById('answer3').value.trim(),
            answer4: document.getElementById('answer4').value.trim(),
            question_id1: document.getElementById('question_id1').value,
            question_id2: document.getElementById('question_id2').value,
            question_id3: document.getElementById('question_id3').value,
            question_id4: document.getElementById('question_id4').value
        };

        const route = '{{ route('adsecurity.store') }}'; // Ensure this route is correct
        console.log('Sending data to:', route);
        console.log('Data:', answers);

        fetch(route, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
            body: JSON.stringify(answers)
            })
                .then(response => response.json())
                .then(data => {
                    console.log('Response data:', data);
                    if (data.success) {
                        alert("Your security questions have been saved successfully!");
                    } else {
                        alert("There was an error saving your security questions.");
                    }
            })
                .catch(error => {
                    console.error('Error:', error);
                });
        });


        //delete notification like alert
        function confirmDeletion() {
            if (confirm('Are you sure you want to delete your account? This action cannot be undone and your account will be permanently deleted after 30 days unless you log in within that period.')) {
                document.getElementById('delete-account-form').submit();
            }
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
<script src="{{ asset('js/admin/toppsidenav.js') }}"></script>  
</body>
</html>