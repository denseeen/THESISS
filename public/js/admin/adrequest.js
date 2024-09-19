



// installmentplan
document.getElementById('installment').addEventListener('change', function() {
  document.getElementById('installmentOptions').style.display = this.checked ? 'block' : 'none';
});

document.getElementById('fully_paid').addEventListener('change', function() {
  if (this.checked) {
      document.getElementById('installment').checked = false;
      document.getElementById('installmentOptions').style.display = 'none';
  }
});