

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





document.addEventListener('DOMContentLoaded', function () { 
    const bellIcon = document.getElementById('bellIcon');
    const dropdownNotification = document.getElementById('dropdownNotification');
    const notificationCount = document.querySelector('.notification-count');

    // Fetch messages when the page loads
    fetchMessages();

    // Toggle dropdown visibility on bell icon click
    bellIcon.addEventListener('click', function () {
        dropdownNotification.classList.toggle('show'); // Toggle the 'show' class to display/hide the dropdown

        // Fetch messages again when dropdown is opened (to refresh)
        if (dropdownNotification.classList.contains('show')) {
            fetchMessages();
        }
    });

    function fetchMessages() {
        fetch('/api/messages')
            .then(response => response.json())
            .then(messages => {
                const notificationContainer = document.querySelector('.box-body');
                notificationContainer.innerHTML = ''; // Clear the container first

                const count = messages.length;
                notificationCount.textContent = count > 0 ? count : '';
                notificationCount.style.display = count > 0 ? 'inline' : 'none';

                if (count === 0) {
                    notificationContainer.innerHTML = `
                        <div class="notification-item no-notifications">
                            <div class="notification-content">
                                <div class="notification-message" style="padding: 10px; text-align: center;">
                                    No Notifications
                                </div>
                            </div>
                        </div>`;
                } else {
                    messages.forEach(message => {
                        const notificationItem = document.createElement('div');
                        notificationItem.classList.add('notification-item');
                        notificationItem.setAttribute('data-message-id', message.id); // Make sure 'id' is the correct property
                    
                        notificationItem.innerHTML = `
                            <div class="notification-content">
                                <div class="notification-sender" style="color:red; margin-bottom:2%;">
                                    ${message.sender_name}
                                </div>
                                <div class="notification-message">
                                    ${message.content}
                                    <span class="delete-icon" data-message-id="${message.id}">&#10060;</span> <!-- Ensure this is set correctly -->
                                </div>
                            </div>`;
                        
                        notificationContainer.appendChild(notificationItem);
                    });
                    
                }
            })
            .catch(error => console.error('Error fetching messages:', error));
    }
    
    document.addEventListener('click', function(event) {
        if (event.target.classList.contains('delete-icon')) {
            const messageId = event.target.getAttribute('data-message-id');
            console.log("Message ID:", messageId); // Log the message ID for debugging
    
            // Check if messageId is valid
            if (!messageId) {
                console.error("No message ID found");
                return;
            }
    
            // Send a DELETE request to the server
            fetch(`/api/messages/${messageId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => {
                if (response.ok) {
                    // Remove the notification item from the DOM
                    event.target.closest('.notification-item').remove();
    
                    // Update notification count
                    const notificationCount = document.querySelector('.notification-count');
                    notificationCount.textContent = document.querySelectorAll('.notification-item').length;
                } else {
                    console.error('Failed to delete message:', response.statusText);
                }
            })
            .catch(error => console.error('Error deleting message:', error));
        }
    });
    
});