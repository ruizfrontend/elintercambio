(function($) {

    window.$ = jQuery;

    $(function(){
        
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


    });


    var sticky = new Waypoint.Sticky({
      element: $('#menu')[0]
    });


        // WAYPOINTS
    $('.blck').each(function(){

        new Waypoint({
          element: $(this),
          offset: 90,
          handler: function(direction) { if(direction == 'down') console.log('down', $(this.element).attr('id'));
// return;
            var $actSect = $(this.element);

            $('#menu .menu-right').stop(false, false).slideUp();
            
            if($actSect.hasClass('blck-light')){
                $('#menu').addClass('menu-light');
            } else {
                $('#menu').removeClass('menu-light');
            }

            var id = $actSect.attr('id');


            $('#menu')
                .find('.act').removeClass('act').end()
                .find('[href*=' + id + ']').addClass('act');


                    // anima títulos de sección
            if(!$actSect.hasClass('titleFx') && $actSect.find('.hd-l2').length) {
                
                $actSect.addClass('titleFx');

                var $elm = $actSect.find('.hd-l2 span');
                var $clon = $elm.clone();
                console.log($elm.width());
                $clon
                    .appendTo($elm)
                    .wrap('<div class="hd-l2-wrap"></div>');

                $actSect.find('.hd-l2-wrap')
                    .find('span').css('width', $elm.outerWidth()).end()
                    .css({width: 0}).animate({ width: $elm.outerWidth()}, 1000);
            }

          }
        });

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
    });

})(jQuery);