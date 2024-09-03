// Dark Mode Toggle
function toggleDarkModeDashboard() {
    document.body.classList.toggle('dark-mode');
    document.querySelectorAll('.profile-body, .info h3').forEach(item => {
        item.classList.toggle('dark-mode');
    });
}

// Dropdown Toggle
function toggleDropdown() {
    document.getElementById('dropdownMenu').classList.toggle('show');
}

// Click handler for closing dropdowns
window.onclick = function(event) {
    if (!event.target.closest('.profile-icon')) {
        document.querySelectorAll('.dropdown-menu.show').forEach(dropdown => {
            dropdown.classList.remove('show');
        });
    }
}

//Password,avatar 
document.addEventListener('DOMContentLoaded', () => {
    const avatarModal = document.getElementById('avatarModal');
    const passwordModal = document.getElementById('passwordModal');
    const currentAvatar = document.getElementById('current-avatar');
    const uploadInput = document.getElementById('upload-avatar-input');
    const changeAvatarBtn = document.getElementById('change-avatar-btn');
    const openPasswordModalButton = document.getElementById('change-password-btn');
    const closeAvatarModal = document.getElementById('closeAvatarModal');
    const closePasswordModalButton = document.getElementById('closePasswordModal');

    // Open and close modals
    changeAvatarBtn.addEventListener('click', () => {
        avatarModal.style.display = 'block';
    });

    openPasswordModalButton.addEventListener('click', () => {
        passwordModal.style.display = 'block';
    });

    closeAvatarModal.addEventListener('click', () => {
        avatarModal.style.display = 'none';
    });

    closePasswordModalButton.addEventListener('click', () => {
        passwordModal.style.display = 'none';
    });

    // Close modals if clicking outside
    window.addEventListener('click', (event) => {
        if (event.target === avatarModal || event.target === passwordModal) {
            event.target.style.display = 'none';
        }
    });

    // Handle avatar upload
    uploadInput.addEventListener('change', (event) => {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                currentAvatar.src = e.target.result;
                avatarModal.style.display = 'none';
            }
            reader.readAsDataURL(file);
        }
    });

    
    
});


  // notification

  document.addEventListener('DOMContentLoaded', function() {
    // Notification dropdown
    const notificationContainer = document.querySelector('.notification-container');
    const notificationDropdown = notificationContainer.querySelector('.dropdown-notification');
    const notificationCount = notificationContainer.querySelector('.notification-count');

    function updateNotificationCount() {
        const notificationItems = notificationDropdown.querySelectorAll('.notification-item');
        const count = notificationItems.length;
        
        if (count > 0) {
            notificationCount.textContent = count;
            notificationCount.style.display = 'inline';
        } else {
            notificationCount.textContent = '';
            notificationCount.style.display = 'none';

            // Show "No Notifications" message
        if (!notificationDropdown.querySelector('.no-notifications')) {
            const noNotificationsMessage = document.createElement('div');
            noNotificationsMessage.classList.add('no-notifications');
            noNotificationsMessage.textContent = 'No Notifications';
            noNotificationsMessage.style.padding = '10px';
            noNotificationsMessage.style.textAlign = 'center';
            notificationDropdown.appendChild(noNotificationsMessage);
        }
        }

        
    }

    notificationContainer.addEventListener('click', function(event) {
        event.stopPropagation(); // Prevent event from bubbling up to the window
        notificationDropdown.classList.toggle('show');
    });

    window.addEventListener('click', function(event) {
        if (!notificationContainer.contains(event.target)) {
            notificationDropdown.classList.remove('show');
        }
    });

    notificationDropdown.addEventListener('click', function(event) {
        if (event.target.classList.contains('delete-icon')) {
            event.stopPropagation(); // Prevent the dropdown from closing
            event.target.closest('.notification-item').remove();
            updateNotificationCount();
        }
    });

    updateNotificationCount();

    
});





