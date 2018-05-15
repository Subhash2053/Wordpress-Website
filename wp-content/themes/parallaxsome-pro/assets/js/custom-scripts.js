jQuery(document).ready(function($) {
	'use strict';

    //Web Pre Loader
    var preloader = $('.preloader');
    $(window).load(function(){
    	preloader.remove();
    });

	/**
     * Parallax menu
     */
    $(window).load(function(){
        if( $('body').hasClass('header-sticky') ) {
            var headerHeight = $('.ps-header-wrapper').outerHeight();
        } else {
            var headerHeight = 5;
        }
        $('.page-template-template-home .parallax-menu').onePageNav({
            currentClass: 'current',
            changeHash: false,
            scrollSpeed: 2200,
            scrollOffset: headerHeight,
            scrollThreshold: 0.5
        });
    });

    /**
     * Search icon at primary menu
     */
    $('.ps-search-icon').click(function() {
        $('.ps-head-search').find('.search-form').toggleClass('active-form');
        $('.ps-head-search').find('.search-form').fadeToggle();
    });

    /**
	 * Main Slider
	 */
	$('.frontSlider').bxSlider({
		auto:true,
		speed:1000,
		pause:6500,
		controls:false,
		mode:'fade',
        pager:true
	});

	/**
	 * Main slider height
	 */
	if( $('body').hasClass('home') ){
        if( $('.ps-front-slider-wrapper').length ) {
            $(window).resize(function() {
                var wHeight = ( $(window).height() );
                $('.ps-front-slider-wrapper').find( '.bx-viewport' ).height(wHeight);
                $('.single-slide-wrap').height(wHeight);
            }).resize();
        }
    }

	/**
	 * Service section
	 */
	$('.service-tab-content .tab-pane').hide();
	$('.service-nav-tab li').first().addClass('active');
	$('.service-tab-content .tab-pane').first().addClass('active');
	$('.service-tab-content .tab-pane').first().show();
	$('.service-nav-tab li a').on('click', function(){
		var tabId = $(this).attr('data-tab');
		$('.service-tab-content .tab-pane').hide();
		$('.service-tab-content .tab-pane').removeClass('active');
		$('.service-nav-tab li').removeClass('active');
		$(this).parent('li').addClass('active');
		$('#'+tabId).show();
        $('#'+tabId).addClass('animated slideInRight');
		$('#'+tabId).addClass('active');
        $('#section-services').resize();
	});

	/**
	 * Testimonials Section
	 */
	$('.testiSlider').bxSlider();

	/**
	 * Fact Counter
	 */
    $('.ps-fact-number').counterUp({
        delay: 20,
        time: 2000
    });

    /**
     * Portfolio Section
     */
    $('#psProjects').lightSlider({
    	item:5,
    	loop:true,
    	slideMove:1,
    	speed:600,
        enableDrag: false,
        slideMargin: 0,
        easing: 'cubic-bezier(0.25, 0, 0.25, 1)',
        responsive : [
            {
                breakpoint:800,
                settings: {
                    item:3,
                    slideMove:1,
                    slideMargin:6,
                  }
            },
            {
                breakpoint:480,
                settings: {
                    item:1,
                    slideMove:1
                  }
            }
        ],
        onSliderLoad: function() {
           $('.featuredSlider').removeClass( 'cS-hidden' );
       	}
    });
    
    /** Team Carousel Slider **/
    if($('#section-team').hasClass('layout-2')){
          $('.team-wraper-carousel').lightSlider({
        	item:4,
        	pager:true,
    		loop:true,
            slideMargin:17,
    		controls:false,
            slideMove:4,
    		prevHtml: '<i class="fa fa-angle-left" aria-hidden="true"></i>',
    		nextHtml : '<i class="fa fa-angle-right" aria-hidden="true"></i>',
            responsive : [
                {
                    breakpoint:992,
                    settings: {
                        item:3,
                        slideMove:3
                      }
                },
                {
                 	breakpoint:768,
                    settings: {
                        item:2,
                        slideMove:2
                      }
                },
                {
                    breakpoint:480,
                    settings: {
                        item:1,
                        slideMove:1
                      }
                }
            ],
            onSliderLoad: function() {
               $('.team-wraper-carousel').removeClass( 'cS-hidden' );
           	}
        });  
    }else{
    $('.team-wraper-carousel').lightSlider({
    	item:4,
    	pager:true,
		loop:true,
        slideMargin:17,
		controls:false,
        slideMove:4,
		prevHtml: '<i class="fa fa-angle-left" aria-hidden="true"></i>',
		nextHtml : '<i class="fa fa-angle-right" aria-hidden="true"></i>',
        responsive : [
            {
                breakpoint:992,
                settings: {
                    item:3,
                    slideMove:3
                  }
            },
            {
             	breakpoint:640,
                settings: {
                    item:2,
                    slideMove:2
                  }
            },
            {
                breakpoint:400,
                settings: {
                    item:1,
                    slideMove:1
                  }
            }
        ],
        onSliderLoad: function() {
           $('.team-wraper-carousel').removeClass( 'cS-hidden' );
       	}
    });
    }
    
    /** Blog Page Gallery **/
    $(".gallery a[rel^='prettyPhoto']").prettyPhoto({
        social_tools: false,
        deeplinking: false,
        theme:'pp_default'
    });
    $(".zoom-detail a[rel^='prettyPhoto']").prettyPhoto({
        social_tools: false,
        deeplinking: false,
        theme:'pp_default'
    });
                                    
    /*
    *   Feature Slider
    */
    $('.wrap-featurs').lightSlider({
    	item:1,
    	loop:true,
    	slideMove:1,
    	speed:600,
        enableDrag: false,
        slideMargin: 0,
        easing: 'cubic-bezier(0.25, 0, 0.25, 1)',
        responsive : [
            {
                breakpoint:800,
                settings: {
                    item:1,
                    slideMove:1,
                    slideMargin:6,
                  }
            },
            {
                breakpoint:480,
                settings: {
                    item:1,
                    slideMove:1
                  }
            }
        ],
        onSliderLoad: function() {
           $('.featuredSlider').removeClass( 'cS-hidden' );
       	}
    });
    
    //Testimonial slide JS
    $('.testiSlider-multiimage').owlCarousel({
        margin:30,
        nav:false,
        dots: true,
        responsive:{
          0:{
                items:1
            },
            360:{
                items:1
            },
             411:{
                items:1
            },
            435:{
                items:1
            },
            500:{
                items:2
            },
            650:{
                items:2
            },
            1000:{
                items:3
            }
        }
    });
    
    /**
     * Map section
     */
    $('.ps-mag-caption').on('click', function(){
        $(this).toggleClass('active');
        $('.ps-map-frame').toggleClass('active');
        $('.ps-map-frame').fadeToggle();
    });

    /**
     * Image lightbox
     */
    $("a.zoom-icon").prettyPhoto({
        social_tools: false,
        deeplinking: false,
        theme:'pp_default'
    });

    /**
     * Nav toggle
     */
    $('.nav-toggle').click(function() {
        $('.nav-wrapper .menu').slideToggle('slow');
        $(this).parent('.nav-wrapper').toggleClass('active');
    });

    $('.nav-wrapper .menu-item-has-children').append('<span class="sub-toggle"> <i class="fa fa-angle-right"></i> </span>');
    $('.nav-wrapper .page_item_has_children').append('<span class="sub-toggle-children"> <i class="fa fa-angle-right"></i> </span>');

    $('.nav-wrapper .sub-toggle').click(function() {
        $(this).parent('.menu-item-has-children').children('ul.sub-menu').first().slideToggle('1000');
        $(this).children('.fa-angle-right').first().toggleClass('fa-angle-down');
    });

    $('.nav-wrapper .sub-toggle-children').click(function() {
        $(this).parent('.page_item_has_children').children('ul.children').first().slideToggle('1000');
        $(this).children('.fa-angle-right').first().toggleClass('fa-angle-down');
    });

    /**
     * Wow
     */
    if( $('body').hasClass('page-template-template-home') ) {
        new WOW().init();
    }

    /** 
     *Top up arrow
     */
    $("#scroll-up").hide();
    $(function () {
        $(window).scroll(function () {
            if ($(this).scrollTop() > 1000) {
                $('#scroll-up').fadeIn();
            } else {
                $('#scroll-up').fadeOut();
            }
        });
        $('a#scroll-up').click(function () {
            $('body,html').animate({
                scrollTop: 0
            }, 800);
            return false;
        });
    });
    
    /** Portfolio Masonery **/        
    var $grid = $('.portfolio-postse').imagesLoaded( function() {
      // init Isotope after all images have loaded
      $grid.isotope({
        itemSelector: '.portfolio-post-wrape',
      });
    });

    $('.portfolio-post-filter').on( 'click', '.filter', function() {
        $('.portfolio-post-filter .filter').removeClass('active');
        $(this).addClass('active');
      var filterValue = $(this).attr('data-filter');
      $('.portfolio-postse').isotope({ filter: filterValue });
    });
    
    // FAQS JS
    $(".faq_question").click(function () {
        var id_faq = this.id;
        var ids2 = id_faq.split("-");
        $('li.'+ids2[1]).toggleClass('faq_qa_wrap');
        $('li.'+ids2[1]+' .faq_ans').slideToggle('faq_qa_wrap');
    });
    $(".plus_minus_wrap").click(function () {
        var id_faq = this.id;
        $('li.'+id_faq).toggleClass('faq_qa_wrap');
        $('li.'+id_faq+' .faq_ans').slideToggle('faq_qa_wrap');
    });
    
    $('.progressBar').each(function() {
		var bar = $(this);
		var max = $(this).attr('id');
        var label = $(this).attr('data-label');
		max = max.substring(3);
        bar.waypoint({
            handler: function(){                
                var progressBarWidth = max * bar.width() / 100;
                bar.find('div').animate({ width: progressBarWidth }, 1000).html();
            },
            offset: '95%'
        });
	});
    
    $(window).load(function(){
        $('#section-video').parallax('50%', 0.4, true);
        $('#section-booking').parallax('50%', 0.4, true);
        $('#section-services').parallax('50%', 0.4, true);
        $('#section-quicklink').parallax('50%', 0.4, true);
        $('#section-pricing').parallax('50%', 0.4, true);
        $('#section-feature').parallax('50%', 0.4, true);
        $('#section-fact').parallax('50%', 0.4, true);
        $('#section-cta').parallax('50%', 0.4, true);
        $('#section-clients').parallax('50%', 0.4, true);
        $('#section-testimonials').parallax('50%', 0.4, true);
        $('.wrap-main-title-item').parallax('50%', 0.4, true);
    });
    
    /** Scrollbar **/
    $(".widgets-hidden").mCustomScrollbar({
        theme: "minimal",
        axis:"y" // horizontal scrollbar
    });
    
    // HIdden sidebar toggle
    $('.hide-show-point').click(function(){
        $('.hidden-sidebar').toggleClass('on');        
        $('.hide-show-point').toggleClass('on');
        $('.inner-hide-show-point').toggleClass('on');        
        $('.widgets-hidden').toggleClass('on');
    });
    $('.inner-hide-show-point').click(function(){
        $('.hidden-sidebar').toggleClass('on');
        $('.hide-show-point').toggleClass('on');
        $('.inner-hide-show-point').toggleClass('on');
        $('.widgets-hidden').toggleClass('on');
    });
});