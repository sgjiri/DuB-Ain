function initializeGlider(selector, prevSelector, nextSelector) {
  new Glider(document.querySelector(selector), {
    slidesToShow: 1,
    draggable: true,
    dots: '#dots',
    arrows: {
      prev: prevSelector,
      next: nextSelector
    }
  });
}

initializeGlider('.glider', '.prev-slider-first', '.next-slider-first');
initializeGlider('.glider-second', '.prev-slider-second', '.next-slider-second');
initializeGlider('.glider-thirt', '.prev-slider-thirt', '.next-slider-thirt');
