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

// SideNav
document.addEventListener("DOMContentLoaded", function() {
  var li_items = document.querySelectorAll(".sidebar ul li");
  var hamburger = document.querySelector(".hamburger");

  li_items.forEach((li_item) => {
    li_item.addEventListener("mouseenter", () => {
      li_item.closest(".wrapper").classList.remove("hover_collapse");
    });
  });

  li_items.forEach((li_item) => {
    li_item.addEventListener("mouseleave", () => {
      li_item.closest(".wrapper").classList.add("hover_collapse");
    });
  });

  hamburger.addEventListener("click", () => {
    hamburger.closest(".wrapper").classList.toggle("hover_collapse");
  });
});

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
