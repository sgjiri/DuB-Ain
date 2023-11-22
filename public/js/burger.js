const burger = document.querySelector('.container-burger');
let line = document.getElementsByClassName('burgerLigne');
let navMobil = document.getElementById('navigation-mobil');
burger.addEventListener('click', function () {
  for (let i = 0; i < line.length; i++) {
    line[i].classList.toggle('active');


  }
  navMobil.classList.toggle('active');
})