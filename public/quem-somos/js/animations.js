// Returns true if the specified element has been scrolled into the viewport.
function isElementInViewport(elem) {
    var $elem = $(elem);

    // Get the scroll position of the page.
    var scrollElem = ((navigator.userAgent.toLowerCase().indexOf('webkit') != -1) ? 'body' : 'html');
    var viewportTop = $(scrollElem).scrollTop();
    var viewportBottom = viewportTop + $(window).height();

    // Get the position of the element on the page.
    var elemTop = Math.round($elem.offset().top);
    var elemBottom = elemTop + $elem.height();

    return ((elemTop < viewportBottom) && (elemBottom > viewportTop));
}

// Check if it's time to start the animation.

function mobilevecone() {
    var $elem = $('.mobilevecone');

    // If the animation has already been started
    if ($elem.hasClass('.animate')) return;

    if (isElementInViewport($elem)) {
        // Start the animation
        $elem.addClass('animate one fadeInLeft');
    }
}

function mobilevectwo() {
    var $elem = $('.mobilevectwo');

    // If the animation has already been started
    if ($elem.hasClass('.animate')) return;

    if (isElementInViewport($elem)) {
        // Start the animation
        $elem.addClass('animate one fadeInRight');
    }
}

function mobilevecthree() {
    var $elem = $('.mobilevecthree');

    // If the animation has already been started
    if ($elem.hasClass('.animate')) return;

    if (isElementInViewport($elem)) {
        // Start the animation
        $elem.addClass('animate one fadeInLeft');
    }
}

function testione() {
    var $elem = $('.testione');

    // If the animation has already been started
    if ($elem.hasClass('.animate')) return;

    if (isElementInViewport($elem)) {
        // Start the animation
        $elem.addClass('animate one fadeInRight');
    }
}

function testithree() {
    var $elem = $('.testithree');

    // If the animation has already been started
    if ($elem.hasClass('.animate')) return;

    if (isElementInViewport($elem)) {
        // Start the animation
        $elem.addClass('animate one fadeInLeft');
    }
}

function footerbox() {
    var $elem = $('.footerbox');

    // If the animation has already been started
    if ($elem.hasClass('.animate')) return;

    if (isElementInViewport($elem)) {
        // Start the animation
        $elem.addClass('animate one fadeInUp');
    }
}

// Capture scroll events
$(window).scroll(function() {
    mobilevecone();
    mobilevectwo();
    mobilevecthree();
    testione();
    testithree();
    footerbox();
});

$(document).ready(function() {
    $("#testimonials").owlCarousel({
        navigation: false, // Show next and prev buttons
        slideSpeed: 300,
        paginationSpeed: 400,
        items: 3,
        singleItem: false
    });
});