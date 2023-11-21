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

const burger = document.querySelector('.container-burger');
let line = document.getElementsByClassName('burgerLigne');
let navMobil = document.getElementById('navigation-mobil');

console.log(navMobil)
burger.addEventListener('click', function () {
  for (let i = 0; i < line.length; i++) {
    line[i].classList.toggle('active');


  }
  navMobil.classList.toggle('active');
})
