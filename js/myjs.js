function configToggleAnimation() {
    var toggle = document.querySelector('.nav-toggle'),
      nav = document.querySelector('.nav'),
      snap = Snap(document.querySelector('.nav-morph svg')),
      nav_morph = document.querySelector('.nav-morph'),
      path = snap.select('path'),
      reset = path.attr('d'),
      open = nav_morph.getAttribute('data-open'),
      close = nav_morph.getAttribute('data-close'),
      speed = 250,
      speed_back = 800,
      easing = mina.easeinout,
      easing_back = mina.elastic,
      isOpen = false;
 
    toggle.addEventListener('click', function() {
      // si ouvert on ferme
      if (isOpen) {
        path.stop().animate({
          'path': close
        }, speed, easing, function() {
          path.animate({
            'path': reset
          }, speed_back, easing_back);
          isOpen = false;
        });
        nav.classList.remove('nav--open');
      } else {
 
        path.stop().animate({
          'path': open
        }, speed, easing, function() {
          path.animate({
            'path': reset
          }, speed_back, easing_back);
          isOpen = true;
        });
        nav.classList.add('nav--open');
      }
    });
 
  }
 
  function initialize() {
    configToggleAnimation();
  }
 
  document.addEventListener('DOMContentLoaded', initialize);