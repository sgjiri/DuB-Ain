// Point d'entrée du script pour le menu burger sur un site responsive.
const burger = document.querySelector('.container-burger');
// Récupération de toutes les lignes qui composent l'icône du menu burger.
let line = document.getElementsByClassName('burgerLigne');
// Récupération de la navigation mobile à partir de son ID.
let navMobil = document.getElementById('navigation-mobil');

// Ajout d'un écouteur d'événement sur le clic pour le menu burger.
burger.addEventListener('click', function () {
  // Pour chaque ligne du menu burger, basculer la classe 'active'.
  for (let i = 0; i < line.length; i++) {
    line[i].classList.toggle('active');
  }
  // Basculer la classe 'active' sur la navigation mobile pour l'afficher ou la cacher.
  navMobil.classList.toggle('active');
});

// Écouteur d'événements pour exécuter le code une fois que le contenu du DOM est chargé.
document.addEventListener("DOMContentLoaded", function () {
  // Sélection de toutes les sections qui doivent être animées.
  const sections = document.querySelectorAll(".animated-section");
  
  // Pour chaque section, créer un IntersectionObserver pour détecter son entrée dans le viewport.
  sections.forEach(function (section) {
    const observer = new IntersectionObserver(
      function (entries, observer) {


        //entries est un tableau d'objets IntersectionObserverEntry, chacun représentant un élément observé
        entries.forEach(function (entry) {


          // Si l'entrée observée est notre section et qu'elle est dans le viewport.
          if (entry.target === section && entry.isIntersecting) {


            // Sélectionner tous les éléments à animer depuis la droite et la gauche.
            let elementsRight = section.querySelectorAll(".animation-right");
            let elementsLeft = section.querySelectorAll(".animation-left");


            // Sélectionner tous les éléments de type 'carte' qui doivent être animés.
            let cardElement = section.querySelectorAll(".oneValue");

            // Appliquer une animation avec délai sur chaque élément venant de la droite.
            elementsRight.forEach(function (element, index) {
              element.style.animation = `slideInRigth 1s ${index * 0.3}s forwards`;
            });

            // Appliquer une animation sur les éléments venant de la gauche.
            elementsLeft.forEach(function (element) {
              element.style.animation = `slideIn 1s 0.5s forwards`;
            });

            
            // Ajouter la classe 'active' sur chaque élément de type 'carte'.
            cardElement.forEach(function (element) {
              element.classList.add('active');
            });


            // Une fois animée, la section n'est plus observée.
            observer.disconnect();
          }
        });
      },
      // Options de l'observer: aucun élément racine (viewport par défaut), pas de marge, et un seuil à 60%.
      {
         root: null,
         rootMargin: "0px",
         threshold: 0.6,
     }
    );
    // Lancer l'observation de la section.
    observer.observe(section);
  });
});