<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Customer Profile Page">
    <title>Customer Profile</title>
    <link href="{{ url('css/customer/cusprofile.css') }}" rel="stylesheet">
    <link href="{{ url('css/customer/topnav.css') }}" rel="stylesheet">
    <link href="{{ url('responsiv/customer/customerprofile.css') }}" rel="stylesheet">
</head>
<body>
    <!-- Top Navbar -->
     <!-- Top Navbar -->
     <nav class="top_navbar">
            <a href="{{ route('cusdasboard.show') }}">
                <img src="/image/logoBillnWow3.png" class="TopNav-BillnWoWlogo" alt="BillnWoWLogo" style="margin-top:-1.3%">
            </a>
            <div class="icons">
            <ul class="navigation-menu">
                <li><a href="{{ route('cusdasboard.show') }}">Dashboard</a></li>
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
                        <h2 id="profile-name">{{ Auth::user()->name }}</h2>
                    </div>
            </div>

            <div class="profile-body">
                    <div class="info">
                        <h3>Information</h3>
                        <p><strong>Gender:</strong> <span id="profile-gender">Male</span></p>
                        <p><strong>Birthday:</strong> <span id="profile-birthday">August 12, 2024</span></p>
                        <hr>
                        <p><strong>Email:</strong> <span id="profile-email">{{ Auth::user()->email }}</span></p>
                        <p><strong>Facebook:</strong> <span id="profile-facebook">Hembo Tingor</span></p>
                        <hr>
                        <p><strong>Telephone:</strong> <span id="profile-telephone">239553655</span></p>
                        <p><strong>Mobile:</strong> <span id="profile-mobile">+63 924336535</span></p>
                            <div class="field">
                                <p><strong>Address:</strong> <span id="profile-address">Anonas, Cubao, Quezon City</span></p>
                            </div>
                    </div>

                    <div class="password-edit">
                        <label for="password"><strong>Password:</strong></label>
                        <a href="#" id="password-link">{{ str_repeat('*', 8) }}</a>
                        <button class="edit-button" id="change-password-btn">Edit</button>
                    </div>
            </div>
    </div>

    <!-- Avatar Modal -->
    <div id="avatarModal" class="modal">
            <div class="modal-customercontent">
                <span class="close" id="closeAvatarModal">&times;</span>

                    <div class="upload-avatar">
                        <span class="upload-icon">&#43;</span>
                        <form action="{{ route('upload-avatar') }}" method="POST" enctype="multipart/form-data">
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
    
            fetch('{{ route('upload-avatar') }}', {
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

    </script>

<script src="{{ asset('js/customer/cusprofile.js') }}"></script>     
</body>
</html>