<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Profile</title>
        
        <!-- Stylesheets -->
        <link href="{!! url('css/admin/adminprofile.css') !!}" rel="stylesheet">
        <link href="{{ url('css/admin/topnav_sidenav.css') }}" rel="stylesheet">
        <link href="{{ url('responsiv/customer/adprofile.css') }}" rel="stylesheet">
    
        
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
        
        
       <!-- Profile Content -->
<div class="profile-card">
    <div class="profile-header">
        <div class="avatar-container">
            @if(Auth::user()->avatar)
                <img src="{{ asset('storage/images/' . Auth::user()->avatar) }}" alt="Avatar" class="avatar" id="current-avatar">
            @else
                <img src="/image/avatar1.jpg" alt="Avatar" class="avatar" id="current-avatar">
            @endif
            <button class="change-avatar-btn" id="change-avatar-btn"></button>
        </div>
        <div class="name-title">
            <h2 id="profile-name">{{ $info->name ?? 'Not Available' }}</h2>
        </div>
    </div>
    

    <div class="profile-body">
        <div class="info">
            <h3>Information</h3>
            <hr>
            @if($info)
                <p><strong>Gender:</strong> <span id="gender">{{ $info->gender ?? 'Not Available' }}</span></p>
                <p><strong>Birthday:</strong> <span id="profile-birthday">{{ $info->date_of_birth ?? 'Not Available' }}</span></p>
                <hr>
                <p><strong>Email:</strong> <span id="profile-email">{{ $info->email ?? 'Not Available' }}</span></p>
                <p><strong>Facebook:</strong> <span id="profile-facebook">{{ $info->facebook ?? 'Not Available' }}</span></p>
                <hr>
                <p><strong>Telephone:</strong> <span id="profile-telephone">{{ $info->telephone_number ?? 'Not Available' }}</span></p>
                <p><strong>Mobile:</strong> <span id="profile-mobile">{{ $info->phone_number ?? 'Not Available' }}</span></p>
                <p><strong>Address:</strong> <span id="profile-address">{{ $info->streetaddress ?? 'Not Available' }}</span></p>
                <hr>  
            @else
                <p>No information available.</p>
            @endif
        </div>
    



    <div class="password-edit">
        <label for="password"><strong>Password:</strong></label>
        <a href="#" id="password-link">{{ str_repeat('*', 8) }}</a>
        <button class="edit-button" id="change-password-btn">Edit</button>
    </div>
</div>

<script>
    // Log the variables to the console
    console.log("Admin Info:", @json($info));
    console.log("User Email:", "{{ Auth::user()->email }}");
    console.log("User Info:", userInfo);
</script>

    <!-- Avatar Modal -->
    <div id="avatarModal" class="modal">
            <div class="modal-customercontent">
                <span class="close" id="closeAvatarModal">&times;</span>
                <!-- <h2>Select an Avatar</h2>

                <div class="avatar-options">
                    <div class="avatar-option">
                        <img src="/image/avatar1.jpg" alt="Avatar 1" class="modal-avatar" data-avatar="avatar1.jpg">
                        <h5>Avatar 1</h5>
                    </div> -->

                    <div class="upload-avatar">
                        <span class="upload-icon">&#43;</span>
                        <form action="{{ route('upload-avatar-admin') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="avatar" id="upload-avatar-input" accept="image/*" style="display:none;">
                            <label for="upload-avatar-input" style="cursor:pointer;">Upload</label>
                            <button type="submit" style="display:none;" id="upload-avatar-button">Upload Avatar</button>
                        </form>
                        
                    </div>

                </div>
            </div>
    </div>

    <!-- Password Modal -->
    <div id="passwordModal" class="modal" style="display: none;">
        <div class="modal-content">
                <span class="close" id="closePasswordModal">&times;</span>
                <h2>Change Password</h2>
                <input type="password" id="old-password" class="password-field-modal" placeholder="Old Password">
                <input type="password" id="new-password" class="password-field-modal" placeholder="New Password">
                <input type="password" id="confirm-password" class="password-field-modal" placeholder="Confirm New Password">
                    <div class="show-passwords-container"  style="float: right;font-size: small;">
                        <input type="checkbox" id="show-passwords" onclick="togglePasswords()"> <label for="show-passwords">Show Passwords</label>
                    </div>
                <button class="modal-submit-button" id="submit-password-change">Save</button>
        </div>
    </div>

    <!-- Scripts -->
   <script>
    // Toggle password visibility in the modal
        function togglePasswords() {
            const oldPasswordField = document.getElementById('old-password');
            const newPasswordField = document.getElementById('new-password');
            const confirmPasswordField = document.getElementById('confirm-password');
            const showPasswords = document.getElementById('show-passwords').checked;
            
            oldPasswordField.type = showPasswords ? 'text' : 'password';
            newPasswordField.type = showPasswords ? 'text' : 'password';
            confirmPasswordField.type = showPasswords ? 'text' : 'password';
        }
    
    // Change Password
    document.getElementById('submit-password-change').addEventListener('click', function() {
        const oldPassword = document.getElementById('old-password').value;
        const newPassword = document.getElementById('new-password').value;
        const confirmPassword = document.getElementById('confirm-password').value;

        if (newPassword !== confirmPassword) {
            alert('New password and confirmation do not match');
            return;
        }

        fetch('{{ route('password.change') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                old_password: oldPassword,
                new_password: newPassword,
                new_password_confirmation: confirmPassword
            })
        })
        .then(response => response.text())
        .then(text => {
            try {
                const data = JSON.parse(text);
                if (data.status === 'success') {
                    alert('Password changed successfully!');
                    passwordModal.style.display = 'none';
                } else {
                    alert('Failed to change password: ' + data.message);
                }
            } catch (e) {
                throw new Error('Password character must at least 8');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while changing the password: ' + error.message);
        });
    });


     
    //Upload avatar
    document.getElementById('upload-avatar-input').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const formData = new FormData();
            formData.append('avatar', file);
    
            fetch('{{ route('upload-avatar-admin') }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('current-avatar').src = `/storage/images/${data.avatarPath}`;
                    // Optionally close the modal
                    document.getElementById('avatarModal').style.display = 'none';
                } else {
                    alert('Failed to upload avatar.');
                }
            })
            .catch(error => console.error('Error:', error));
        }
    });

    // Handle avatar selection
    document.querySelectorAll('.modal-avatar').forEach(option => {
        option.addEventListener('click', (e) => {
            const newAvatarSrc = e.target.getAttribute('data-avatar');
            if (newAvatarSrc) {
                currentAvatar.src = `/image/${newAvatarSrc}`;
                avatarModal.style.display = 'none';
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



    <script src="{{ asset('js/admin/adprofile.js') }}"></script>
    <script src="{{ asset('js/admin/toppsidenav.js') }}"></script>  
</body>
</html>