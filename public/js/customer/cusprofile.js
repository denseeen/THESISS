 // Dark Mode
        function toggleDarkModeDashboard() {
            document.body.classList.toggle('dark-mode');
            document.querySelectorAll('.profile-body, .info h3').forEach(item => {
                item.classList.toggle('dark-mode');
            });
        }

        // Dropdown
        function toggleDropdown() {
            document.getElementById('dropdownMenu').classList.toggle('show');
        }

        window.onclick = function(event) {
            if (!event.target.closest('.profile-icon')) {
                var dropdowns = document.getElementsByClassName('dropdown-menu');
                for (var i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        } 
 
        document.addEventListener('DOMContentLoaded', () => {
            // Get the modal elements
            const avatarModal = document.getElementById('avatarModal');
            const passwordModal = document.getElementById('passwordModal');
            const currentAvatar = document.getElementById('current-avatar');
            const uploadInput = document.getElementById('upload-avatar-input');
        
            // Get the button that opens the modals
            const changeAvatarBtn = document.getElementById('change-avatar-btn');
            const changePasswordBtn = document.getElementById('change-password-btn');
        
            // Get the <span> elements that close the modals
            const closeAvatarModal = document.getElementById('closeAvatarModal');
            const closePasswordModal = document.getElementById('closePasswordModal');
        
            // Open the avatar modal
            changeAvatarBtn.addEventListener('click', () => {
                avatarModal.style.display = 'block';
            });
        
            // Open the password modal
            changePasswordBtn.addEventListener('click', () => {
                passwordModal.style.display = 'block';
            });
        
            // Close the avatar modal
            closeAvatarModal.addEventListener('click', () => {
                avatarModal.style.display = 'none';
            });
        
            // Close the password modal
            closePasswordModal.addEventListener('click', () => {
                passwordModal.style.display = 'none';
            });
        
            // Close the modals when clicking outside of them
            window.addEventListener('click', (e) => {
                if (e.target === avatarModal) {
                    avatarModal.style.display = 'none';
                }
                if (e.target === passwordModal) {
                    passwordModal.style.display = 'none';
                }
            });
        
            // Handle avatar selection
            const avatarOptions = document.querySelectorAll('.modal-avatar');
            avatarOptions.forEach(option => {
                option.addEventListener('click', (e) => {
                    const newAvatarSrc = e.target.getAttribute('data-avatar');
                    if (newAvatarSrc) {
                        currentAvatar.src = `/image/${newAvatarSrc}`;
                        avatarModal.style.display = 'none'; // Hide modal after selection
                    }
                });
            });
        
            // Handle avatar upload
            uploadInput.addEventListener('change', (event) => {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        currentAvatar.src = e.target.result;
                    }
                    reader.readAsDataURL(file);
                    avatarModal.style.display = 'none';
                }
            });
        
            // Handle password change
            const submitPasswordChangeBtn = document.getElementById('submit-password-change');
            submitPasswordChangeBtn.addEventListener('click', () => {
                const oldPassword = document.getElementById('old-password').value;
                const newPassword = document.getElementById('new-password').value;
                const confirmPassword = document.getElementById('confirm-password').value;
        
                if (newPassword !== confirmPassword) {
                    alert("New passwords do not match!");
                    return;
                }
        
                // Perform your password change logic here
                // For example, send an AJAX request to the server to change the password
        
                // Close the modal after changing the password
                passwordModal.style.display = 'none';
            });
        
          
        
            // Close dropdown if clicked outside
            window.addEventListener('click', (event) => {
                if (!event.target.closest('.profile-icon')) {
                    const dropdowns = document.getElementsByClassName('dropdown-menu');
                    for (let i = 0; i < dropdowns.length; i++) {
                        const openDropdown = dropdowns[i];
                        if (openDropdown.classList.contains('show')) {
                            openDropdown.classList.remove('show');
                        }
                    }
                }
            });
        });
        