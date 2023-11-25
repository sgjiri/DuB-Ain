document.addEventListener('DOMContentLoaded', function() {
    const checkbox = document.getElementById('Check');
    const form = document.querySelector('.formContact');

    console.log(form);
  
    form.addEventListener('submit', function(event) {
      if (!checkbox.checked) {
        event.preventDefault(); // Prevent form submission
        alert('Veuillez cocher la case de Politique de confidentialité.');
      }
    });
  });
  