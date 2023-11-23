new Glider(document.querySelector('.glider'), {
    slidesToShow: 3.2,
    draggable: true,
    dots: '#dots',
    arrows: {
      prev: '.glider-prev',
      next: '.glider-next'
    },
    responsive: [
        {
          // screens greater than >= 775px
          breakpoint: 1200,
          settings: {
            // Set to `auto` and provide item width to adjust to viewport
            slidesToShow: 3.2,

          }
        },{
          // screens greater than >= 1024px
          breakpoint: 900,
          settings: {
            slidesToShow: 2.2,
          }
        }
        ,{
            // screens greater than >= 1024px
            breakpoint: 640,
            settings: {
              slidesToShow: 1.2,
            }
          } ,{
            // screens greater than >= 1024px
            breakpoint: 300,
            settings: {
              slidesToShow: 1,
            }
          }
      ]
  });

  document.addEventListener("DOMContentLoaded", function () {
    const sections = document.querySelectorAll(".animated-section");
    
    sections.forEach(function (section) {
      const observer = new IntersectionObserver(
        function (entries, observer) {
          entries.forEach(function (entry) {
            if (entry.target === section && entry.isIntersecting) {
              let elementsRight = section.querySelectorAll(".animation-right");
              let elementsLeft = section.querySelectorAll(".animation-left");
              let cardElement = section.querySelectorAll(".oneValue");
  
              elementsRight.forEach(function (element, index) {
                element.style.animation = `slideInRigth 1s ${index * 0.3}s forwards`;
              });
  
              elementsLeft.forEach(function (element, index) {
                element.style.animation = `slideIn 1s 0.5s forwards`;
              });
              cardElement.forEach(function (element) {
                element.classList.add('active');
              });
  
              // Désactive l'observer après l'animation
              observer.disconnect();
            }
          });
        },
        {
          root: null,
          rootMargin: "0px",
          threshold: 0.6,
        }
      );
  
      observer.observe(section);
    });
  });