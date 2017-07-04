(function($) {

    window.$ = jQuery;
    window.eiio = {
      cache: {
        responsive: false,
      },
      init: function() {

        $(window).bind('orientationchange resize', throttle(eiio.handleResize, 200)).resize();
        
        eiio.ready();

        if(!eiio.cache.responsive) {

        } else {

        };
          
      },

      handleResize: function() {

      },

      ready: function() {

            // slider del equipo
        var swiper = new Swiper('.swiper-container', {
            freeMode: true,
            slidesPerView: 'auto'
        });


            // desplegable textarea
        $('.mensaje textarea').focusin(function(){
            var $this = $(this);
            if($this.val().length) return;
            $(this).animate({height: 240}, 1000);
        }).focusout(function(){
            var $this = $(this);
            if($this.val().length) return;
            $(this).animate({height: 30}, 1000);
        });


            // menu
        $('.ham').click(function(){
            $('#menu .menu-right').stop(false, false).slideToggle();
            return false;
        });

                // menu sticky
        var sticky = new Waypoint.Sticky({
          element: $('#menu')[0]
        });


            // WAYPOINTS
        $('.blck').each(function(){

          new Waypoint({
            element: $(this),
            offset: 90,
            handler: function(direction) {

        // if(direction == 'down') console.log('down', $(this.element).attr('id'));
        // return;
              var $actSect = $(this.element);

                  // Oculta menu para evitar lios de colores
              if($('#menu').hasClass('shown')) $('#menu').removeClass('shown').find('.menu-right').stop(false, false).slideUp();
              

                  // Alterna CSS 
              if($actSect.hasClass('blck-light')){
                  $('#menu').addClass('menu-light');
              } else {
                  $('#menu').removeClass('menu-light');
              }

              var id = $actSect.attr('id');


                  // Activa enlace de la sección actual
              $('#menu')
                  .find('.act').removeClass('act').end()
                  .find('[href*=' + id + ']').addClass('act');


                      // anima títulos de sección
              if(!$actSect.hasClass('titleFx') && $actSect.find('.hd-l2').length) {
                  
                  $actSect.addClass('titleFx');

                  var $elm = $actSect.find('.hd-l2 span');
                  var $clon = $elm.clone();
                  
                  $clon
                      .appendTo($elm)
                      .wrap('<div class="hd-l2-wrap"></div>');

                  $actSect.find('.hd-l2-wrap')
                      .find('span').css('width', $elm.outerWidth()).end()
                      .css({width: 0}).animate({ width: $elm.outerWidth()}, 1000);
              }

            }

          });

        });

    }
  };

  eiio.init();


// http://www.paulirish.com/2011/requestanimationframe-for-smart-animating/
// shim layer with setTimeout fallback
window.requestAnimFrame = (function(){
  return  window.requestAnimationFrame       ||
          window.webkitRequestAnimationFrame ||
          window.mozRequestAnimationFrame    ||
          function( callback ){
            window.setTimeout(callback, 1000 / 60);
          };
})();

function throttle (callback, limit) {   // http://sampsonblog.com/749/simple-throttle-function modificado!
    var wait = false;                 // Initially, we're not waiting
    return function () {              // We return a throttled function
        if (!wait) {                  // If we're not waiting
                                       // Execute users function
            wait = true;              // Prevent future invocations
            setTimeout(function () {  // After a period of time
                callback.call();
                wait = false;         // And allow future invocations
            }, limit);
        }
    }
}



//      new Waypoint({
//        element: $(this),
//        offset: 'bottom-in-view',
//        handler: function(direction) { if(direction == 'up') console.log('up', $(this.element).attr('id'))
// return;
//          var $actSect = $(this.element);
            
//          if($actSect.hasClass('blck-light')){
//              $('#menu').addClass('menu-light');
//          } else {
//              $('#menu').removeClass('menu-light');
//          };

//          var id = $actSect.attr('id');

//          $('#menu')
//              .find('.act').removeClass('act').end()
//              .find('[href*=' + id + ']').addClass('act');

//        }
//      })  
//  });

})(jQuery);