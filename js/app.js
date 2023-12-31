jQuery(function($) {
    open_stuff();
    fixed_header();
    slick_sliders();
    dynamic_form();
    collapse();
    my_lightbox();
    defer_video();
    scroll_animation();
    smooth_scroll();

    function smooth_scroll() {
      document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            //  e.preventDefault();
            //  document.querySelector(this.getAttribute('href')).scrollIntoView({
            //      behavior: 'smooth'
            //  });

            e.preventDefault();
            const target = $(this.getAttribute('href'));
            const duration = 300; // Durée maximale en millisecondes

            if (target.length) {
              $('html, body').animate({
                scrollTop: target.offset().top
              }, duration);
            }
        });
      });
    }

    function scroll_animation() {

      var tablet_breakpoint = '1200px';
      var viewport_portion = window.matchMedia('(max-width: '+ tablet_breakpoint +')').matches ? 0.1 : 0.5;

      const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            entry.target.classList.remove('hidden-animate');
          } 
        });
      }, {
        threshold: viewport_portion
      });
      
      const hidden_elements = document.querySelectorAll('.hidden-animate');
      hidden_elements.forEach((el) => observer.observe(el));
      
    }

    function defer_video() {
      var video = $('.heading--productType .video.defer'); 
      var source = video.find('source');
      var video_url = source.attr('data-src');
      
      if (video.length) { 
        $.get(video_url, function(data) {
          source.attr('src', video_url);
          video[0].load();
          $('.heading--productType .heading-bg').removeClass('loading');
        });
      }
    }

    function my_lightbox() {
      lightbox.option({
        'resizeDuration': 200,
        'fadeDuration': 200,
        'fitImagesInViewport': true,
      });
    }

    function dynamic_form() {
      $('.wpforms-field textarea, .wpforms-field input, .wpforms-field select').on('focus blur', function(event) {
        if (event.type === 'focus') {
          $(this).parent().addClass('js-focus');
        } else if (event.type === 'blur') {
          $(this).parent().removeClass('js-focus');
        }
      });

      if($('.section_contact-form').attr('data-form')) {
        let target = $('.section_contact-form').attr('data-form');
        let select_input = $('.wpforms-container select option[value="' + target + '"]').parent();
        select_input.val(target);
      }

      $('.btn-lg[data-form]').on('click', function() {

        let target = $(this).attr('data-form');

        if($('.wpforms-container select option[value="' + target + '"]').length) { 
          setTimeout(() => {
            let select_input = $('.wpforms-container select option[value="' + target + '"]').parent();
            select_input.addClass('dynamic-selection');
            select_input.val(target);            
          }, 300);

          select_input.on('animationend', function() {
            select_input.removeClass('dynamic-selection');
          });
        }

      });
    }

    function collapse() {
      $('.collapseList .collapseList-item .collapseList-item-header').on('click', function(event) {
        let target = $(this).parent();
        let content = target.find('.collapseList-item-body');
    
        let previous_collapse = $('.collapseList-item.open');
        
        if (target.is(previous_collapse)) {
          previous_collapse.removeClass('open');
          previous_collapse.find('.collapseList-item-body').slideUp();
          previous_collapse.find('.collapseList-item-body').attr('aria-hidden', 'true');
          
          return;
        }
        
        previous_collapse.removeClass('open');
        previous_collapse.find('.collapseList-item-body').slideUp();
        previous_collapse.find('.collapseList-item-body').attr('aria-hidden', 'true');
        
        target.addClass('open');
        content.slideDown();
        content.attr('aria-hidden', 'false');
    });
    
    
    }

    function rand(min, max) {
      return Math.floor(Math.random() * (max - min + 1) + min)
    }

    function fixed_header() {
      $(window).scroll(function (event) {
        var scroll = $(window).scrollTop();
        if (scroll > $('header').height()) {
          $('body').addClass('scrolled');
        }else{
          $('body').removeClass('scrolled');
        }
      });
    }
    
    function open_stuff() {

      $('.js--preventDefault').on('click', function(event) {
        event.preventDefault();
      })

      $('.js--open').on('click', function() {
        $('body').addClass($(this).attr('data-open') + "--open");
      })
    
      $('.js--close').on('click', function() {
        $('body').removeClass($(this).attr('data-close') + "--open");
      })
    
      $('.js--toggle').on('click', function() {
        $('body').toggleClass($(this).attr('data-toggle') + "--open");
      })


      // Section video
      $('.section_video .js--openVideo').on('click', function() {

        let section = $(this).parent().parent().parent();

        section.addClass('video--open');
        
        if (section.find('video').length) {
          section.find('video.video source').attr('src', section.find('video.video source').attr('data-src'));
          section.find('video.video')[0].load();
        }else {
          section.find('iframe.video').attr('src', section.find('iframe.video').attr('data-src'));
        }

      });
    }

    function slick_sliders() {

      var tablet_breakpoint = '1200px';
      
      var var_height = window.matchMedia('(max-width: '+ tablet_breakpoint +')').matches ? true : false;
      var prevArrowHtml = '<button type="button" class="slick-prev"><svg width="18" height="14" viewBox="0 0 18 14" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M17 7H1M1 7L7 13M1 7L7 1" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></button>';
      var nextArrowHtml = '<button type="button" class="slick-next"><svg width="18" height="14" viewBox="0 0 18 14" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 7H17M17 7L11 1M17 7L11 13" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></button>';


      var default_slider = {
        prevArrow : false, 
        nextArrow : false, 
        dots : true,
        infinite : false,
        adaptiveHeight : var_height,
      };


      if ($('.heading-fp-slider').length) { $('.heading-fp-slider').slick( default_slider ); }
      if ($('.projects_slider').length) { $('.projects_slider').slick( default_slider ); }
      if (window.matchMedia('(max-width: '+ tablet_breakpoint +')').matches && $('.list-md, .list-lg').length) {
        $('.list-md, .list-lg').slick( 
          {
            prevArrow : prevArrowHtml, 
            nextArrow : nextArrowHtml, 
            dots : true,
            infinite : false,
            adaptiveHeight : var_height,
          }
        );
      }

      if ($('.section_suBtax-slider').length) { 
        $('.section_suBtax-slider').slick( {
          dots: true,
          infinite: false,
          speed: 300,
          slidesToShow: 3,
          slidesToScroll: 3,
          prevArrow : prevArrowHtml, 
          nextArrow : nextArrowHtml, 
          responsive: [
            {
              breakpoint: 1024,
              settings: {
                slidesToShow: 2,
                slidesToScroll: 2,
                infinite: true,
                dots: true
              }
            },
            {
              breakpoint: 780,
              settings: {
                slidesToShow: 1,
                slidesToScroll: 1
              }
            }
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
          ]
         }); 
      }

    }

    
});