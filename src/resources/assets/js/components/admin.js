/*
 *
 *   Responsive Admin Theme
 *   version 2.2
 *
 */

/**
 *
 * Refactored by Sergi Solsona (2017-11-30)
 *
 */

require('jquery-ui/ui/data');
require('jquery-ui/ui/scroll-parent');
require('jquery-ui/ui/widget');
require('jquery-ui/ui/disable-selection');
require('jquery-ui/ui/widgets/mouse');
require('jquery-ui/ui/widgets/sortable');

var fixedNavBarElement = $('#fixednavbar');
var fixedSideBarElement = $('#fixedsidebar');
var bodyElement = $('body');
var sideBarCollapseElement = $('.sidebar-collapse');

// Add body-small class if window less than 768px
if ($(document).width() < 769) {
    bodyElement.addClass('body-small')
} else {
    bodyElement.removeClass('body-small')
}

// MetisMenu
$('#side-menu').metisMenu();

// Collapse ibox function
$('.collapse-link').click(function () {
    var ibox = $(this).closest('div.ibox');
    var button = $(this).find('i');
    var content = ibox.find('div.ibox-content');
    content.slideToggle(200);
    button.toggleClass('fa-chevron-up').toggleClass('fa-chevron-down');
    ibox.toggleClass('').toggleClass('border-bottom');
    setTimeout(function () {
        ibox.resize();
        ibox.find('[id^=map-]').resize();
    }, 50);
});

// Close ibox function
$('.close-link').click(function () {
    var content = $(this).closest('div.ibox');
    content.remove();
});

/**
 * Useless listeners for Backoffice
 */
// Close menu in canvas mode
/*$('.close-canvas-menu').click(function () {
    bodyElement.toggleClass("mini-navbar");
    smoothlyMenu();
});

// Open close right sidebar
$('.right-sidebar-toggle').click(function () {
    $('#right-sidebar').toggleClass('sidebar-open');
});

// Initialize slimscroll for right sidebar
$('.sidebar-container').slimScroll({
    height: '100%',
    railOpacity: 0.4,
    wheelStep: 10
});

// Open close small chat
$('.open-small-chat').click(function () {
    $(this).children().toggleClass('fa-comments').toggleClass('fa-remove');
    $('.small-chat-box').toggleClass('active');
});

// Initialize slimscroll for small chat
$('.small-chat-box .content').slimScroll({
    height: '234px',
    railOpacity: 0.4
});

// Small todo handler
$('.check-link').click(function () {
    var button = $(this).find('i');
    var label = $(this).next('span');
    button.toggleClass('fa-check-square').toggleClass('fa-square-o');
    label.toggleClass('todo-completed');
    return false;
});*/

// Minimalize menu
$('.navbar-minimalize').click(function () {
    bodyElement.toggleClass("mini-navbar");

    if (localStorageSupport){
        if (bodyElement.hasClass('mini-navbar')) {
            localStorage.setItem("collapse_menu", 'on');
        } else {
            localStorage.setItem("collapse_menu", 'off');
        }
    }

    smoothlyMenu();

});

// Tooltips demo
$('[data-toggle="tooltip"]').tooltip({
    container: "body"
});

// Move modal to body
// Fix Bootstrap backdrop issu with animation.css
$('.modal').appendTo("body");

// Full height of sidebar
function fix_height() {
    var heightWithoutNavbar = $("body > #wrapper").height() - 61;
    var pageWrapperElement = $('#page-wrapper');
    $(".sidebard-panel").css("min-height", heightWithoutNavbar + "px");

    var navbarHeigh = $('nav.navbar-default').height();
    var wrapperHeigh = pageWrapperElement.height();

    if (navbarHeigh > wrapperHeigh) {
        pageWrapperElement.css("min-height", navbarHeigh + "px");
    }

    if (navbarHeigh < wrapperHeigh) {
        pageWrapperElement.css("min-height", $(window).height() + "px");
    }

    if (bodyElement.hasClass('fixed-nav')) {
        pageWrapperElement.css("min-height", $(window).height() - 60 + "px");
    }

}

fix_height();

// Fixed Sidebar
if (bodyElement.hasClass('fixed-sidebar')) {
    sideBarCollapseElement.slimScroll({
        height: '100%',
        railOpacity: 0.9
    });
}

// Move right sidebar top after scroll
$(window).scroll(function () {
    if ($(window).scrollTop() > 0 && !bodyElement.hasClass('fixed-nav')) {
        $('#right-sidebar').addClass('sidebar-top');
    } else {
        $('#right-sidebar').removeClass('sidebar-top');
    }
});

$(window).bind("load resize scroll", function () {
    if (!bodyElement.hasClass('body-small')) {
        fix_height();
    }
});

/**
 * Useless for Backoffice
 */
/*$("[data-toggle=popover]")
    .popover();

// Add slimscroll to element
$('.full-height-scroll').slimscroll({
    height: '100%'
});*/


// Minimalize menu when screen is less than 768px
var onbodyresize = function() {
    var w = window,
        a = 'inner';

    if ( !( 'innerWidth' in window ) ) {
        a = 'client';
        w = document.documentElement || document.body;
    }
    var screenWidth = w[ a+'Width' ];

    if (screenWidth < 769) {
        $('body').addClass('body-small');
    } else {
        $('body').removeClass('body-small');
    }
};

window.addEventListener("resize", onbodyresize);

