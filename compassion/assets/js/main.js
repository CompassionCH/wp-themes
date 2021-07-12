jQuery(document).ready(function($) {

  /*
  * Slick-Carousel
  */
  $('.slick-carousel:not(.slick-initialized)').each(function(carousel) {
    var carousel = $(this);

    var slidesToShow = parseInt(carousel.attr('data-slickSlides'));
    var slidesToScroll = parseInt(carousel.attr('data-slickScroll'));
    var slickArrowsAttr = carousel.attr('data-slickArrows');
    var slickDotsAttr = carousel.attr('data-slickDots');
    var slickResponsiveAttr = carousel.attr('data-slickResponsive');

    var slickArrows = false;
    if( slickArrowsAttr == 'true' ) {
      slickArrows = true;
    }

    var slickDots = false;
    if( slickDotsAttr == 'true' ) {
      slickDots = true;
    }

    var slickResponsive = null;
    if( slickResponsiveAttr == 'true' ) {
      slickResponsive = [
        {
          breakpoint: 780,
          settings: {
            slidesToShow: 2
          }
        },
        {
          breakpoint: 600,
          settings: {
            slidesToShow: 1
          }
        }
      ];
    }

    carousel.slick({
      slidesToShow: slidesToShow,
      slidesToScroll: slidesToScroll,
      arrows: slickArrows,
      dots: slickDots,
      nextArrow: '<button class="slick-arrow slick-next"></button>',
      prevArrow: '<button class="slick-arrow slick-prev"></button>',
      responsive: slickResponsive
    });
  });

  /*
  * Off-Canvas-Toggle
  */
  $('.off-canvas-toggle').click(function() {
    $('body').toggleClass('open-off-canvas');
    $('.off-canvas-menu .open-sub-menu').removeClass('open-sub-menu');
    stickyElement();

    return false;
  });

  /*
  * Sub-Menu toggle
  */
  $('.off-canvas-menu .menu > li.menu-item-has-children > a').click(function() {
    $('.off-canvas-menu .open-sub-menu').removeClass('open-sub-menu');
    $(this).parent().toggleClass('open-sub-menu');
    stickyElement();

    return false;
  });

  /*
  * Off-Canvas Bottom-Content
  */
  function stickyElement() {
    var bottom_content = $('.off-canvas-menu .bottom-content'),
        window_height = $(window).height(),
        off_canvas_content = $('.off-canvas-menu .content'),
        off_canvas_menu = $('.off-canvas-menu'),
        padding = 100;

    if(off_canvas_content.height() + padding > window_height - bottom_content.height()) {
      off_canvas_menu.addClass('not-fixed');
    } else {
      off_canvas_menu.removeClass('not-fixed');
    }
  }
  stickyElement();
  $(window).resize(stickyElement);

  /*
  * Scroll to top
  */
  
  $(".scroll-to-top").click(function() {
    $('html, body').animate({
        scrollTop: 0 }, 600);
  });

/*
  $(".scroll-down").click(function() {
    $('html, body').animate({
        scrollTop: 300
    }, 200);
    return false;
  });
*/

  /*
  * Scroll-Detect
  */
  $(window).scroll(function(){
    var currentScreenPosition  = $(document).scrollTop();
    if (currentScreenPosition > 200) {
      $('body').addClass('scrolled');
    } else {
      $('body').removeClass('scrolled');
    }
  });

  /*
   * Close video lightbox
   */
  $('body').on('click', '.design1 .wmpci-popup-body .button', function() {
    $('.wmpci-popup-wrp iframe').remove();
  });

  /*
  * no-click links
  */
  $('.no-click > a').click(function() {
    return false;
  });

  /*
  * parallax-slider
  */
  $('.slick-style-head .slide').mousemove(function(e){
    var amountMovedX = (e.pageX * -1 / 300);
    var amountMovedY = (e.pageY * -1 / 300);
    $(this).find('.slide-image').css('-webkit-transform', '-webkit-translate(' + amountMovedX + 'px ' + ',' + amountMovedY + 'px)');
    $(this).find('.slide-image').css('-moz-transform', '-moz-translate(' + amountMovedX + 'px ' + ',' + amountMovedY + 'px)');
    $(this).find('.slide-image').css('transform', 'translate(' + amountMovedX + 'px ' + ',' + amountMovedY + 'px)');
  });

  /*
  * Masonry
  */
  $('.widget_siteorigin-panels-postloop').masonry({
    itemSelector: '.blog-teaser'
  });

  /*
  * Toggle footer columns
  */
  $('footer .menu > li.menu-item-has-children > a').click(function() {
    var parent = $(this).parent();

    parent.find('.sub-menu').toggleClass('open');

    return false;
  });

  /*
  * Toggle Random Child
  */
  $('body').on('click', '.random-child-toggle', function() {
    var element = $(this).parents('.random-child-wrapper');

    element.toggleClass('closed');

    return false;
  });



  /*hide random child*/


// $(function() {
// 	$(window).scroll(function() {
// 		var scroll = $(window).scrollTop();
// 		var width = $(window).width();
// 		if (scroll >= 200) {
// 			if (width <= 1024 && width > 970) {
// 				$('.random-child-wrapper').hide();
// 			}
// 	 	} else {
// 		 	if (width > 970) {
// 				$('.random-child-wrapper').show();
// 		 	}
// 	 	}
//  	});
// });



 
  /*
  * Toggle infowindows on world-map
  */
  $('body').on('click', '.world-map .marker', function() {
    if( ! $(this).hasClass('active') ) {
      $('.world-map .marker.active').removeClass('active');
      $(this).toggleClass('active');
    }
  });

  $(document).mouseup(function (e) {
    var container = $(".marker.active");

    if (!container.is(e.target) // if the target of the click isn't the container...
        && container.has(e.target).length === 0) // ... nor a descendant of the container
    {
        container.removeClass('active');
    }
  });

  /*
  * Open accordion-tab on world map click
  */
  $('body').on('click', '.world-map .marker a', function() {
    var id = $(this).attr('href');

    $('.world-map .accordion-content.active, .world-map .is-active .accordion-content').removeClass('active').hide();

    $(id).addClass('active').show();

    $('html, body').animate({
        scrollTop: $(id).offset().top - 50
    }, 500);

    return false;
  });

  /*
  * Close world-map accordion-tab
  */
  $('body').on('click', '.world-map .accordion-content .close', function() {
    $(this).parent().removeClass('active').hide();
    $('.marker.active').removeClass('active');

    $('html, body').animate({
        scrollTop: $('.world-map').offset().top - 150
    }, 500);

    return false;
  });

  /*
  * Ajax: load more posts
  */
  $('body').on('click', '.button-load-more', function() {
    var button = $(this);
    var paged = parseInt(button.attr('data-paged'));
    var maxPages = parseInt(button.attr('data-maxPages'));
    var query = button.data('query');

    $(this).attr('disabled', true);

    var request = $.ajax({
      url: main_js_data.ajaxurl,
      data: { action: 'compassion_ajax_query', paged: paged, query: query },
      method: 'GET',
      dataType: 'html'
    });

    request.done(function(data) {

      $('.posts-container').append(data);
      var elem = new Foundation.Equalizer($('.posts-container'));
      elem.applyHeight();         // Foundation 6

      if( paged == maxPages ) {
        button.fadeOut(300, function() {
          $(this).remove();
        });
      } else {
        button.removeClass('loading');
        button.attr('data-paged', paged+1);
      }

      button.attr('disabled', false);

    });

    return false;
  });

  /*
  * Automatically submit form on submit change
  */
  $('form.submit-on-select select').change(function() {
    $(this).parents('form').submit();
  });

  /*
  * Open modal on downloads page
  */
  $('body').on('submit', '.download-teaser-form', function() {
    $('#download-order-modal').foundation('open');

    return false;
  });

  /*
  * Download-Select
  */
  $('body').on('change', 'select.input-field', function() {
    var value = $(this).val();
    var target = $(this).data('href');

    $(target).val(value);

    return false;
  });

  /*
  * Datepicker
  */
/*
  $('.datepicker').pikaday({
    firstDay: 1,
    format: 'DD.MM.YYYY',
    i18n: {
      previousMonth : 'Vorheriger Monat',
      nextMonth     : 'Nächster Monat',
      months        : ['Januar','Februar','März','April','Mai','Juni','Juli','August','September','Oktober','November','Dezember'],
      weekdays      : ['Sonntag','Montag','Dienstag','Mittwoch','Donnerstag','Freitag','Samstag'],
      weekdaysShort : ['So','Mo','Di','Mi','Do','Fr','Sa']
  }
  });
*/

  /*
  Child Map
   */
  if($('#child-map').length > 0) {
    map = new google.maps.Map(document.getElementById('child-map'), {
      center: {lat: $('#child-map').data('lat'), lng: $('#child-map').data('lng')},
      scrollwheel: false,
      zoom: 5
    });

    var marker = new google.maps.Marker({
      position: {lat: $('#child-map').data('lat'), lng: $('#child-map').data('lng')},
      map: map,
      title: $('#child-map').data('title'),
      icon: $('#child-map').data('icon')
    });
  }

  /*
   * iCheck
   */
  $('input').iCheck({
    checkboxClass: 'icheckbox_flat-aero',
    radioClass: 'iradio_flat-aero'
  });

});

