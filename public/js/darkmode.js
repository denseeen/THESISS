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