// check if browser support HTML5 local storage
function localStorageSupport() {
    return (('localStorage' in window) && window['localStorage'] !== null)
}

// Local Storage functions
// Set proper body class and plugins based on user configuration
if (localStorageSupport) {
    var collapse = localStorage.getItem("collapse_menu");
    var fixedSideBar = localStorage.getItem("fixedsidebar");
    var fixedNavBar = localStorage.getItem("fixednavbar");
    var fixedFooter = localStorage.getItem("fixedfooter");
    var fixedFooterElement = $('#fixedfooter');

    if (fixedSideBar === null || fixedSideBar === 'on') {
        bodyElement.addClass('fixed-sidebar');
        sideBarCollapseElement.slimScroll({
            height: '100%',
            railOpacity: 0.9
        });
    } else {
        bodyElement.removeClass('fixed-sidebar');
    }

    if (collapse === 'on') {
        if (bodyElement.hasClass('fixed-sidebar')) {
            if (!bodyElement.hasClass('body-small')) {
                bodyElement.addClass('mini-navbar');
            }
        } else {
            if (!bodyElement.hasClass('body-small')) {
                bodyElement.addClass('mini-navbar');
            }

        }
    }

    if (fixedNavBar === 'on') {
        $(".navbar-static-top").removeClass('navbar-static-top').addClass('navbar-fixed-top');
        bodyElement.addClass('fixed-nav');
    }

    if (localStorage.getItem("boxedlayout") === 'on') {
        bodyElement.addClass('boxed-layout');
    }

    if (fixedFooter !== null && fixedFooter === 'on') {
        $(".footer").addClass('fixed');
        if (fixedFooterElement) {
            fixedFooterElement.prop('checked', 'checked');
        }
    } else {
        $(".footer").removeClass('fixed');
    }

    if (fixedSideBar === null || fixedSideBar === 'on'){
        fixedSideBarElement.prop('checked','checked')
    }
    if (fixedNavBar === 'on'){
        fixedNavBarElement.prop('checked','checked')
    }

    // Enable/disable fixed footer
    if (fixedFooterElement) {
        fixedFooterElement.click(function () {
            if (fixedFooterElement.is(':checked')) {
                $('#boxedlayout').prop('checked', false);
                bodyElement.removeClass('boxed-layout');
                $(".footer").addClass('fixed');

                if (localStorageSupport) {
                    localStorage.setItem("fixedfooter", 'on');
                }
            } else {
                $(".footer").removeClass('fixed');

                if (localStorageSupport) {
                    localStorage.setItem("fixedfooter", 'off');
                }
            }
        });
    }
}

function smoothlyMenu() {
    if (!bodyElement.hasClass('mini-navbar') || bodyElement.hasClass('body-small')) {
        // Hide menu in order to smoothly turn on when maximize menu
        $('#side-menu').hide();
        // For smoothly turn on menu
        setTimeout(
            function () {
                $('#side-menu').fadeIn(500);
            }, 100);
    } else if (bodyElement.hasClass('fixed-sidebar')) {
        $('#side-menu').hide();
        setTimeout(
            function () {
                $('#side-menu').fadeIn(500);
            }, 300);
    } else {
        // Remove all inline style from jquery fadeIn function to reset menu state
        $('#side-menu').removeAttr('style');
    }
}

/**
 * Useless for Backoffice
 */
// Draggable panels
/*function WinMove() {
    var element = "[class*=col]";
    var handle = ".ibox-title";
    var connect = "[class*=col]";
    $(element).sortable(
        {
            handle: handle,
            connectWith: connect,
            tolerance: 'pointer',
            forcePlaceholderSize: true,
            opacity: 0.8
        })
        .disableSelection();
}*/


// Config box

// Enable/disable fixed top navbar
fixedNavBarElement.click(function (){
    if (fixedNavBarElement.is(':checked')){
        $(".navbar-static-top").removeClass('navbar-static-top').addClass('navbar-fixed-top');
        bodyElement.removeClass('boxed-layout');
        bodyElement.addClass('fixed-nav');
        $('#boxedlayout').prop('checked', false);

        if (localStorageSupport){
            localStorage.setItem("boxedlayout",'off');
        }

        if (localStorageSupport){
            localStorage.setItem("fixednavbar",'on');
        }
    } else{
        $(".navbar-fixed-top").removeClass('navbar-fixed-top').addClass('navbar-static-top');
        bodyElement.removeClass('fixed-nav');
        bodyElement.removeClass('fixed-nav-basic');
        $('#fixednavbar2').prop('checked', false);

        if (localStorageSupport){
            localStorage.setItem("fixednavbar",'off');
        }

        if (localStorageSupport){
            localStorage.setItem("fixednavbar2",'off');
        }
    }
});

// Enable/disable fixed sidebar
fixedSideBarElement.click(function (){
    if (fixedSideBarElement.is(':checked')){
        bodyElement.addClass('fixed-sidebar');
        sideBarCollapseElement.slimScroll({
            height: '100%',
            railOpacity: 0.9
        });

        if (localStorageSupport){
            localStorage.setItem("fixedsidebar",'on');
        }
    } else{
        sideBarCollapseElement.slimscroll({destroy: true});
        sideBarCollapseElement.attr('style', '');
        bodyElement.removeClass('fixed-sidebar');

        if (localStorageSupport){
            localStorage.setItem("fixedsidebar",'off');
        }
    }
});