/*
*load external link in new window
*/
/** 
 * Open all external links in a new window
 */
jQuery(document).ready(function($) {
    $('a').not('[href*="mailto:"]').each(function () {
		var isInternalLink = new RegExp('/' + window.location.host + '/');
		if ( ! isInternalLink.test(this.href) ) {
			$(this).attr('target', '_blank');
		}
	});
});

/*load script for siteorigin slideshow button CSP*/

	jQuery(function() {
		jQuery('.slider_buttons').find('a').click(function() {
			var index_to_go = jQuery(this).attr('data-index-to-go');
			var parent_with_index = this.parentNode;
			while (!parent_with_index.hasAttribute('data-index')) {
				parent_with_index = parent_with_index.parentNode;
			}
			var slider = jQuery(parent_with_index).next();
			slider.find('.sow-slider-pagination').find('a').each(function() {
				if (jQuery(this).attr('data-goto') == index_to_go) {
					jQuery(this).trigger('click');
				}
			});
		});
	
		jQuery('.next_button').find('a').click(function() {
			var parent = this.parentNode;
			while (!jQuery(parent).find('.sow-slider-pagination').length) {
				parent = parent.parentNode;
			}
			var next_button = jQuery(parent).find('.sow-slide-nav-next').first();
			next_button.find('a').trigger('click');
		});
	});




jQuery(window).load(function() {
  jQuery(document).foundation();
});
