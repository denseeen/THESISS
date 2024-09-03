// Dark Mode
function toggleDarkModeDashboard() {
    document.body.classList.toggle('dark-mode');
    document.querySelectorAll('').forEach(item => {
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
