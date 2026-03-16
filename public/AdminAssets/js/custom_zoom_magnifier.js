// Product zoom magnifier JS

function zoom(e) {
  var zoomer = e.currentTarget;
  if (e.offsetX !== undefined) {
    offsetX = e.offsetX;
  } else if (e.touches && e.touches.length > 0) {
    offsetX = e.touches[0].pageX;
  }
  if (e.offsetY !== undefined) {
    offsetY = e.offsetY;
  } else if (e.touches && e.touches.length > 0) {
    offsetY = e.touches[0].pageX;
  }
  x = (offsetX / zoomer.offsetWidth) * 100;
  y = (offsetY / zoomer.offsetHeight) * 100;
  zoomer.style.backgroundPosition = x + "% " + y + "%";
}
