document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM entièrement chargé et analysé');

    const form = document.querySelector('.formContact');

    if (!form) {
        console.error('Le formulaire n\'a pas été trouvé sur la page.');
        return; // Arrêter l'exécution si le formulaire n'est pas trouvé
    }

    form.addEventListener('submit', function(event) {
        const checkbox = document.getElementById('Check');
       
        
        if (!checkbox.checked) {
            event.preventDefault(); // Empêcher la soumission du formulaire
            alert('Veuillez cocher la case de Politique de confidentialité.');
            return; // Arrêter l'exécution si la case n'est pas cochée
        }

        
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        const emailInput = form.querySelector('#contact_email');
        if(emailRegex.test(emailInput.value)){
          alert('Votre message a bien était envoyé');
        }
    });
});

  