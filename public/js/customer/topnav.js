

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



// document.addEventListener('DOMContentLoaded', function() {
//     // Notification dropdown
//     const notificationContainer = document.querySelector('.notification-container');
//     const notificationDropdown = notificationContainer.querySelector('.dropdown-notification');
//     const notificationCount = notificationContainer.querySelector('.notification-count');

//     function updateNotificationCount() {
//         const notificationItems = notificationDropdown.querySelectorAll('.notification-item:not(.no-notifications)');
//         const count = notificationItems.length;

//         if (count > 0) {
//             notificationCount.textContent = count;
//             notificationCount.style.display = 'inline';
//         } else {
//             notificationCount.textContent = '';
//             notificationCount.style.display = 'none';
//         }
//     }

//     notificationContainer.addEventListener('click', function(event) {
//         event.stopPropagation(); // Prevent event from bubbling up to the window
//         notificationDropdown.classList.toggle('show');
//     });

//     window.addEventListener('click', function(event) {
//         if (!notificationContainer.contains(event.target)) {
//             notificationDropdown.classList.remove('show');
//         }
//     });

//     notificationDropdown.addEventListener('click', function(event) {
//         if (event.target.classList.contains('delete-icon')) {
//             event.stopPropagation(); // Prevent the dropdown from closing
//             event.target.closest('.notification-item').remove();
//             updateNotificationCount();
//         }
//     });

//     updateNotificationCount();
// });


