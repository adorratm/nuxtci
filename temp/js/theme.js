/*
 Theme Name: Ulina
 Theme URI: https://uiuxom.com/ulina/html/
 Author: uiuxom
 Author URI: https://themeforest.net/user/uiuxom
 Description: Ulina - Fashion Ecommerce Responsive HTML Template
 Version: 1.0
 License:
 License URI: 
*/

/*==================================
    [Table of contents]
===================================
    01. Variables
    02. Nice Selects
    03. Owl Carousels and Slick
    04. Masonry Grid
    05. Count Down
    06. Image Popup
    07. Back To Top
    08. Pointer Image
    09. Revolution Slider
    10. Sidebar Toggle
    11. Price Slider
    12. Payment Method Toggle
    13. Cirle Progress
    14. Skill Bar
    15. Counter
    16. Sticky Header
    17. Popup Search
    18. Preloader
    19. Contact Form Submission
    20. Google Maps
    21. Social Toggle Menu
    22. Mobile Menu
*/

(function () {
    'use strict';
    /*------------------------------------------------------
    /  01. Variables
    /------------------------------------------------------*/
    var $anSelect = $('.anSelect select'), 
        $sortNavSelect = $('.sortNav select'), 
        $singleVariationSelect = $('.singleVariation select'), 
        $productCarousel = $('.productCarousel'),
        $ulinaCountDown = $('.ulinaCountDown'),
        $masonryGrid = $('#masonryGrid'),
        $masonryGrid2 = $('#masonryGrid2'),
        $categoryCarousel = $('.categoryCarousel'),
        $testimonialCarousel = $('.testimonialCarousel'),
        $testimonialCarousel2 = $('.testimonialCarousel2'),
        $instagramSlider = $('.instagramSlider'),
        $imgPopup = $('.imgPopup'),
        $clientLogoSlider = $('.clientLogoSlider'),
        $categoryCarousel2 = $('.categoryCarousel2'),
        $sliderRange = $('#sliderRange'),
        $pointerImage = $('.pointerImage'),
        $productGallery = $('.productGallery'),
        $productGalleryThumb = $('.productGalleryThumb'),
        $productGallery2 = $('.productGallery2'),
        $productGalleryThumb2 = $('.productGalleryThumb2'),
        $shippingFormElementsSelect = $('.shippingFormElements select'),
        $checkoutForm = $('.checkoutForm select'),
        $teamCarousel = $('.teamCarousel');
    
    /*------------------------------------------------------
    /  02. Nice Selects
    /------------------------------------------------------*/
    if($anSelect.length > 0){
        $anSelect.niceSelect();
    };
    if($sortNavSelect.length > 0){
        $sortNavSelect.niceSelect();
    };
    if($singleVariationSelect.length > 0){
        $singleVariationSelect.niceSelect();
    };
    if($shippingFormElementsSelect.length > 0){
        $shippingFormElementsSelect.niceSelect();
    };
    if($checkoutForm.length > 0){
        $checkoutForm.niceSelect();
    };
    
    /*------------------------------------------------------
    /  03. Owl Carousels and Slick
    /------------------------------------------------------*/

    // Owl Carousel For teamCarousel
    if($teamCarousel.length > 0){
        var $teamCarousel_obj = $teamCarousel.owlCarousel({
            autoplay: false,
            margin: 24,
            loop: false,
            nav: true,
            navText: ['<i class="fa-solid fa-angle-left"></i>', '<i class="fa-solid fa-angle-right"></i>'],
            dots: false,
            items: 4,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 1
                },
                576: {
                    items: 2
                },
                768: {
                    items: 2
                },
                992: {
                    items: 3
                },
                1200: {
                    items: 4
                }
            }
        });
    };

    // Owl Carousel For productCarousel
    if($productCarousel.length > 0){
        var $productCarousel_obj = $productCarousel.owlCarousel({
            autoplay: false,
            margin: 24,
            loop: false,
            nav: true,
            navText: ['<i class="fa-solid fa-angle-left"></i>', '<i class="fa-solid fa-angle-right"></i>'],
            dots: false,
            items: 4,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 1
                },
                576: {
                    items: 2
                },
                768: {
                    items: 2
                },
                992: {
                    items: 3
                },
                1200: {
                    items: 4
                }
            }
        });
    };

    // Owl Carousel For categoryCarousel
    if($categoryCarousel.length > 0){
        var $categoryCarousel_obj = $categoryCarousel.owlCarousel({
            autoplay: false,
            margin: 24,
            loop: true,
            nav: true,
            navText: ['<i class="fa-solid fa-angle-left"></i>', '<i class="fa-solid fa-angle-right"></i>'],
            dots: false,
            items: 4,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 1
                },
                576: {
                    items: 2
                },
                768: {
                    items: 3
                },
                992: {
                    items: 3
                },
                1200: {
                    items: 4
                }
            }
        });
    };

    // Owl Carousel For categoryCarousel2
    if($categoryCarousel2.length > 0){
        var $categoryCarousel2_obj = $categoryCarousel2.owlCarousel({
            autoplay: false,
            margin: 24,
            loop: true,
            nav: true,
            navText: ['<i class="fa-solid fa-angle-left"></i>', '<i class="fa-solid fa-angle-right"></i>'],
            dots: false,
            items: 5,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 1
                },
                576: {
                    items: 2
                },
                768: {
                    items: 3
                },
                992: {
                    items: 4
                },
                1200: {
                    items: 5
                }
            }
        });
    };
    
    // Owl Carousel For testimonialCarousel2
    if($testimonialCarousel2.length > 0){
        var $testimonialCarousel2_obj = $testimonialCarousel2.owlCarousel({
            autoplay: false,
            margin: 24,
            loop: true,
            nav: true,
            navText: ['<i class="fa-solid fa-angle-left"></i>', '<i class="fa-solid fa-angle-right"></i>'],
            dots: true,
            items: 3,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 1,
                    nav: false
                },
                576: {
                    items: 1
                },
                768: {
                    items: 2
                },
                992: {
                    items: 3
                },
                1200: {
                    items: 3
                }
            }
        });
    };
    
    // Owl Carousel For testimonialCarousel
    if ($testimonialCarousel.length > 0) {
        var $testimonialCarousel_obj = $testimonialCarousel.owlCarousel({
            autoplay: false,
            margin: 24,
            loop: true,
            nav: true,
            navText: [],
            dots: true,
            items: 2,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 1
                },
                768: {
                    items: 2
                },
                992: {
                    items: 1
                },
                1200: {
                    items: 2
                }
            }
        });
        $('.tnext').on('click', function() {
            $testimonialCarousel_obj.trigger('next.owl.carousel');
        });
        $('.tprev').on('click', function() {
            $testimonialCarousel_obj.trigger('prev.owl.carousel');
        });
    }

    // Owl Carousel For instagramSlider
    if($instagramSlider.length > 0){
        var $instagramSlider_obj = $instagramSlider.owlCarousel({
            autoplay: false,
            margin: 0,
            loop: true,
            nav: false,
            dots: false,
            items: 5,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 1
                },
                576: {
                    items: 2
                },
                768: {
                    items: 3
                },
                992: {
                    items: 4
                },
                1200: {
                    items: 5
                }
            }
        });
    };

    // Owl Carousel For clientLogoSlider
    if($clientLogoSlider.length > 0){
        var $clientLogoSlider_obj = $clientLogoSlider.owlCarousel({
            autoplay: false,
            margin: 0,
            loop: true,
            nav: false,
            dots: false,
            items: 5,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 1
                },
                576: {
                    items: 2
                },
                768: {
                    items: 3
                },
                992: {
                    items: 4
                },
                1200: {
                    items: 5
                }
            }
        });
    };
    
    // Slick For productGallery
    $productGallery.slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        fade: true,
        asNavFor: '.productGalleryThumb'
    });

    // Slick For productGalleryThumb
    $productGalleryThumb.slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        asNavFor: '.productGallery',
        dots: false,
        centerMode: false,
        focusOnSelect: false,
        arrows: true,
        prevArrow: '<button type="button" class="slick-prev"><i class="fa-solid fa-angle-left"></i></button>',
        nextArrow: '<button type="button" class="slick-next"><i class="fa-solid fa-angle-right"></i></button>'
    });
    
    // Slick For productGallery2
    $productGallery2.slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        fade: true,
        asNavFor: '.productGalleryThumb2'
    });

    // Slick For productGalleryThumb2
    $productGalleryThumb2.slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        asNavFor: '.productGallery2',
        dots: false,
        arrows: false,
        vertical: true,
        focusOnSelect: true,
        verticalSwiping:true,
        responsive: [
            {
                breakpoint: 575,
                settings: {
                    vertical: false,
                    slidesToShow: 3
                }
            }
        ]
    });
    
    /*--------------------------------------------------------
    / 04. Masonry Grid
    /---------------------------------------------------------*/
    if ($masonryGrid.length > 0) {
        var $masonryGrid = $('#masonryGrid');

        var Shuffle = window.Shuffle;
        var element = document.querySelector('#masonryGrid');
        var sizer = element.querySelector('.shafSizer');

        var shaff_inst = new Shuffle(element, {
            itemSelector: '.shafItem',
            sizer: sizer
        });
    }
    if ($masonryGrid2.length > 0) {
        var $masonryGrid2 = $('#masonryGrid2');

        var Shuffle = window.Shuffle;
        var element = document.querySelector('#masonryGrid2');
        var sizer = element.querySelector('.shafSizer');

        var shaff_inst = new Shuffle(element, {
            itemSelector: '.shafItem',
            sizer: sizer
        });
    }
    
    /*--------------------------------------------------------
    / 05. Count Down
    /----------------------------------------------------------*/
    if ($ulinaCountDown.length > 0) {
        var d = $ulinaCountDown.attr('data-day');
        var m = $ulinaCountDown.attr('data-month');
        var y = $ulinaCountDown.attr('data-year');
        $ulinaCountDown.countdown({
            //until: new Date(y, m - 1, d),
            until: '+2d',
            format: 'DHMS',
            labels: ['Yrs', 'Mths', 'Weks', 'Days', 'Hrs', 'Mins', 'Secs']
        });
    }
    
   /*--------------------------------------------------------
    /   07. Back To Top
    /--------------------------------------------------------*/
    var back = $("#backtotop"),
        body = $("body, html");
    $(window).on('scroll', function () {
        if ($(window).scrollTop() > $(window).height()) {
            back.css({ bottom: '30px', opacity: '1', visibility: 'visible' });
        } else {
            back.css({ bottom: '-30px', opacity: '0', visibility: 'hidden' });
        }
    });
    body.on("click", "#backtotop", function (e) {
        e.preventDefault();
        body.animate({ scrollTop: 0 });
        return false;
    });
    
   /*--------------------------------------------------------
    /   08. Pointer Image
    /--------------------------------------------------------*/
    $pointerImage.each(function(){
        let $pointerWrap = $(this);
        $('.cpAchor', $pointerWrap).on('click', function(e){
            e.preventDefault();
            let $cpAchor = $(this);
            if($cpAchor.parent('.clickPoint').hasClass('active')){
                $('.clickPoint', $pointerWrap).removeClass('active');
            }else{
                $('.clickPoint', $pointerWrap).removeClass('active');
                $cpAchor.parent('.clickPoint').addClass('active');
            }
        });
    });

    /*--------------------------------------------------------
    /   09. Revolution Slider
    /--------------------------------------------------------*/
    if ($('.sliderSection01').length > 0) {
        var revapi1 = jQuery('#rev_slider_1').show().revolution({
            delay: 9000,
            responsiveLevels: [1400, 1399, 991, 767],
            gridwidth: [1320, 1140, 720],
            jsFileLocation: "js/",
            sliderLayout: "fullwidth",
            gridheight:[1080, 1080, 768, 550],
            minHeight: '550',
            navigation: {
                keyboardNavigation: "off",
                keyboard_direction: "horizontal",
                mouseScrollNavigation: "off",
                onHoverStop: "off",
                arrows: {
                    style: "custom",
                    enable: true,
                    hide_onmobile: false,
                    hide_onleave: false,
                    hide_under: 1300,
                    tmp: '',
                    left: {
                        h_align: "left",
                        v_align: "center",
                        h_offset: 60,
                        v_offset: 0
                    },
                    right: {
                        h_align: "right",
                        v_align: "center",
                        h_offset: 60,
                        v_offset: 0
                    }
                },
                bullets: {
                    enable: true,
                    style: 'custom',
                    tmp: '<span></span>',
                    direction: 'horizontal',
                    rtl: false,

                    container: 'layergrid',
                    h_align: 'left',
                    v_align: 'bottom',
                    h_offset: 0,
                    v_offset: 60,
                    space: 20,

                    hide_onleave: false,
                    hide_onmobile: true,
                    hide_under: 1000,
                    hide_over: 9999,
                    hide_delay: 200,
                    hide_delay_mobile: 1200
                }
            },
            parallax: {
                type: 'mouse+scroll',
                origo: 'slidercenter',
                speed: 900,
                levels: [5, 10, 15, 20, 25, 30, 35, 40,
                    45, 46, 47, 48, 49, 50, 51, 55],
                disable_onmobile: 'on'
            }
        });
    }
    if ($('.sliderSection02').length > 0) {
        var revapi1 = jQuery('#rev_slider_2').show().revolution({
            delay: 9000,
            responsiveLevels: [1400, 1399, 991, 767],
            gridwidth: [1320, 1140, 720],
            jsFileLocation: "js/",
            sliderLayout: "fullwidth",
            gridheight:[940, 940, 768, 550],
            minHeight: '550',
            navigation: {
                keyboardNavigation: "off",
                keyboard_direction: "horizontal",
                mouseScrollNavigation: "off",
                onHoverStop: "off",
                arrows: {
                    style: "custom",
                    enable: true,
                    hide_onmobile: true,
                    hide_under: 767,
                    hide_onleave: false,
                    tmp: '',
                    left: {
                        h_align: "left",
                        v_align: "center",
                        h_offset: 60,
                        v_offset: 0
                    },
                    right: {
                        h_align: "right",
                        v_align: "center",
                        h_offset: 60,
                        v_offset: 0
                    }
                },
                bullets: {
                    enable: true,
                    style: 'custom',
                    tmp: '<span></span>',
                    direction: 'horizontal',
                    rtl: false,

                    container: 'layergrid',
                    h_align: 'center',
                    v_align: 'bottom',
                    h_offset: 0,
                    v_offset: 60,
                    space: 20,

                    hide_onleave: false,
                    hide_onmobile: false,
                    hide_under: 320,
                    hide_over: 9999,
                    hide_delay: 200,
                    hide_delay_mobile: 1200
                }
            },
            parallax: {
                type: 'mouse+scroll',
                origo: 'slidercenter',
                speed: 900,
                levels: [5, 10, 15, 20, 25, 30, 35, 40,
                    45, 46, 47, 48, 49, 50, 51, 55],
                disable_onmobile: 'on'
            }
        });
    }
    
    /*--------------------------------------------------------
    /   10. Sidebar Toggle
    /--------------------------------------------------------*/
    $('.shopSidebar ul li.menu-item-has-children > a').on('click', function(e){
        e.preventDefault();
        $(this).siblings('ul').slideToggle();
        $(this).parent('li.menu-item-has-children').toggleClass('active');
    });

    /*--------------------------------------------------------
    / 11. Price Slider
    /----------------------------------------------------------*/
    if ($sliderRange.length > 0) {
        $sliderRange.slider({
            range: true,
            min: 0,
            max: 10000,
            values: [0, 2000],
            slide: function (event, ui) {
                $("#amount").html("$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ]);
            }
        });
        $("#amount").html("$" + $sliderRange.slider("values", 0) + " - $" + $sliderRange.slider("values", 1));
    }
    
    /*--------------------------------------------------------
    / 12. Payment Method Toggle
    /----------------------------------------------------------*/
    $('.wc_payment_methods li > label').on('click', function(){
       if(!$(this).parent('li').hasClass('active')){
           $('.wc_payment_methods li').removeClass('active');
           $('.wc_payment_methods li .paymentDesc').slideUp();
           $(this).parent('li').addClass('active');
           $(this).siblings('.paymentDesc').slideDown();
       }
    });
    
    /*------------------------------------------------------
    /  13. Cirle Progress
    /------------------------------------------------------*/
    if ($(".circleProgress").length > 0) {
        var ast1 = true;
        $('.circleProgress').appear();
        $('.circleProgress').on('appear', function () {
            if (ast1 == true) {
                $(".circleProgress").each(function () {
                    var pint = $(this).attr('data-skills');
                    var decs = pint * 100;
                    var efill = $(this).attr('data-emptyfill');
                    var fill = $(this).attr('data-fills');
                    
                    $(this).circleProgress({
                        value: pint,
                        startAngle: -Math.PI / 2 * 1,
                        fill: { color: fill },
                        lineCap: 'square',
                        thickness: 6,
                        animation: {duration: 1800},
                        size: 96,
                        emptyFill: efill
                    }).on('circle-animation-progress', function (event, progress) {
                        $(this).find('h3').html(parseInt(decs * progress) + '%');
                    });
                });
                ast1 = false;
            }
        });
    }
    
    /*--------------------------------------------------------
    / 14. Skill Bar
    /----------------------------------------------------------*/
    if ($(".singleSkill").length > 0) {
        $('.singleSkill').appear();
        $('.singleSkill').on('appear', loadSkills);
    }
    var coun = true;
    function loadSkills() {
        $(".singleSkill").each(function () {
            var datacount = $(this).attr("data-skill");
            $(".skill", this).animate({ 'width': datacount + '%' }, 2000);
            if (coun) {
                $(this).find('span').each(function () {
                    var $this = $(this);
                    $({ Counter: 0 }).animate({ Counter: datacount }, {
                        duration: 2000,
                        easing: 'swing',
                        step: function () {
                            $this.text(Math.ceil(this.Counter) + '%');
                        }
                    });
                });
            }
        });
        coun = false;
    }
    /*--------------------------------------------------------
    / 15. Counter
    /---------------------------------------------------------*/
    $('.timer').appear();
    $(document.body).on('appear', '.timer', function(e, $affected) {
        $affected.each(function() {
            var $this = $(this);
            if(!$this.hasClass('appeared')){
                jQuery({Counter: 0}).animate({Counter: $this.attr('data-count')}, {
                    duration: 3000,
                    easing: 'swing',
                    step: function () {
                        var num = Math.ceil(this.Counter).toString();
                        $this.html(num);
                    }
                });
                $this.addClass('appeared');
            }
        });
    });
    
    /*--------------------------------------------------------
    /  16. Sticky Header
    /---------------------------------------------------------*/
    $(window).on('scroll', function () {
        var heights = $(window).height();
        var header_height = $(".isSticky").height();
        if ($(window).scrollTop() > heights) {
            if($(".isSticky").hasClass('h01Mode2')){
                $('.blanks').css('height', header_height);
            }
            $(".isSticky").addClass('fixedHeader animated slideInDown');
        } else {
            if($(".isSticky").hasClass('h01Mode2')){
                $('.blanks').css('height', '0');
            }
            $(".isSticky").removeClass('fixedHeader animated slideInDown');
        }
    });
    
    /*--------------------------------------------------------
    / 17. Popup Search
    /----------------------------------------------------------*/
    $('.anSearch > a').on('click', function (e) {
        e.preventDefault();
        $('.popup_search_sec').toggleClass('active');
    });
    $('.popup_search_overlay, #search_Closer').on('click', function () {
        $('.popup_search_sec').removeClass('active');
    });
    
    /*--------------------------------------------------------
    /  18. Preloader
    /---------------------------------------------------------*/
    $(window).on('load', function () {
        var preload = $('#preloader');
        if (preload.length > 0) {
            preload.delay(500).fadeOut('slow');
        }
    });

    /*----------------------------------------------------------
    / 19. Contact Form Submission
    /----------------------------------------------------------*/
    $('#contact_form').on('submit', function (e) {
        e.preventDefault();
        var $this = $(this);

        $('button[type="submit"]', this).attr('disabled', 'disabled').val('Processing...');
        var form_data = $this.serialize();
        var required = 0;
        $(".required", this).each(function () {
            if ($(this).val() === ''){
                $(this).addClass('reqError');
                required += 1;
            } else{
                if ($(this).hasClass('reqError'))
                {
                    $(this).removeClass('reqError');
                    if (required > 0)
                    {
                        required -= 1;
                    }
                }
            }
        });
        if (required === 0) {
            $.ajax({
                type: 'POST',
                url: 'ajax/mail.php',
                data: {form_data: form_data},
                success: function (data) {
                    $('button[type="submit"]', $this).removeAttr('disabled').val('Message');

                    $('.con_message', $this).fadeIn().html('<strong>Congratulations!</strong> Your query successfully sent to site admin.').removeClass('alert-warning').addClass('alert-success');
                    setTimeout(function () {
                        $('.con_message', $this).fadeOut().html('').removeClass('alert-success alert-warning');
                    }, 5000);
                }
            });
        } else {
            $('button[type="submit"]', $this).removeAttr('disabled').val('Message');
            $('.con_message', $this).fadeIn().html('<strong>Opps!</strong> Errpr found. Please fix those and re submit.').removeClass('alert-success').addClass('alert-warning');
            setTimeout(function () {
                $('.con_message', $this).fadeOut().html('').removeClass('alert-success alert-warning');
            }, 5000);
        }
    });
    $(".required").on('keyup', function () {
        $(this).removeClass('reqError');
    });

    /*--------------------------------------------------------
    /  21. Social Toggle Menu
    /---------------------------------------------------------*/
    $('.anSocial a.tog').on('click', function(){
        $(this).parent('.anSocial').toggleClass('active');
    });

    /*--------------------------------------------------------
    /  22. Mobile Menu
    /---------------------------------------------------------*/
    $('.mainMenu ul li.menu-item-has-children > a').on('click', function(e){
        e.preventDefault();
        if($(window).width() < 1366){
            $(this).siblings('ul, .megaMenu').slideToggle();
        }
    });
    $('.menuToggler').on('click', function(e){
        e.preventDefault();
        $('.mainMenu').slideToggle();
        $(this).toggleClass('active');
    });

    /*--------------------------------------------------------
    /  23. Product QuickView
    /---------------------------------------------------------*/
    $('.pi01QuickView').on('click', function(e){
        e.preventDefault();
        const myModal = new bootstrap.Modal('#productQuickView', {
            keyboard: false
        })
        const productQuickView = document.getElementById('productQuickView'); 
        myModal.show(productQuickView);
        productQuickView.addEventListener('shown.bs.modal', event => {
            // Slick For productGallery
            $('#productQuickView .productGalleryPopup').not('.slick-initialized').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: false,
                fade: true,
                asNavFor: '.productGalleryThumbPopup'
            });

            // Slick For productGalleryThumb
            $('#productQuickView .productGalleryThumbPopup').not('.slick-initialized').slick({
                slidesToShow: 3,
                slidesToScroll: 1,
                asNavFor: '.productGalleryPopup',
                dots: false,
                centerMode: false,
                focusOnSelect: true,
                arrows: true,
                prevArrow: '<button type="button" class="slick-prev"><i class="fa-solid fa-angle-left"></i></button>',
                nextArrow: '<button type="button" class="slick-next"><i class="fa-solid fa-angle-right"></i></button>'
            });
        })
    })
    
})(jQuery)