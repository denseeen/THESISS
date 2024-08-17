<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Customer Profile Page">
        <title>Customer Profile</title>
    
        <link href="{{ url('css/customer/cusprofile.css') }}" rel="stylesheet">
        <link href="{{ url('css/customer/topnav.css') }}" rel="stylesheet">
        <link href="{{ url('responsiv/customer/customerprofile.css') }}" rel="stylesheet">
    </head>
<body>
     <!-- Top Navbar -->
     <nav class="top_navbar">
            <a href="{{ route('cusdasboard.show') }}">
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
                        <a href="{{ route('cusprofile.show') }}">Profile</a>
                        <a href="#">Change Password</a>
                        <a href="{{ route('about.layout') }}">Logout</a>
                    </div>
                </div>
            </div>
        </nav>

    <!-- Profile Content -->
     
    <div class="profile-card">
    <div class="profile-header">
        <div class="avatar-container">
            <img src="/image/avatar1.jpg" alt="Avatar" class="avatar" id="current-avatar">
            <button class="change-avatar-btn" id="change-avatar-btn"></button>
           
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
            <a href="#" id="password-link">*******</a>
            <button class="edit-button" id="change-password-btn">Edit</button>
        </div>
    </div>
</div>

        <!-- Avatar Modal -->
        <div id="avatarModal" class="modal">
            <div class="modal-customercontent">
                <span class="close" id="closeAvatarModal">&times;</span>
                <h2>Select an Avatar</h2>

                <div class="avatar-options">
                    <div class="avatar-option">
                        <img src="/image/avatar1.jpg" alt="Avatar 1" class="modal-avatar" data-avatar="avatar1.jpg">
                        <h5>Avatar 1</h5>
                    </div>

                    <div class="avatar-option">
                        <img src="/image/avatar2.jpg" alt="Avatar 2" class="modal-avatar" data-avatar="avatar2.jpg">
                        <h5>Avatar 2</h5>
                    </div>

                    <div class="avatar-option">
                        <img src="/image/avatar3.png" alt="Avatar 3" class="modal-avatar" data-avatar="avatar3.png">
                        <h5>Avatar 3</h5>
                    </div>

                    <div class="avatar-option">
                        <img src="/image/avatar4.png" alt="Avatar 4" class="modal-avatar" data-avatar="avatar4.png">
                        <h5>Avatar 4</h5>
                    </div>

                    <div class="avatar-option">
                        <img src="/image/avatar5.png" alt="Avatar 5" class="modal-avatar" data-avatar="avatar5.png">
                        <h5>Avatar 5</h5>
                    </div>

                    <div class="upload-avatar">
                        <span class="upload-icon">&#43;</span>
                        <input type="file" id="upload-avatar-input" accept="image/*" style="display:none;">
                        <label for="upload-avatar-input" style="cursor:pointer;">Upload</label>
                    </div>
                </div>
            </div>
        </div>

        <!-- The Password Modal -->
        <div id="passwordModal" class="modal">
            <div class="modal-customercontent ">
                <span class="close" id="closePasswordModal">&times;</span>
                <h2>Change Password</h2>
                <input type="password" id="old-password" class="password-field-modal" placeholder="Old Password">
                <input type="password" id="new-password" class="password-field-modal" placeholder="New Password">
                <input type="password" id="confirm-password" class="password-field-modal" placeholder="Confirm New Password">
                <button class="modal-submit-button" id="submit-password-change">Save</button>
            </div>
        </div>
        <script src="{{ asset('js/customer/cusprofile.js') }}"></script>
    </body>
</html>
