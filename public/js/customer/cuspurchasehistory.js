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
