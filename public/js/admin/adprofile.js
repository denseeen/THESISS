

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
