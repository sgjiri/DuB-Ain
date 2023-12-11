const gliderSliders = document.querySelectorAll(".glider");
const gliderPrevs = document.querySelectorAll(".glider-prev");
const gliderNexts = document.querySelectorAll(".glider-next");

for (let i = 0; i < gliderSliders.length; i++) {
  initializeGlider(gliderSliders[i], gliderPrevs[i], gliderNexts[i]);
}

function initializeGlider(slider, prev, next) {
  new Glider(slider, {
    slidesToShow: 1,
    dots: "#dots",
    arrows: {
      prev: prev,
      next: next,
    },
  });
}

const point = document.querySelectorAll(".point");
const closeSlider = document.querySelectorAll(".closeSlider");

for (let i = 0; i < point.length; i++) {
  (function (index) {
    const gliderInstance = new Glider(gliderSliders[index], {
      slidesToShow: 1,
      dots: "#dots",
      arrows: {
        prev: gliderPrevs[index],
        next: gliderNexts[index],
      },
    });

    gliderSliders[index].addEventListener("click", function () {
      point[index].classList.add("active");
      gliderInstance.init(true);
    });
    
    console.log(closeSlider[index]);
    closeSlider[index].addEventListener("click", function () {
        point[index].classList.remove("active");
     });
    
  })(i);
}

