const gliderSliders = document.querySelectorAll('.glider');
const gliderPrevs = document.querySelectorAll('.glider-prev');
const gliderNexts = document.querySelectorAll('.glider-next');

for (let i = 0; i < gliderSliders.length; i++) {
  initializeGlider(gliderSliders[i], gliderPrevs[i], gliderNexts[i]);
}

function initializeGlider(slider, prev, next) {
  new Glider(slider, {
    slidesToShow: 1,
    draggable: true,
    dots: "#dots",
    arrows: {
      prev: prev,
      next: next,
    },
  });
}




// function initializeGlider(selector, prevSelector, nextSelector) {
//   new Glider(document.querySelector(selector), {
//     slidesToShow: 1,
//     draggable: true,
//     dots: '#dots',
//     arrows: {
//       prev: prevSelector,
//       next: nextSelector
//     }
//   });
// }

// initializeGlider('.glider', '.prev-slider-first', '.next-slider-first');
// initializeGlider('.glider-second', '.prev-slider-second', '.next-slider-second');
// initializeGlider('.glider-thirt', '.prev-slider-thirt', '.next-slider-thirt');
