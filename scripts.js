(function($) {

    window.$ = jQuery;
    window.eiio = {
      cache: {
        responsive: false,
        window: null,
        sliderTeam: null,
        sliderProjs: null
      },
      init: function() {

        eiio.cache.window = $(window);
        eiio.cache.window.bind('orientationchange resize', throttle(eiio.handleResize, 200)).resize();
        
        eiio.ready();

        if(!eiio.cache.responsive) {

        } else {

        }
          
      },

      ready: function() {

        eiio.initContactForm();
        eiio.initScroll();
        eiio.initMenu();
        eiio.initWaypoints();
        eiio.initSlideProjs();
        eiio.initSlideTeam();

      },

      handleResize: function() {

            // resize sections
        $('#Intro, #que, #quienes, #whom').each(function(){
          
          var $this = $(this).css('min-height', eiio.cache.window.height());
          var h = $this.height();
          

          $this.find('.blck-inn').each(function(){
            var $this = $(this);
            var hIn = $this.height();
            $this.css('top', hIn < h ? (h - hIn) / 2 : 0);
          });

        });

          // refresh carousels
          

        Waypoint.refreshAll();

      },

      form: {
        setTarget: function (name) {

            // hidden field
          $('#wpcf7-f70-o1 input[name="target"]').val(name);
            
            // draw tag
          $target = $('#wpcf7-f70-o1').find('.target');
          if(!$target.length) {
            $('#wpcf7-f70-o1').prepend('<div class="target">Envío para: <span>' + name + '</span><i class="fa fa-times" aria-hidden="true"></i></target>');
          } else {
            $target.find('span').text(name);
          }

        },
      },

      foldMenu: function() {

          if($('#menu').hasClass('shown')) $('#menu').removeClass('shown').find('.menu-right').stop(false, false).slideUp();
      },

      scrollTo: function(elm) {
        var $target = $(elm);

        if(!$target.length) {
          console.log('no se encontró el target');
          return false;
        }

        eiio.foldMenu();

        $("html, body").stop(false, false)
          .animate({ scrollTop: $target.offset().top + 1 }, 500);

        // setTimeout(function(){ eiio.updateSect($target); }, 100);

      },
      enableSect: function($actSect) {

              // Oculta menu para evitar lios de colores
          eiio.foldMenu();
          

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

      },

      initContactForm: function() {

            // target del mail
        $('.bl-quienes-elm .bl-quienes-img').click(function(){
          eiio.form.setTarget($(this).siblings('.bl-quienes-main').find('h4').text());
          eiio.scrollTo('#contacto');
        });

        $('.bl-quienes-elm .follow-contact').click(function(){
          eiio.form.setTarget($(this).parents('.bl-quienes-main').find('h4').text());
          eiio.scrollTo('#contacto');
          return false;
        });

        $('#wpcf7-f70-o1').delegate('.target', 'click', function(){
          $(this).remove();
          $('#wpcf7-f70-o1 input[name="target"]').val('');
        });


            // formulario
        $('.mensaje textarea').focusin(function(){
            var $this = $(this);
            if($this.val().length) return;
            $(this).animate({height: 240}, 1000);
        }).focusout(function(){
            var $this = $(this);
            if($this.val().length) return;
            $(this).animate({height: 30}, 1000);
        });

      },

      initScroll: function() {

            // scrool internos
        $('body').delegate('a[href^="#"]', 'click', function(){
          eiio.scrollTo($(this).attr('href'));
          return false;
        });
      },

      initSlideProjs: function() {

        var $act = $('.bl-proy-elm.act');
        var semaforo = false;

          // carrusel de proyectos
        $('.bl-proy-thumb')
          .hover(function(){

          }, function(){

          })
          .click(function(){
            
            if(semaforo) return;

            var $target = $('.bl-proy-elm:eq(' + $(this).index() + ')');
            
            if($target.hasClass('act')) return;

            semaforo = true;

            $('.bl-proy-thumb.act').removeClass('act');
            $('.bl-proy-thumb:eq(' + $(this).index() + ')').addClass('act');

            $target.addClass('act');
            $act.addClass('fade');

            eiio.scrollTo('.bl-proy-main');

            setTimeout(function(){
              $act.removeClass('fade act');
              $act = $target;

              semaforo = false;

            }, 1000);
          });



      },
      initSlideTeam: function() {

            // slider del equipo
        var swiperTeam = new Swiper('.swiper-container', {
            freeMode: true,
            slidesPerView: 'auto'
        });
      },

      initMenu: function() {

            // menu
        $('.ham').click(function(){

            if($('#menu').hasClass('shown')) {
              $('#menu').removeClass('shown').find('.menu-right').stop(false, false).slideUp();
            } else {
              $('#menu').addClass('shown').find('.menu-right').stop(false, false).slideDown();
            }

            return false;
        });
      },

      initWaypoints: function() {

                // menu sticky
        var sticky = new Waypoint.Sticky({
          element: $('#menu')[0]
        });


            // WAYPOINTS
        $('.blck').each(function(){

          new Waypoint({
            element: $(this),
            offset: 0,
            handler: function(direction) {

        // if(direction == 'down') console.log('down', $(this.element).attr('id'));
        // return;

              eiio.enableSect($(this.element));

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