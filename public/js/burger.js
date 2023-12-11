const burger = document.querySelector('.container-burger');
let line = document.getElementsByClassName('burgerLigne');
let navMobil = document.getElementById('navigation-mobil');
burger.addEventListener('click', function () {
  for (let i = 0; i < line.length; i++) {
    line[i].classList.toggle('active');


  }
  navMobil.classList.toggle('active');
})


document.addEventListener("DOMContentLoaded", function () {
  const sections = document.querySelectorAll(".animated-section");
  
  sections.forEach(function (section) {
    const observer = new IntersectionObserver(
      function (entries, observer) {
        entries.forEach(function (entry) {
          console.log(entries);
          if (entry.target === section && entry.isIntersecting) {
            let elementsRight = section.querySelectorAll(".animation-right");
            let elementsLeft = section.querySelectorAll(".animation-left");
            let cardElement = section.querySelectorAll(".oneValue");

            elementsRight.forEach(function (element, index) {
              element.style.animation = `slideInRigth 1s ${index * 0.3}s forwards`;
            });

            elementsLeft.forEach(function (element) {
              element.style.animation = `slideIn 1s 0.5s forwards`;
            });
            cardElement.forEach(function (element) {
              element.classList.add('active');
            });
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