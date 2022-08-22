(function ($) {
  "use strict";

  /*-------------------------------------------
  preloader active
  --------------------------------------------- */
  jQuery(window).load(function () {
    jQuery(".preloader").fadeOut("slow");
  });

  /*-------------------------------------------
  Sticky Header
  --------------------------------------------- */
  jQuery(window).on("scroll", function () {
    if ($(window).scrollTop() > 80) {
      jQuery("#sticky").addClass("stick");
    } else {
      jQuery("#sticky").removeClass("stick");
    }
  });

  jQuery(document).ready(function () {
    /*-------------------------------------------
    js wow active
    --------------------------------------------- */
    new WOW().init();

    /*-------------------------------------------
    js scrollup
    --------------------------------------------- */
    jQuery.scrollUp({
      scrollText: '<i class="fa fa-angle-up"></i>',
      easingType: "linear",
      scrollSpeed: 900,
      animation: "fade",
    });

    /*-------------------------------------------
    slider active
    --------------------------------------------- */
    jQuery(".hero-slide").slick({
      infinite: true,
      speed: 500,
      slidesToShow: 1,
      slidesToScroll: 1,
      autoplay: false,
      autoplaySpeed: 3000,
      dots: false,
      arrows: true,
      prevArrow: '<i class="slick-prev arrow fas fa-angle-left"></i> ',
      nextArrow: '<i class="slick-next arrow fas fa-angle-right"></i> ',
    });
    /*-------------------------------------------
    categories-slide active
    --------------------------------------------- */
    jQuery(".categories-slide").slick({
      infinite: false,
      speed: 500,
      slidesToShow: 6,
      slidesToScroll: 1,
      autoplay: true,
      autoplaySpeed: 3000,
      dots: false,
      arrows: true,
      prevArrow: '<i class="slick-prev arrow-two fas fa-angle-left"></i> ',
      nextArrow: '<i class="slick-next arrow-two fas fa-angle-right"></i> ',
      responsive: [
        {
          breakpoint: 1199,
          settings: {
            slidesToShow: 4,
            slidesToScroll: 1,
          },
        },
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 1,
          },
        },
        {
          breakpoint: 600,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 2,
          },
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1,
          },
        },
      ],
    });
    /*-------------------------------------------
    featured-slide active
    --------------------------------------------- */
    jQuery(".featured-slide").slick({
      infinite: false,
      speed: 500,
      slidesToShow: 1,
      slidesToScroll: 1,
      autoplay: false,
      autoplaySpeed: 3000,
      dots: false,
      arrows: true,
      prevArrow: '<i class="slick-prev arrow-two fas fa-angle-left"></i> ',
      nextArrow: '<i class="slick-next arrow-two fas fa-angle-right"></i> ',
    });
    /*-------------------------------------------
    deal-week-product active
    --------------------------------------------- */
    jQuery(".deal-week-product").slick({
      infinite: true,
      speed: 500,
      slidesToShow: 1,
      slidesToScroll: 1,
      autoplay: true,
      autoplaySpeed: 3000,
      dots: true,
      arrows: false,
      prevArrow: '<i class="slick-prev arrow-two fas fa-angle-left"></i> ',
      nextArrow: '<i class="slick-next arrow-two fas fa-angle-right"></i> ',
    });
    /*-------------------------------------------
    arrivals-slide active
    --------------------------------------------- */
    jQuery(".arrivals-slide").slick({
      infinite: false,
      speed: 500,
      slidesToShow: 3,
      slidesToScroll: 1,
      autoplay: true,
      autoplaySpeed: 3000,
      dots: false,
      arrows: true,
      prevArrow: '<i class="slick-prev arrow-two fas fa-angle-left"></i> ',
      nextArrow: '<i class="slick-next arrow-two fas fa-angle-right"></i> ',
      responsive: [
        {
          breakpoint: 1199,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 1,
          },
        },
        {
          breakpoint: 780,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1,
          },
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
          },
        },
      ],
    });
    /*-------------------------------------------
    slide-testimonial active
    --------------------------------------------- */
    jQuery(".slide-testimonial").slick({
      infinite: true,
      speed: 500,
      slidesToShow: 1,
      slidesToScroll: 1,
      autoplay: true,
      autoplaySpeed: 3000,
      fade: true,
      dots: false,
      arrows: false,
      prevArrow: '<i class="slick-prev arrow-two fas fa-angle-left"></i> ',
      nextArrow: '<i class="slick-next arrow-two fas fa-angle-right"></i> ',
    });
    /*-------------------------------------------
    offer-product-slide active
    --------------------------------------------- */
    jQuery(".offer-product-slide").slick({
      infinite: false,
      speed: 500,
      slidesToShow: 1,
      slidesToScroll: 1,
      autoplay: false,
      autoplaySpeed: 3000,
      dots: false,
      arrows: true,
      prevArrow: '<i class="slick-prev arrow-two fas fa-angle-left"></i> ',
      nextArrow: '<i class="slick-next arrow-two fas fa-angle-right"></i> ',
    });
    /*-------------------------------------------
    blog-slide active
    --------------------------------------------- */
    jQuery(".blog-slide").slick({
      infinite: false,
      speed: 500,
      slidesToShow: 3,
      slidesToScroll: 1,
      autoplay: true,
      autoplaySpeed: 3000,
      dots: false,
      arrows: true,
      prevArrow: '<i class="slick-prev arrow-two fas fa-angle-left"></i> ',
      nextArrow: '<i class="slick-next arrow-two fas fa-angle-right"></i> ',
      responsive: [
        {
          breakpoint: 1199,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 1,
          },
        },
        {
          breakpoint: 780,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1,
          },
        },
        {
          breakpoint: 575,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
          },
        },
      ],
    });
    /*-------------------------------------------
    big-banner-slide active
    --------------------------------------------- */
    jQuery(".big-banner-slide").slick({
      infinite: false,
      speed: 500,
      slidesToShow: 1,
      slidesToScroll: 1,
      autoplay: true ,
      autoplaySpeed: 3000,
      dots: false,
      fade: true,
      arrows: true,
      prevArrow: '<i class="slick-prev arrow-two fas fa-angle-left"></i> ',
      nextArrow: '<i class="slick-next arrow-two fas fa-angle-right"></i> ',
      responsive: [
        {
          breakpoint: 1300,
          settings: {
            arrows: false,
          }
        },
      ]
    });
    /*-------------------------------------------
    brand-slide active
    --------------------------------------------- */
    jQuery(".brand-slide").slick({
      infinite: false,
      speed: 500,
      slidesToShow: 6,
      slidesToScroll: 1,
      autoplay: true,
      autoplaySpeed: 3000,
      dots: false,
      arrows: true,
      prevArrow: '<i class="slick-prev arrow-two fas fa-angle-left"></i> ',
      nextArrow: '<i class="slick-next arrow-two fas fa-angle-right"></i> ',
      responsive: [
        {
          breakpoint: 1199,
          settings: {
            slidesToShow: 4,
            slidesToScroll: 1,
          },
        },
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 1,
          },
        },
        {
          breakpoint: 600,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 2,
          },
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1,
          },
        },
      ],
    });
    /*-------------------------------------------
   customar-brand-lsit active
    --------------------------------------------- */
    jQuery(".customar-brand-lsit").slick({
      infinite: true,
      speed: 500,
      slidesToShow: 7,
      slidesToScroll: 1,
      autoplay: true,
      autoplaySpeed: 3000,
      dots: false,
      arrows: false,
      prevArrow: '<i class="slick-prev arrow-two fas fa-angle-left"></i> ',
      nextArrow: '<i class="slick-next arrow-two fas fa-angle-right"></i> ',
      responsive: [
        {
          breakpoint: 1199,
          settings: {
            slidesToShow: 5,
            slidesToScroll: 1,
          },
        },
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 4,
            slidesToScroll: 1,
          },
        },
        {
          breakpoint: 600,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 2,
          },
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 1,
          },
        },
      ],
    });

    /*-------------------------------------------
    top-banner-slde active
    --------------------------------------------- */
    jQuery(".top-banner-slde").slick({
      infinite: false,
      speed: 500,
      slidesToShow: 1,
      slidesToScroll: 1,
      autoplay: true ,
      autoplaySpeed: 3000,
      dots: false,
      fade: true,
      arrows: false,
      prevArrow: '<i class="slick-prev arrow-two fas fa-angle-left"></i> ',
      nextArrow: '<i class="slick-next arrow-two fas fa-angle-right"></i> ',
    });
    /*-------------------------------------------
    team-slide active
    --------------------------------------------- */
    jQuery(".team-slide").slick({
      infinite: false,
      speed: 500,
      slidesToShow: 4,
      slidesToScroll: 1,
      autoplay: true,
      autoplaySpeed: 3000,
      dots: false,
      arrows: true,
      prevArrow: '<i class="slick-prev arrow-two fas fa-angle-left"></i> ',
      nextArrow: '<i class="slick-next arrow-two fas fa-angle-right"></i> ',
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 1,
          },
        },
        {
          breakpoint: 991,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1,
          },
        },
        {
          breakpoint: 575,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
          },
        },
      ],
    });
    /*-------------------------------------------
    testimonal-author-images active
    --------------------------------------------- */
    jQuery(".testimonal-author-images").slick({
      infinite: true,
      speed: 500,
      slidesToShow: 1,
      slidesToScroll: 1,
      autoplay: true,
      autoplaySpeed: 3000,
      fade: true,
      asNavFor: '.testimonail-list',
      dots: true,
      arrows: false,
      prevArrow: '<i class="slick-prev arrow-two fas fa-angle-left"></i> ',
      nextArrow: '<i class="slick-next arrow-two fas fa-angle-right"></i> ',
    });
    /*-------------------------------------------
    testimonail-list active
    --------------------------------------------- */
    jQuery(".testimonail-list").slick({
      infinite: true,
      speed: 500,
      slidesToShow: 1,
      slidesToScroll: 1,
      autoplay: true,
      autoplaySpeed: 3000,
      asNavFor: '.testimonal-author-images',
      vertical: true,
      dots: false,
      arrows: true,
      prevArrow: '<i class="slick-prev arrow-two fas fa-angle-left"></i> ',
      nextArrow: '<i class="slick-next arrow-two fas fa-angle-right"></i> ',
    });
    /*-------------------------------------------
    slider-two-slide active
    --------------------------------------------- */
      jQuery(".slider-two-slide").slick({
          infinite: true,
          speed: 500,
          slidesToShow: 1,
          slidesToScroll: 1,
          autoplay: true,
          autoplaySpeed: 3000,
          dots: false,
          arrows: true,
          prevArrow: '<i class="slick-prev fas fa-arrow-left"></i> ',
          nextArrow: '<i class="slick-next fas fa-arrow-right"></i> ',
      });
    /*-------------------------------------------
    trend-slide active
    --------------------------------------------- */
    jQuery(".trend-slide").slick({
      infinite: true,
      speed: 500,
      padding: 0,
      margin: 0,
      slidesToShow: 1,
      slidesToScroll: 1,
      autoplay: true,
      autoplaySpeed: 3000,
      dots: false,
      arrows: false,
      prevArrow: '<i class="slick-prev fas fa-arrow-left"></i> ',
      nextArrow: '<i class="slick-next fas fa-arrow-right"></i> ',
    });
    /*-------------------------------------------
    best-selling-products-slide active
    --------------------------------------------- */
    jQuery(".best-selling-products-slide").slick({
      infinite: false,
      speed: 500,
      slidesToShow: 4,
      slidesToScroll: 1,
      autoplay: true,
      autoplaySpeed: 3000,
      dots: false,
      arrows: true,
      prevArrow: '<i class="slick-prev arrow-two fas fa-angle-left"></i> ',
      nextArrow: '<i class="slick-next arrow-two fas fa-angle-right"></i> ',
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 1,
          },
        },
        {
          breakpoint: 991,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1,
          },
        },
        {
          breakpoint: 575,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
          },
        },
      ],
    });
    /*-------------------------------------------
    arrivals-slide-two active
    --------------------------------------------- */
    jQuery(".arrivals-slide-two").slick({
      infinite: false,
      speed: 500,
      slidesToShow: 4,
      slidesToScroll: 1,
      autoplay: true,
      autoplaySpeed: 3000,
      dots: false,
      arrows: true,
      prevArrow: '<i class="slick-prev arrow-two fas fa-angle-left"></i> ',
      nextArrow: '<i class="slick-next arrow-two fas fa-angle-right"></i> ',
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 1,
          },
        },
        {
          breakpoint: 991,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1,
          },
        },
        {
          breakpoint: 575,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
          },
        },
      ],
    });
    /*-------------------------------------------
    home-slide-three active
    --------------------------------------------- */
    jQuery(".hero-slide-three").slick({
      infinite: true,
      speed: 500,
      padding: 0,
      margin: 0,
      slidesToShow: 1,
      slidesToScroll: 1,
      autoplay: true,
      autoplaySpeed: 3000,
      dots: false,
      arrows: true,
      prevArrow: '<i class="slick-prev slider-btn fas fa-angle-left"></i> ',
      nextArrow: '<i class="slick-next slider-btn fas fa-angle-right"></i> ',
    });
    /*-------------------------------------------
    hero-slide-four active
    --------------------------------------------- */
    jQuery(".hero-slide-four").slick({
      infinite: true,
      speed: 500,
      slidesToShow: 1,
      slidesToScroll: 1,
      autoplay: true,
      autoplaySpeed: 3000,
      dots: false,
      arrows: true,
      prevArrow: '<i class="slick-prev slider-btn fas fa-angle-left"></i> ',
      nextArrow: '<i class="slick-next slider-btn fas fa-angle-right"></i> ',
    });
    /*-------------------------------------------
    testimonial-slide-two active
    --------------------------------------------- */
    jQuery(".testimonial-slide-two").slick({
      infinite: false,
      speed: 500,
      slidesToShow: 2,
      slidesToScroll: 1,
      autoplay: true,
      autoplaySpeed: 3000,
      dots: false,
      arrows: true,
      prevArrow: '<i class="slick-prev arrow-two fas fa-angle-left"></i> ',
      nextArrow: '<i class="slick-next arrow-two fas fa-angle-right"></i> ',
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1,
          },
        },
        {
          breakpoint: 991,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1,
          },
        },
        {
          breakpoint: 800,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
          },
        },
      ],
    });
    /*-------------------------------------------
    special-offers-slide active
    --------------------------------------------- */
    jQuery(".special-offers-slide").slick({
      infinite: false,
      speed: 500,
      slidesToShow: 1,
      slidesToScroll: 1,
      autoplay: false,
      autoplaySpeed: 3000,
      dots: false,
      arrows: true,
      prevArrow: '<i class="slick-prev arrow-two fas fa-angle-left"></i> ',
      nextArrow: '<i class="slick-next arrow-two fas fa-angle-right"></i> ',
    });
    /*-------------------------------------------
    product-priview-slide active
    --------------------------------------------- */
    jQuery('.product-priview-slide').slick({
      slidesToShow: 1,
      slidesToScroll: 1,
      autoplay: false,
      arrows: false,
      fade: true,
      asNavFor: '.product-thumb-silide'
    });
    jQuery('.product-thumb-silide').slick({
      infinite: true,
      slidesToShow: 4,
      slidesToScroll: 1,
      autoplay: false,
      asNavFor: '.product-priview-slide',
      dots: false,
      arrows: false,
      centerMode: false,
      focusOnSelect: true
    });

    /*-------------------------------------------
    offer-product-time active
    --------------------------------------------- */
    jQuery('#offer-product-time').countdown({
			date:'12/24/2020 23:59:59',// TODO Date format: 07/27/2017 17:00:00
			offset: +6, // TODO Your Timezone Offset
			day: 'Day',
			days: 'Days',
			hideOnComplete: true,
		});
    /*---------------------------------
    slider-range active
    -----------------------------------*/
    jQuery( function() {
      jQuery( "#slider-range" ).slider({
        range: true,
        min: 0,
        max: 500,
        values: [ 75, 300 ],
        slide: function( event, ui ) {
          $( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
        }
      });
      jQuery( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) +
        " - $" + $( "#slider-range" ).slider( "values", 1 ) );
    } );

    /*---------------------------------
    niceSelect active
    -----------------------------------*/
    jQuery(".niceselect").niceSelect();

    /*----------------------------
    	Cart Plus Minus Button
    ------------------------------ */
    var CartPlusMinus = jQuery('.cart-plus-minus');
    CartPlusMinus.prepend('<div class="dec qtybutton"></div>');
    CartPlusMinus.append('<div class="inc qtybutton"></div>');
    jQuery(".qtybutton").on("click", function() {
        var $button = $(this);
        var oldValue = $button.parent().find("input").val();
        if ($button.text() === "+") {
            var newVal = parseFloat(oldValue) + 1;
        } else {
            // Don't allow decrementing below zero
            if (oldValue > 1) {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 1;
            }
        }
        $button.parent().find("input").val(newVal);
    });
    /*---------------------------------
    mobile search active
    -----------------------------------*/
    jQuery(".search-open").on("click", function() {
      $('.mobile-search-area').slideToggle(500);
      return false;
    });
    /*---------------------------------
    offcanvase menu active
    -----------------------------------*/
    jQuery(".menu-bars").on("click", function() {
      jQuery('.offcanvase-manu-area').addClass('open-menu');
      jQuery('.panel-backdrop').addClass('active');
      return false;
    });
    jQuery(".panel-backdrop").on("click", function() {
      jQuery('.offcanvase-manu-area').removeClass('open-menu');
      jQuery('.panel-backdrop').removeClass('active');
    });

    /*---------------------------------
    mobile menu active
    -----------------------------------*/
    jQuery('.mobile-menu ul ul').each(function() {
			if(jQuery(this).children().length){
				jQuery(this,'li:first').parent().append('<a class="mean-expand" href="#" > + </a>');
			}
    });
		jQuery('.mean-expand').on("click",function(){
			if (jQuery(this).hasClass("mean-clicked")) {
        jQuery(this).text('+');
				jQuery(this).prev('ul').slideUp(300);
			} else {
        jQuery(this).text('-');
				jQuery(this).prev('ul').slideDown(300);
			}
			jQuery(this).toggleClass("mean-clicked");
		});

    /*---------------------------------
    counterUp active
    -----------------------------------*/
    jQuery(".counter-area").appear(function () {
      jQuery(".counter").counterUp({
        delay: 10,
        time: 1000,
      });
    });


  });
})(jQuery);
