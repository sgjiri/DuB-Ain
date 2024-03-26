// Initialisation d'un nouveau carrousel Glider sur l'élément avec la classe 'glider'.
new Glider(document.querySelector('.glider'), {
  slidesToShow: 3.2, // Nombre de diapositives à afficher à l'écran dans la vue par défaut.
  draggable: true, // Permet de faire glisser le carrousel avec la souris ou le doigt.
  dots: '#dots', // Sélecteur CSS pour l'élément qui affichera les points de pagination du carrousel.
  arrows: {
    prev: '.glider-prev', // Sélecteur CSS pour l'élément flèche précédente.
    next: '.glider-next' // Sélecteur CSS pour l'élément flèche suivante.
  },
  responsive: [ // Configuration de la réactivité pour différents points d'arrêt.
      {
        // Écrans supérieurs ou égaux à 1200px.
        breakpoint: 1200,
        settings: {
          // Nombre de diapositives à afficher pour les grands écrans.
          slidesToShow: 3.2,
        }
      },{
        // Écrans supérieurs ou égaux à 900px.
        breakpoint: 900,
        settings: {
          // Nombre de diapositives à afficher pour les écrans moyens.
          slidesToShow: 2.2,
        }
      }, {
          // Écrans supérieurs ou égaux à 640px.
          breakpoint: 640,
          settings: {
            // Nombre de diapositives à afficher pour les écrans petits.
            slidesToShow: 1.2,
          }
      }, {
          // Écrans supérieurs ou égaux à 300px.
          breakpoint: 300,
          settings: {
            // Nombre de diapositives à afficher pour les écrans très petits.
            slidesToShow: 1,
          }
      }
  ]
});