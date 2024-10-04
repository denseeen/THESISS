

// notification

document.addEventListener('DOMContentLoaded', function() {
    // Notification dropdown
    const notificationContainer = document.querySelector('.notification-container');
    const notificationDropdown = notificationContainer.querySelector('.dropdown-notification');
    const notificationCount = notificationContainer.querySelector('.notification-count');

    function updateNotificationCount() {
        const notificationItems = notificationDropdown.querySelectorAll('.notification-item:not(.no-notifications)');
        const count = notificationItems.length;

        if (count > 0) {
            notificationCount.textContent = count;
            notificationCount.style.display = 'inline';
        } else {
            notificationCount.textContent = '';
            notificationCount.style.display = 'none';
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

            const notificationItem = event.target.closest('.notification-item');
            const messageId = notificationItem.getAttribute('data-message-id'); // Assuming message ID is stored here

            // Send AJAX request to mark as read
            fetch(`/mark-message-read/${messageId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    notificationItem.remove(); // Remove the item from the UI
                    updateNotificationCount();
                } else {
                    console.error('Failed to mark message as read.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
    });

    updateNotificationCount();
});


