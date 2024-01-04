$(function () {

    "use strict";

    $(window).on('load', function () {
      setTimeout(function () {
        $(".page_loader").fadeOut("fast");
        $('link[id="css_tema"]').attr('href', _assets_portal+'css/skins/dr-2018.css');
      }, 1000);
      if ($('body .filter-portfolio').length > 0) {
            $(function () {
                $('.filter-portfolio').filterizr(
                    {
                        delay: 0
                    }
                );
            });
            $('.filteriz-navigation li').on('click', function () {
                $('.filteriz-navigation .filtr').removeClass('active');
                $(this).addClass('active');
            });
        }
    });

    adjustHeader();
    doSticky();
    $(window).on('scroll', function () {
      adjustHeader();
      doSticky();
    });

    function adjustHeader()
    {
      var windowWidth = $(window).width();
      if(windowWidth > 992) {
        if ($(document).scrollTop() >= 100) {
          if($('.header-shrink').length < 1) {
            $('.sticky-header').addClass('header-shrink');
          }
          if($('.do-sticky').length < 1) {
            $('.logo img').attr('src', _assets_portal+'img/logos/logo-drplace-dark.png');
          }
        }
        else {
          $('.sticky-header').removeClass('header-shrink');
          if($('.do-sticky').length < 1) {
            $('.logo img').attr('src', _assets_portal+'img/logos/logo-drplace-dark.png');
          }
        }
      } else {
        $('.logo img').attr('src', _assets_portal+'img/logos/logo-drplace-dark.png');
      }
    }

    function doSticky()
    {
      if ($(document).scrollTop() > 40) {
        $('.do-sticky').addClass('sticky-header');
        //$('.do-sticky').addClass('header-shrink');
      }
      else {
        $('.do-sticky').removeClass('sticky-header');
        //$('.do-sticky').removeClass('header-shrink');
      }
    }

    var wow = new WOW(
      {
        animateClass: 'animated',
        offset: 100,
        mobile: false
      }
    );
    wow.init();

    $(".open-offcanvas, .close-offcanvas").on("click", function () {
      return $("body").toggleClass("off-canvas-sidebar-open"), !1
    });

    $(document).on("click", function (t) {
      var a = $(".off-canvas-sidebar");
      a.is(t.target) || 0 !== a.has(t.target).length || $("body").removeClass("off-canvas-sidebar-open")
    });

    // DROPDOWN ON HOVER
    $(".dropdown").on('hover', function () {
      $('.dropdown-menu', this).stop().fadeIn("fast");
    },
    function () {
      $('.dropdown-menu', this).stop().fadeOut("fast");
    });


    // Counter Activation
    function isCounterElementVisible($elementToBeChecked)
    {
      var TopView = $(window).scrollTop();
      var BotView = TopView + $(window).height();
      var TopElement = $elementToBeChecked.offset().top;
      var BotElement = TopElement + $elementToBeChecked.height();
      return ((BotElement <= BotView) && (TopElement >= TopView));
    }
    $(window).on('scroll', function () {
        $( ".counter" ).each(function() {
            var isOnView = isCounterElementVisible($(this));
            if(isOnView && !$(this).hasClass('Starting')){
                $(this).addClass('Starting');
                $(this).prop('Counter',0).animate({
                    Counter: $(this).text()
                }, {
                    duration: 3000,
                    easing: 'swing',
                    step: function (now) {
                        $(this).text(Math.ceil(now));
                    }
                });
            }
        });
    });

    // Page scroller initialization.
    $.scrollUp({
      scrollName: 'page_scroller',
      scrollDistance: 300,
      scrollFrom: 'top',
      scrollSpeed: 500,
      easingType: 'linear',
      animation: 'fade',
      animationSpeed: 200,
      scrollTrigger: false,
      scrollTarget: false,
      scrollText: '<i class="fa fa-chevron-up"></i>',
      scrollTitle: false,
      scrollImg: false,
      activeOverlay: false,
      zIndex: 2147483647
    });

    // Magnify activation
    $('.property-magnify-gallery').each(function() {
      $(this).magnificPopup({
        delegate: 'a',
        type: 'image',
        gallery:{enabled:true}
      });
    });

    // Range sliders activation
    $(".range-slider-ui").each(function () {
      var minRangeValue = $(this).attr('data-min');
      var maxRangeValue = $(this).attr('data-max');
      var minName = $(this).attr('data-min-name');
      var maxName = $(this).attr('data-max-name');
      var unit = $(this).attr('data-unit');

      $(this).append("" +
          "<span class='min-value'></span> " +
          "<span class='max-value'></span>" +
          "<input class='current-min' type='hidden' name='"+minName+"'>" +
          "<input class='current-max' type='hidden' name='"+maxName+"'>"
      );
      $(this).slider({
        range: true,
        min: minRangeValue,
        max: maxRangeValue,
        values: [minRangeValue, maxRangeValue],
        slide: function (event, ui) {
          event = event;
          var currentMin = parseInt(ui.values[0], 10);
          var currentMax = parseInt(ui.values[1], 10);
          $(this).children(".min-value").text( currentMin + " " + unit);
          $(this).children(".max-value").text(currentMax + " " + unit);
          $(this).children(".current-min").val(currentMin);
          $(this).children(".current-max").val(currentMax);
        }
      });

      var currentMin = parseInt($(this).slider("values", 0), 10);
      var currentMax = parseInt($(this).slider("values", 1), 10);
      $(this).children(".min-value").text( currentMin + " " + unit);
      $(this).children(".max-value").text(currentMax + " " + unit);
      $(this).children(".current-min").val(currentMin);
      $(this).children(".current-max").val(currentMax);
    });

    // Dropdown activation
    $('.dropdown-menu a.dropdown-toggle').on('click', function(e) {
        if (!$(this).next().hasClass('show')) {
            $(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
        }
        var $subMenu = $(this).next(".dropdown-menu");
        $subMenu.toggleClass('show');


        $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function(e) {
            $('.dropdown-submenu .show').removeClass("show");
        });

        return false;
    });


    // Modal activation
    $('.property-video').on('click', function () {
        $('#propertyModal').modal('show');
    });

    // Multi-item carousel activation
    var itemsMainDiv = ('.multi-carousel');
    var itemsDiv = ('.multi-carousel-inner');
    var itemWidth = "";

    $('.leftLst, .rightLst').on('click', function () {
        var condition = $(this).hasClass("leftLst");
        if (condition)
            click(0, this);
        else
            click(1, this)
    });
    ResCarouselSize();

    $(window).on('resize', function () {
        ResCarouselSize();
        resizeModalsContent();
        adjustHeader()
    });
    function ResCarouselSize() {
        var incno = 0;
        var dataItems = ("data-items");
        var itemClass = ('.item');
        var id = 0;
        var btnParentSb = '';
        var itemsSplit = '';
        var sampwidth = $(itemsMainDiv).width();
        var bodyWidth = $('body').width();
        $(itemsDiv).each(function () {
            id = id + 1;
            var itemNumbers = $(this).find(itemClass).length;
            btnParentSb = $(this).parent().attr(dataItems);
            itemsSplit = btnParentSb.split(',');
            $(this).parent().attr("id", "multiCarousel" + id);


            if (bodyWidth >= 1200) {
                incno = itemsSplit[3];
                itemWidth = sampwidth / incno;
            }
            else if (bodyWidth >= 992) {
                incno = itemsSplit[2];
                itemWidth = sampwidth / incno;
            }
            else if (bodyWidth >= 768) {
                incno = itemsSplit[1];
                itemWidth = sampwidth / incno;
            }
            else {
                incno = itemsSplit[0];
                itemWidth = sampwidth / incno;
            }
            $(this).css({ 'transform': 'translateX(0px)', 'width': itemWidth * itemNumbers });
            $(this).find(itemClass).each(function () {
                $(this).outerWidth(itemWidth);
            });

            $(".leftLst").addClass("over");
            $(".rightLst").removeClass("over");

        });
    }

    function ResCarousel(e, el, s) {
        var leftBtn = ('.leftLst');
        var rightBtn = ('.rightLst');
        var translateXval = '';
        var divStyle = $(el + ' ' + itemsDiv).css('transform');
        var values = divStyle.match(/-?[\d\.]+/g);
        var xds = Math.abs(values[4]);
        if (e === 0) {
            translateXval = parseInt(xds, 10) - parseInt(itemWidth * s, 10);
            $(el + ' ' + rightBtn).removeClass("over");

            if (translateXval <= itemWidth / 2) {
                translateXval = 0;
                $(el + ' ' + leftBtn).addClass("over");
            }
        }
        else if (e === 1) {
            var itemsCondition = $(el).find(itemsDiv).width() - $(el).width();
            translateXval = parseInt(xds, 10) + parseInt(itemWidth * s, 10);
            $(el + ' ' + leftBtn).removeClass("over");

            if (translateXval >= itemsCondition - itemWidth / 2) {
                translateXval = itemsCondition;
                $(el + ' ' + rightBtn).addClass("over");
            }
        }
        $(el + ' ' + itemsDiv).css('transform', 'translateX(' + -translateXval + 'px)');
    }

    function click(ell, ee) {
        var Parent = "#" + $(ee).parent().attr("id");
        var slide = $(Parent).attr("data-slide");
        ResCarousel(ell, Parent, slide);
    }

    resizeModalsContent();
    function resizeModalsContent() {
        var winWidth = $(window).width();
        var videoWidth = 400;
        if(winWidth < 992) {
            videoWidth = 500;
        }
        var ratio = .6665;
        var videoHeight = videoWidth * ratio;
        $('.modalIframe').css('height', videoHeight);
    }

});
