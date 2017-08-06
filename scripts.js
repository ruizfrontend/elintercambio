// davidruizlopez.es @2017

(function($) {

    window.$ = jQuery;

    window.eiio = {
      cache: {
        window: null,
        wWidth: 0,
        wHeight: 0,
        teamSlider: null,
        projsSlider: null,
        firstLoad: true,
        responsive: false
      },

      init: function() {

        eiio.cache.window = $(window);
        eiio.cache.window.bind('orientationchange resize', throttle(eiio.handleResize, 100));
        eiio.cache.window.bind('scroll', eiio.handleScroll);

        eiio.handleResize(); // forzamos primer resize

          /** inicializaciones */
        eiio.initContactForm();
        eiio.initScroll();
        eiio.initMenu();
        eiio.initWaypoints();
        eiio.initProjs();
        eiio.initjQueries();

        Waypoint.refreshAll();

          // Inicialización concluida
        eiio.cache.firstLoad = false;
          
      },

      handleResize: function() {

        var newW = eiio.cache.window.width();
        if(newW == eiio.cache.wWidth) return; // evita resize con los cambio de tamaños de navegadores móviles

        eiio.cache.wWidth = eiio.cache.window.width();
        eiio.cache.wHeight = eiio.cache.window.height();

        eiio.cache.responsive = eiio.cache.wWidth < 800 ? true : false;

        eiio.resizeSlides();
        eiio.resizeProjs();
        eiio.resizeSlideTeam();

        eiio.canvas.update();
      },


      handleScroll: function() {

        eiio.canvas.scroll();
      },

      initjQueries: function() {

        $('#launch').click(function(){
          $("html, body").stop(false, false)
            .animate({ scrollTop: eiio.cache.wHeight * 0.9 }, 2000);
        });


            // elimina titulares animados en móvil
        if(eiio.cache.responsive) {
          $('.blck').addClass('titleFx');
          $('.hd-l2').addClass('hd-l2-marked');
        }

      },

      resizeSlides: function() {

            // resize sections
        $('#Intro, #que, #quienes, #whom, .slide-home, .canvas-wrap').each(function(){
          
          var $this = $(this).css('min-height', eiio.cache.wHeight);
          var h = $this.height();

          $this.find('.blck-inn').each(function(){
            var $this = $(this);
            var hIn = $this.height();
            $this.css('top', hIn < h ? (h - hIn) / 2 : 0);
          });

        });

          // el camvas hay que fijar el tamaño como attributo
        $('#homeCanvas').attr('height', eiio.cache.wHeight).attr('width', eiio.cache.wWidth);

        var $quienes = $('#quienes');
        if($quienes.find('.blck-inn').height() < eiio.cache.wHeight) {
          $quienes.addClass('quienes-bottom');
        } else {
          $quienes.removeClass('quienes-bottom');
        }

      },

      canvas: {
        cache: {
          $cv: null,
          cvctx: null,
          img1: null,
          img2: null,
          img3: null,
          ready: false,
          req: false,
          rH: null, // cache de tamaño real de la imagen pintada
          rW: null,
          dx: 0,
          dy: 0,
        },

        update: function() {
          eiio.canvas.cache.$cv = $('#homeCanvas');
          eiio.canvas.cache.cvctx = eiio.canvas.cache.$cv[0].getContext('2d');
          
          eiio.canvas.loadImg($('.slide-home-1').data('img'), 'img1');
          eiio.canvas.loadImg($('.slide-home-2').data('img'), 'img2');
          eiio.canvas.loadImg($('.slide-home-3').data('img'), 'img3');
          
          $('.slide-home').css('background', 'none');
        },

        scroll: function() {

          if(!eiio.canvas.cache.ready || eiio.canvas.cache.req) return;

          eiio.canvas.cache.req = true;
          requestAnimFrame(eiio.canvas.realScroll);

        },
        realScroll: function() {

          eiio.canvas.cache.req = null;

          var scr = eiio.cache.window.scrollTop() / eiio.cache.wHeight;

          if(scr > 0.1) $('#launch').fadeOut(400);

          if(scr > 4) return;

          eiio.canvas.cache.cvctx.putImageData(eiio.canvas.generaImg(scr), 0, 0);
        },

        generaImg: function(scr) {

          var pixels = scr < 1 ? eiio.canvas.cache.img1 : eiio.canvas.cache.img2;

          var target = eiio.canvas.cache.cvctx.createImageData(pixels.width, pixels.height);
          target.data.set(pixels.data);
          var h = target.height, w = target.width;

          // if(scr < 0.4) return target;

          if(scr < 0.3) { // paso 1: fadeIn del logo (sin lema)
            $('#queFix').filter('.shown').removeClass('shown').stop(false,false).hide();

            for (var i = 0; i < target.data.length; i += 4) {

              var currH = parseInt(i / (4 * w), 10);
              if(currH < ((eiio.canvas.cache.rH * 0.59) + eiio.canvas.cache.dy)) continue;
              
              target.data[i] = 53;
              target.data[i+1] = 54;
              target.data[i+2] = 57;
              target.data[i+3] = 255;
            }
          } else if(scr < 0.5) { // paso 2: fadeIn del lema
            $('#queFix').filter('.shown').removeClass('shown').stop(false,false).hide();

            for (var i = 0; i < target.data.length; i += 4) {

              var currH = parseInt(i / (4 * w), 10);
              if(currH < ((eiio.canvas.cache.rH * 0.59) + eiio.canvas.cache.dy)) continue;

              var fxPercent = (scr - 0.2) / 0.3;
              target.data[i+3] = 255 * fxPercent;
            }

          } else if(scr < 0.7) { // paso 3: roto
            $('#queFix').filter('.shown').removeClass('shown').stop(false,false).hide();

            for (var i = 0; i < target.data.length; i += 4) {

              var currH = parseInt(i / (4 * w), 10);
              if(currH > ((eiio.canvas.cache.rH * 0.59) + eiio.canvas.cache.dy) || currH < ((eiio.canvas.cache.rH * 0.524) + eiio.canvas.cache.dy)) continue;
              
              var currW = (i - (currH * 4 * w)) / 4;

              var fxPercent = (scr - 0.5) / 0.2;
              var desplaza = parseInt(fxPercent * 5);
              if(currW < desplaza) continue;

              target.data[i] = pixels.data[i - (desplaza * 4)];
              target.data[i+1] = pixels.data[i+1 - (desplaza * 4)];
              target.data[i+2] = pixels.data[i+1 - (desplaza * 4)];
              target.data[i+3] = pixels.data[i+1 - (desplaza * 4)];
            }

          } else if(scr < 1) { // paso 3: plano fijo
            $('#queFix').filter('.shown').removeClass('shown').stop(false,false).hide();

            for (var i = 0; i < target.data.length; i += 4) {

              var currH = parseInt(i / (4 * w), 10);
              if(currH > ((eiio.canvas.cache.rH * 0.59) + eiio.canvas.cache.dy) || currH < ((eiio.canvas.cache.rH * 0.524) + eiio.canvas.cache.dy)) continue;
              
              var currW = (i - (currH * 4 * w)) / 4;

              var desplaza = 5;
              if(currW < desplaza) continue;

              target.data[i] = pixels.data[i - (desplaza * 4)];
              target.data[i+1] = pixels.data[i+1 - (desplaza * 4)];
              target.data[i+2] = pixels.data[i+1 - (desplaza * 4)];
              target.data[i+3] = pixels.data[i+1 - (desplaza * 4)];
            }

          } else if(scr < 1.1) { // paso 4: máquina fade
            $('#queFix').filter('.shown').removeClass('shown').stop(false,false).hide();

            for (var i = 0; i < target.data.length; i += 4) {

              var fxPercent = (scr - 1) / 0.08;

              target.data[i+3] = 255 * fxPercent;
            }

          } else if(scr < 1.3) { // paso 5: máquina fija
            $('#queFix').filter('.shown').removeClass('shown').stop(false,false).hide();

            for (var i = 0; i < target.data.length; i += 4) {

              var fxPercent = (scr - 1) / 0.08;

              target.data[i+3] = 255 * fxPercent;
            }

          } else if(scr < 2){ // paso 6: cortinilla de estrella

            $('#queFix').filter('.shown').removeClass('shown').stop(false,false).hide();

            var target2 = eiio.canvas.cache.cvctx.createImageData(eiio.canvas.cache.img3.width, eiio.canvas.cache.img3.height);
            target2.data.set(eiio.canvas.cache.img3.data);

            var maxOpen = eiio.canvas.cache.img3.height / 2;
            var p0 = (eiio.canvas.cache.img3.height / 2) + (eiio.canvas.cache.img3.height / 12);
            var p100 = (eiio.canvas.cache.img3.height / 2) - (eiio.canvas.cache.img3.height / 12);
            var pendiente = (p0 - p100) / eiio.canvas.cache.img3.width;

            for (var i = 0; i < target.data.length; i += 4) {

              var fxPercent = (scr - 1.1) / 0.9;

              var currH = parseInt(i / (4 * w), 10);
              var currW = (i - (currH * 4 * w)) / 4;

              if(currH < p0 - (currW * pendiente) + (fxPercent * maxOpen) && currH > p0 - (currW * pendiente) - (fxPercent * maxOpen)) {

                target.data[i] = target2.data[i];
                target.data[i+1] = target2.data[i+1];
                target.data[i+2] = target2.data[i+2];
                target.data[i+3] = target2.data[i+3];
              }

            }
          // } else if(scr < 3) {
          } else {
            $('#queFix').filter(':not(".shown")').addClass('shown').stop(false,false).fadeIn(1200).each(function(){
              var $this = $(this).find('.blck-inn');
              var hIn = $this.height();
              $this.css('top', hIn < eiio.cache.wHeight ? (eiio.cache.wHeight - hIn) / 2 : 0);

                      // anima títulos de sección
              if(!$this.hasClass('titleFx') && $this.find('.hd-l2').length) {
                  
                  $this.addClass('titleFx');

                  var $elm = $this.find('.hd-l2 span');
                  var $clon = $elm.clone();
                  
                  $clon
                      .appendTo($elm)
                      .wrap('<div class="hd-l2-wrap"></div>');

                  $this.find('.hd-l2-wrap')
                      .find('span').css('width', $elm.outerWidth()).end()
                      .css({width: 0}).animate({ width: $elm.outerWidth()}, 1000);
              }
            });

            var target2 = eiio.canvas.cache.cvctx.createImageData(eiio.canvas.cache.img3.width, eiio.canvas.cache.img3.height);
            target2.data.set(eiio.canvas.cache.img3.data);

            for (var i = 0; i < target2.data.length; i += 4) {

              var fxPercent = (scr - 2) * 3; // solo fx al 33% inicial de la imagen
              fxPercent = fxPercent > 1 ? 1 : fxPercent;

              target2.data[i+3] = target2.data[i+3] * (1 - (fxPercent * 0.8));

            }

            return target2;
          }


          return target;

        },

        loadImg: function(url, img) {

          var $img = $('<img class="tmpFoto">').load(function(){

            var imgH = $img[0].height;
            var imgW = $img[0].width;

            var pWin = eiio.cache.wWidth / eiio.cache.wHeight;
            var pImg = imgW / imgH;

            if(pWin < pImg) {
              eiio.canvas.cache.rH = eiio.cache.wHeight;
              eiio.canvas.cache.rW = eiio.cache.wHeight * imgW / imgH;
              eiio.canvas.cache.dy = 0;
              eiio.canvas.cache.dx = -1 * (eiio.canvas.cache.rW - eiio.cache.wWidth) / 2;
            } else {
              eiio.canvas.cache.rW = eiio.cache.wWidth;
              eiio.canvas.cache.rH = eiio.cache.wWidth * imgH / imgW;
              eiio.canvas.cache.dx = 0;
              eiio.canvas.cache.dy = -1 * (eiio.canvas.cache.rH - eiio.cache.wHeight) / 2;
            }

            eiio.canvas.cache.cvctx
              .drawImage(this, 0, 0, imgW, imgH, eiio.canvas.cache.dx, eiio.canvas.cache.dy, eiio.canvas.cache.rW, eiio.canvas.cache.rH);

            baseImgData = eiio.canvas.cache.cvctx.getImageData(0, 0, eiio.cache.wWidth, eiio.cache.wHeight);

            eiio.canvas.cache[img] = baseImgData;

            setTimeout(function() {

              if(eiio.canvas.cache.ready) return;
              if(eiio.canvas.cache.img1 && eiio.canvas.cache.img2 && eiio.canvas.cache.img3) {

                eiio.canvas.cache.ready = true;

                $('.canvas-wrap').animate({'opacity': 1}, 600);

                eiio.canvas.scroll();
              }
            }, 0);

          });

          $img.attr('src', url);

        },
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

      scrollTo: function(elm, time) {
        var $target = $(elm);

        if(!$target.length) {
          console.log('no se encontró el target');
          return false;
        }

        eiio.foldMenu();

        $("html, body").stop(false, false)
          .animate({ scrollTop: $target.offset().top + 1 }, time ? time : 500);

        // setTimeout(function(){ eiio.updateSect($target); }, 100);

      },
      enableSect: function($actSect) {

              // Oculta menu para evitar lios de colores
          eiio.foldMenu();

          $('#menu').removeClass('hidden');
          setTimeout(function(){ $('#menu').addClass('hidden'); }, 1200);
          

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

        // inicializa los efectos del slide de proyectos (el carrusel de thumbs va en resizeProjs)
      initProjs: function() {

        var $act = $('.bl-proy-elm.act');
        var semaforo = false;

          // carrusel de proyectos
        $('.bl-proy-thumb')
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

        // lanza el carrusel de thumbs de proyectos o lo destruye en función del tamaño de página
      resizeProjs: function() {

        var $thumbs = $('#portfolio .bl-proy-thumb');

        if(eiio.cache.wWidth > 1200) {
          $thumbs.width(Math.floor(eiio.cache.wWidth / 3));
        } else if(eiio.cache.wWidth > 800) {
          $thumbs.width(Math.floor(eiio.cache.wWidth / 2));
        } else {
          $thumbs.width(eiio.cache.wWidth);
        }

          // los elementos ocupan más que la pantalla => lanza el slide
        if($thumbs.length * $thumbs.eq(0).width() > eiio.cache.wWidth) {
              // inicia slider
          if(!eiio.cache.projsSlider) {

            $('.bl-proy-wrap').width(10000);
            
            eiio.cache.projsSlider = new Swiper('.bl-proy-thumbs', {
                freeMode: true,
                slidesPerView: 'auto',
                nextButton: '#portfolio .swiper-button-next',
                prevButton: '#portfolio .swiper-button-prev',
                setWrapperSize: false
            });
          }

          eiio.cache.projsSlider.update();

            // sobre espacio => borra slide y centra!
        } else {

          if(eiio.cache.projsSlider) {
            
            $('.bl-proy-wrap').width($thumbs.length * $thumbs.eq(0).width() );

            eiio.cache.projsSlider.destroy(true, true);
            eiio.cache.projsSlider = null;
          }
        }
        setTimeout(function(){

            $('.bl-proy-wrap').width($thumbs.length * $thumbs.eq(0).width() );
          }, 400);

      },

        // lanza el carrusel de equipo o lo destruye en función del tamaño de página
      resizeSlideTeam: function() {

        var $people = $('.bl-quienes-elm');
console.log($people.length * 300, $people.length )
          // los elementos ocupan más que la pantalla => lanza el slide
        if($people.length * 300 > eiio.cache.wWidth) {
          
          if(!eiio.cache.teamSlider) {
            $('.swiper-wrapper').width('100%');
            eiio.cache.teamSlider = new Swiper('.bl-quienes', {
                freeMode: true,
                slidesPerView: 'auto',
                nextButton: '#quienes .swiper-button-next',
                prevButton: '#quienes .swiper-button-prev',
            });
            $('.bl-quienes').removeClass('bl-quienes-centered');
          }

        } else {

          if(eiio.cache.teamSlider || eiio.cache.firstLoad) {
            $('.swiper-wrapper').width(10000);
            if(eiio.cache.teamSlider) eiio.cache.teamSlider.destroy(true, true);
            eiio.cache.teamSlider = null;
            $('.bl-quienes').addClass('bl-quienes-centered');
          }

        }

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

              // canvas fixed
        new Waypoint({
          element: $('#Intro'),
          offset: 'bottom-in-view',
          handler: function(direction) {

            if(direction == 'down')
              $('.canvas-wrap').addClass('normal');
            else
              $('.canvas-wrap').removeClass('normal');
            
          }

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

function throttle(callback, limit) {   // http://sampsonblog.com/749/simple-throttle-function modificado!
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
    };
}


})(jQuery);