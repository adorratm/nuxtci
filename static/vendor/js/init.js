/** *************Init JS*********************
	
	TABLE OF CONTENTS
	---------------------------
	1.Ready function
	2.Load function
	3.Full height function
	4.pinkman function
	5.Chat App function
	6.Resize function
 ** ***************************************/

"use strict";
/*****Ready function start*****/
$(document).ready(function () {
	pinkman();
	/*Disabled*/
	$(document).on("click", "a.disabled,a:disabled", function (e) {
		return false;
	});
});
/*****Ready function end*****/

/*Variables*/
var height, width,
	$wrapper = $(".hk-wrapper"),
	$nav = $(".hk-nav"),
	$vertnaltNav = $(".hk-wrapper.hk-vertical-nav,.hk-wrapper.hk-alt-nav"),
	$horizontalNav = $(".hk-wrapper.hk-horizontal-nav"),
	$navbar = $(".hk-navbar");

/***** pinkman function start *****/
var pinkman = function () {

	/*Feather Icon*/
	var featherIcon = $('.feather-icon');
	if (featherIcon.length > 0) {
		feather.replace();
	}

	/*Tooltip*/
	if ($('[data-toggle="tooltip"]').length > 0)
		$('[data-toggle="tooltip"]').tooltip();

	/*Popover*/
	if ($('[data-toggle="popover"]').length > 0)
		$('[data-toggle="popover"]').popover()

	/*Navbar Collapse Animation*/
	var navbarNavCollapse = $('.hk-nav .navbar-nav  li');
	var navbarNavAnchor = '.hk-nav .navbar-nav  li a';
	$(document).on("click", navbarNavAnchor, function (e) {
		if ($(this).attr('aria-expanded') === "false")
			$(this).blur();
		$(this).parent().siblings().find('.collapse').collapse('hide');
		$(this).parent().find('.collapse').collapse('hide');
	});

	/*Card Remove*/
	$(document).on('click', '.card-close', function (e) {
		var effect = $(this).data('effect');
		$(this).closest('.card')[effect]();
		return false;
	});

	/*Accordion js*/
	$(document).on('show.bs.collapse', '.accordion .collapse', function (e) {
		$(this).siblings('.card-header').addClass('activestate');
	});

	$(document).on('hide.bs.collapse', '.accordion .collapse', function (e) {
		$(this).siblings('.card-header').removeClass('activestate');
	});

	/*Navbar Toggle*/
	$(document).on('click', '#navbar_toggle_btn', function (e) {
		$wrapper.toggleClass('hk-nav-toggle');
		$(window).trigger("resize");
		return false;
	});
	$(document).on('click', '#hk_nav_backdrop,#hk_nav_close', function (e) {
		$wrapper.removeClass('hk-nav-toggle');
		return false;
	});

	/*Settings panel Toggle*/
	$(document).on('click', '#settings_toggle_btn', function (e) {
		$wrapper.toggleClass('hk-settings-toggle');
		return false;
	});
	$(document).on('click', '#settings_panel_close', function (e) {
		$wrapper.removeClass('hk-settings-toggle');
		return false;
	});
	$(document).on('click', '#nav_light_select', function (e) {
		$nav.removeClass('hk-nav-dark').addClass('hk-nav-light');
		return false;
	});
	$(document).on('click', '#nav_dark_select', function (e) {
		$nav.removeClass('hk-nav-light').addClass('hk-nav-dark');
		return false;
	});
	$(document).on('click', '#nav_light_select,#nav_dark_select', function (e) {
		$('.hk-nav-select').find('.btn').removeClass('btn-outline-primary').addClass('btn-outline-light');
		$(this).removeClass('btn-outline-light').addClass('btn-outline-primary').blur();
		return false;
	});
	$(document).on('click', '#navtop_light_select,#navtop_dark_select', function (e) {
		$('.hk-navbar-select').find('.btn').removeClass('btn-outline-primary').addClass('btn-outline-light');
		$(this).removeClass('btn-outline-light').addClass('btn-outline-primary').blur();
		return false;
	});

	/*Search form Collapse*/
	$(document).on('click', '#navbar_search_btn', function (e) {
		$('html,body').animate({ scrollTop: 0 }, 'slow');
		$(".navbar-search input").focus();
		$wrapper.addClass('navbar-search-toggle');
		$(window).trigger("resize");
	});
	$(document).on('click', '#navbar_search_close', function (e) {
		$wrapper.removeClass('navbar-search-toggle');
		$(window).trigger("resize");
		return false;
	});

	/*Fullscreen Init Js*/
	$(document).on("click", ".full-screen", function (e) {
		$(this).parents('.card').toggleClass('fullscreen');
		$(window).trigger("resize");
		return false;
	});

};
/***** pinkman function end *****/

/***** Full height function start *****/
var setHeightWidth = function () {
	height = window.innerHeight;
	width = window.innerWidth;
	$('.full-height').css('height', (height));
	$('.hk-pg-wrapper').css('min-height', (height));

	/*****App Height for differnt brekpoints with Vertical & Alt menu*****/
};
/***** Full height function end *****/

/***** Resize function start *****/
$(window).on("resize", function () {
	setHeightWidth();
});
$(window).trigger("resize");
/***** Resize function end *****/

