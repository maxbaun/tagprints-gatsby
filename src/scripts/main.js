'use strict';

require('raf/polyfill');
const $ = require('jquery');

if (typeof window !== 'undefined') {
	window.jQuery = $;
	window.$ = $;
	window.jquery = $;

	require('bootstrap-sass');
	require('flickity');
	require('./vendor/lightbox');
	require('jquery-ui-bundle');
	require('waypoints/lib/jquery.waypoints.js');
	require('./components/image-fade.js');
	require('./vendor/gravityforms');
	require('./vendor/matchMedia');

	window.initBackButtons = function () {
		var $caseStudy = $('article.case_study');
		var $fixedButtons = $('#fixed-buttons');
		var $btnBack = $fixedButtons.find('#btn-all-case-studies');

		$caseStudy.waypoint(function (direction) {
			if (direction === 'down') {
				$fixedButtons.addClass('active');
				$btnBack.addClass('active');
			} else {
				$fixedButtons.removeClass('active');
				$btnBack.removeClass('active');
			}
		});
	};
}

// Use this variable to set up the common and page specific functions. If you
// rename this variable, you will also need to rename the namespace below.
var tagPrintsFormatting = {
	carouselData: 'href',
	carouselDataSlideIndex: 'data-slide-index'
};

var yPosition = 0;
var imageAnimation = null;

var cutlass = {
	// All pages
	common: {
		init: function () {
			require('./components/our-work-loader.js');

			// DISABLE RIGHT click
			document.addEventListener('contextmenu', event => event.preventDefault());

			$(window).on('scroll', () => {
				var $gallery = $('#tagprints-smugmug');
				var $fixedButtons = $('#fixed-buttons');
				var $btnBack = $fixedButtons.find('#btn-all-galleries');
				if ($gallery.data('waypoint') === window.location.href) {
					return;
				}
				$gallery.waypoint(function (direction) {
					$gallery.data('waypoint', window.location.href);
					if (direction === 'down') {
						$fixedButtons.addClass('active');
						$btnBack.addClass('active');
					} else {
						$fixedButtons.removeClass('active');
						$btnBack.removeClass('active');
					}
				});
			});

			$('.image-fade').ImageFade(); //eslint-disable-line

			$('.gif-mode').click(function () {
				var targetSelector = $(this).data('target');
				var target = $(targetSelector);

				if (!targetSelector) {
					return;
				}

				$(this).siblings('.gif-mode').css('display', 'block');
				$(this).hide();

				target.find('.team-member').toggleClass('active');
			});

			function scrollTo(selector) {
				var elem = $(selector);
				var top = elem.offset().top;

				if (!selector || !elem) {
					return;
				}

				$('html, body').animate({
					scrollTop: top
				}, {
					duration: 300,
					easing: 'swing'
				});
			}

			$(document).on('click', 'a[data-scroll]', function (e) {
				e.preventDefault();
				var selector = $(this).attr('data-scroll');
				scrollTo(selector);
			});

			$('.case-study').click(function (e) {
				e.preventDefault();
				var link = $(this).data('href');
				if (link) {
					window.location = link;
				}
			});

			$('#upload_logo_button').click(function () {
				tb_show('Upload a logo', 'media-upload.php?referer=tagprints-settings&type=image&TB_iframe=true&post_id=0', false);
				return false;
			});

			window.send_to_editor = function (html) { //eslint-disable-line
				var $img = $($(html).first('img'));
				var imageUrl = $img.attr('src');
				var imageId = $img.data('id');
				$('#logo_image').val(imageUrl);
				$('#logo_image_id').val(imageId);
				tb_remove(); //eslint-disable-line
			};

			var $styles = $('body').find('style');
			$('head').append($styles);

			$('.hover').bind('touchstart touchend', function () {
				// e.preventDefault();
				$(this).toggleClass('hover_effect');
			});

			$('.carousel').each(function () {
				selectCurrentIndex($(this));
			});

			$('.carousel').bind('slide.bs.carousel', function () {
				$('.carousel img').each(function () {
					let img = $(this);
					img.attr('height', img.attr('data-height'));
					img.attr('width', img.attr('data-width'));
				});
			});

			$('.datepicker').each(function () {
				let rand = Math.floor((Math.random() * 100) + 1);
				let element = jQuery(this);
				let inputId = this.id + '-' + rand;
				let thisID = this.id + '-' + rand;
				let optionsObj = {
					yearRange: '-100:+20',
					showOn: 'focus',
					dateFormat: 'mm/dd/yy',
					changeMonth: true,
					changeYear: true,
					suppressDatePicker: false,
					onClose: function () {
						element.focus();
						var self = this;
						this.suppressDatePicker = true;
						setTimeout(function () {
							self.suppressDatePicker = false;
						}, 200);
					},
					beforeShow: function () {
						return !this.suppressDatePicker;
					}
				};

				if (element.hasClass('dmy')) {
					optionsObj.dateFormat = 'dd/mm/yy';
				} else if (element.hasClass('dmy_dash')) {
					optionsObj.dateFormat = 'dd-mm-yy';
				} else if (element.hasClass('dmy_dot')) {
					optionsObj.dateFormat = 'dd.mm.yy';
				} else if (element.hasClass('ymd_slash')) {
					optionsObj.dateFormat = 'yy/mm/dd';
				} else if (element.hasClass('ymd_dash')) {
					optionsObj.dateFormat = 'yy-mm-dd';
				} else if (element.hasClass('ymd_dot')) {
					optionsObj.dateFormat = 'yy.mm.dd';
				}

				if (element.hasClass('datepicker_with_icon')) {
					optionsObj.showOn = 'both';
					optionsObj.buttonImage = jQuery('#gforms_calendar_icon_' + inputId).val();
					optionsObj.buttonImageOnly = true;
				}

				inputId = inputId.split('_');

				// allow the user to override the datepicker options object
				optionsObj = gform.applyFilters('gform_datepicker_options_pre_init', optionsObj, inputId[1], thisID);
				// element.attr('id', thisID);
				// console.log(optionsObj);
				element.datepicker(optionsObj);
			});

			$('input,select,textarea').each(function () {
				$(this).addClass('LoNotSensitive');
			});

			window.__lo_site_id = 45212; //eslint-disable-line
			let wa = document.createElement('script');
			wa.type = 'text/javascript';
			wa.async = true;
			wa.src = 'https://d10lpsik1i8c69.cloudfront.net/w.js';

			let s = document.getElementsByTagName('script')[0];
			s.parentNode.insertBefore(wa, s);

			$('.carousel').bind('slid.bs.carousel', function () {
				selectCurrentIndex($(this));
			});
			function selectCurrentIndex($elem) {
				var selector = '#' + $elem.attr('id') + ' .active';
				var selector2 = '#' + $elem.attr('id') + ' .item';
				var currentIndex = $(selector).index(selector2);

				var itemsSelector = 'a[href="#' + $elem.attr('id') + '"]';
				$(itemsSelector).removeClass('active');
				var currentActiveItemSelector = 'a[href="#' + $elem.attr('id') + '"]a[' + tagPrintsFormatting.carouselDataSlideIndex + '="' + currentIndex + '"]';
				$(currentActiveItemSelector).addClass('active');
			}

			$('.carousel-nav').click(function (e) {
				e.preventDefault();
				let $elem;
				let $parent;
				if ($(this).is('a')) {
					$elem = $(this);
					$parent = $(this).parent().parent();
				} else if ($(this).is('li')) {
					$elem = $(this).find('a').first();
					$parent = $(this).parent();
				}

				$parent.find('.carousel-nav').removeClass('active');
				$elem.addClass('active');

				if ($elem && $elem !== '') {
					let $carousel = $($elem.attr(tagPrintsFormatting.carouselData));
					var slide = parseInt($elem.attr(tagPrintsFormatting.carouselDataSlideIndex), 10);
					$carousel.carousel(slide);
				}
			});

			adjustCourselImagePadding();

			$('.search-bar .icon a').click(function (e) {
				e.preventDefault();
				var elem = $(this).attr('data-open');
				var $elem = $(elem);
				$elem.toggleClass('open');
			});

			$('.absolute-image img').each(function () {
				repositionAbsoluteImage($(this).parents('.absolute-image').first());
			});

			$('.absolute-image img').load(function () {
				repositionAbsoluteImage($(this).parents('.absolute-image').first());
			});

			$('.spbp-gallery-toggle').click(function (e) {
				e.preventDefault();
				var target = $(this).data('toggle');
				var more = $(this).data('more');
				var less = $(this).data('less');
				var $target = $(target);
				var $text = $($(this).find('.spbp-gallery-toggle-text'));
				var active = $(this).hasClass('active');

				if (active) {
					$(this).removeClass('active');
					$target.slideUp();
					$text.text(more);
				} else {
					$(this).addClass('active');
					$target.slideDown();
					$text.text(less);
				}
			});

			// $socialNav = $('.navbar-social ul').clone().removeClass('navbar-right');
			// $('.navbar-collapse .navbar-right').append($socialNav);

			$(window).resize(function () {
				$('.absolute-image').each(function () {
					repositionAbsoluteImage($(this));
				});

				window.cancelAnimationFrame(imageAnimation);
				setupImageAnimates();
				// plotPoints($('.map'));
			});

			function repositionAbsoluteImage($elem) {
				var height = $elem.find('img').height();
				if ($elem.hasClass('absolute-image-full')) {
					let extend = $elem.data('extend-top');
					$elem.css('height', (height - extend));
				} else {
					$elem.css('margin-top', height);
					$elem.css('height', height / 3);
				}
			}

			// Set the Y position of the window if a modal is open
			$(document).click('[data-toggle="modal"]', function () {
				yPosition = ($(window).scrollTop() || $('body').scrollTop());
			});

			// Modal fixes for mobile - scroll back to the original y position
			$('.modal').on('hide.bs.modal', function () {
				var mobile = $(window).width() <= 768;

				if (mobile) {
					$('html, body').animate({
						scrollTop: yPosition
					}, {
						duration: 0
					});
				}
			});

			// Modal fixes for mobile - scroll to the top of the page after the modal is open
			$('.modal').on('shown.bs.modal', function () {
				var mobile = $(window).width() <= 768;

				if (mobile) {
					$('html, body').animate({
						scrollTop: 0
					}, {
						duration: 0
					});
				}
			});

			/** *****************************************************
			Async Page Load
			****************************************************** */
			$(document).on('click', '.async-page-load a', function (e) {
				e.preventDefault();
				var $link = $(e.target);
				var bodyTheme = $link.attr('title').toLowerCase();
				var href = $link.attr('href');

				$('main').html('');
				$('footer').html('');

				$('body')
					.addClass('page-transition')
					.delay(150)
					.queue(function (next) {
						$(this).attr('data-theme', bodyTheme);
						next();
					})
					.delay(150)
					.queue(function (next) {
						$(this).removeClass('page-transition');
						next();
					});

				$.get(href, function (res) {
					var $html = $(res);
					var $main;
					var $footer;
					var title;
					$html.each((index, node) => {
						if (node.nodeName.toLowerCase() === 'title') {
							title = $(node).html();
						}
						if (node.nodeName.toLowerCase() === 'main') {
							$main = $(node);
						}
						if (node.nodeName.toLowerCase() === 'footer') {
							$footer = $(node);
						}
					});

					window.history.pushState({}, title, href);
					document.title = title;
					$('main')
						.hide()
						.delay(100)
						.html($main.html())
						.fadeIn();
					$('footer')
						.hide()
						.delay(100)
						.html($footer.html())
						.fadeIn();

					setupImageAnimates();
				});
			});

			/** *****************************************************
			Image Animate
			****************************************************** */
			var ImageAnimate = function (elem) {
				var self = this;

				self.timePerFrame = 70;
				self.timeWhenLastUpdate = null;
				self.timeFromLastUpdate = null;
				self.direction = 1;

				self.elem = elem;
				self.img = elem.querySelector('img');
				self.frameSize = getImageFrameSize(elem);
				self.frameCount = parseInt(self.elem.getAttribute('data-frame-count'), 10);
				self.currentFrame = 0;

				self.init = function () {
					self.elem.style.setProperty('height', Math.floor(self.frameSize) - 1 + 'px'); // subtract 1 to prevent overflow
					self.elem.classList.add('active');
					self.startImageAnimation();
				};

				self.startImageAnimation = function () {
					imageAnimation = window.requestAnimationFrame(self.step);
				};

				self.step = function (startTime) {
					if (!self.timeWhenLastUpdate) {
						self.timeWhenLastUpdate = startTime;
					}

					self.timeFromLastUpdate = startTime - self.timeWhenLastUpdate;

					if (self.timeFromLastUpdate > self.timePerFrame) {
						self.timeWhenLastUpdate = startTime;

						let frame = self.currentFrame;

						if (frame === self.frameCount - 1) {
							self.direction = -1;
						}

						if (frame === 0) {
							self.direction = 1;
						}

						if (self.direction === 1) {
							frame++;
						} else {
							frame--;
						}

						let transform = self.frameSize * frame * -1;
						self.img.style.setProperty('transform', 'translate3d(0px, ' + transform + 'px, 0px)');
						self.currentFrame = frame;
					}

					imageAnimation = window.requestAnimationFrame(self.step);
				};

				function getImageFrameSize(elem) {
					let imageWidth = parseFloat(elem.getAttribute('data-width'));
					let imageHeight = parseFloat(elem.getAttribute('data-height'));
					let frameCount = parseInt(elem.getAttribute('data-frame-count'), 10);
					let actualWidth = elem.offsetWidth;
					let actualHeight = imageHeight * actualWidth / imageWidth;

					let actualFrameSize = actualHeight / frameCount;

					return actualFrameSize;
				}

				self.init();

				return self;
			};
			function setupImageAnimates() {
				var animates = document.querySelectorAll('[data-image-animate]');

				for (var i = 0; i < animates.length; i++) {
					var animate = animates[i];
					var img = animate.querySelector('img');
					img.addEventListener('load', animateImageLoaded(animate));

					if (img.complete) {
						animateImageLoaded(animate)();
					}
				}
			}

			function animateImageLoaded(elem) {
				return function () {
					new ImageAnimate(elem); //eslint-disable-line
				};
			}

			setupImageAnimates();

			/** *****************************************************
			GOOGLE MAPS
			****************************************************** */
			$('.google-map').each(function () {
				let mapId = $(this).attr('id');
				let $map = $('#' + mapId);
				let latitude = parseFloat($map.attr('data-lat'));
				let longitude = parseFloat($map.attr('data-long'));

				if (typeof google !== 'undefined') {
					var myMarker = new google.maps.LatLng(latitude, longitude);
					google.maps.event.addDomListener(window, 'load', initialize(mapId, myMarker));
				}
			});
			var mapStyles = [
				{
					featureType: 'all',
					elementType: 'all',
					stylers: [
						{saturation: -100}
					]
				}
			];
			function initialize(mapId, myMarker) {
				var mapOptions = {
					scrollwheel: false,
					center: myMarker,
					zoom: 17,
					panControl: false,
					zoomControl: false,
					mapTypeControl: false,
					scaleControl: false,
					streetViewControl: false,
					mapTypeControlOptions: {
						mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'grey']
					},
					styles: [{
						stylers: [{
							saturation: -100
						}]
					}]
				};

				var map = new google.maps.Map(document.getElementById(mapId), mapOptions); //eslint-disable-line

				var mapType = new google.maps.StyledMapType(mapStyles, {name: 'Grayscale'});
				map.mapTypes.set('grey', mapType);
				// map.setMapTypeId('grey');

				// if(!Modernizr && Modernizr != 'undefined')
				//   var image = (Modernizr.retina) ? $map.attr("data-marker-retina"): $map.attr("data-marker");
				// var $map = $("#"+mapId);
				// var image = $map.attr("data-marker")
				// var marker = new google.maps.Marker({
				//   position: myMarker,
				//   map: map,
				//   icon: image
				// });
			}

			$('.carousel.multiple .item').each(function () {
				var next = $(this).next();
				if (!next.length) {
					next = $(this).siblings(':first');
				}
				next.children(':first-child').clone().appendTo($(this));

				if (next.next().length > 0) {
					next.next().children(':first-child').clone().appendTo($(this)).addClass('rightest');
				} else {
					$(this).siblings(':first').children(':first-child').clone().appendTo($(this));
				}
			});

			function adjustCourselImagePadding() {
				$('.carousel .item').each(function () {
					var dataTop = $(this).attr('data-top');
					// var $img = $(this).first('img');
					// var imageHeight = $img.height();
					// var padding = imageHeight;

					if (parseFloat(dataTop) > 0) {
						// padding = imageHeight * dataTop;
					}

					// var captionHeight = parseInt($(this).find('.carousel-caption').css('top')); //$(this).find('.carousel-caption').height();
					// $(this).find('.carousel-caption').children().each(function () {
					// 	captionHeight += $(this).height();
					// });

					// $(this).css('padding-top',padding - captionHeight);
				});
			}
		}
	},
	// Home page
	home: {
		init: function () {
			// JavaScript to be fired on the home page
		}
	},
	// About us page, note the change from about-us to about_us.
	about_us: { //eslint-disable-line
		init: function () {
			// JavaScript to be fired on the about us page
		}
	},
	single_case_study: { //eslint-disable-line
		init: function () {
			// JavaScript to be fired on the single case study page
		}
	},

	landing_page : { //eslint-disable-line
		init: function () {
			function renderSelect() {
				[].slice.call(document.querySelectorAll('.custom-select')).forEach(function (el) {
					var $select = $(el).find('select').first();
					if (!$select) {
						return;
					}
					$select.addClass('cs-select cs-skin-border');
					$select.find('option').first().attr('disabled', true);
					$(el).children().remove();
					$(el).append($select);

					let selFx = new SelectFx($select[0]); //eslint-disable-line
				});
			}

			$(document).bind('gform_post_render', function () {
				renderSelect();
			});

			renderSelect();
		}
	}
};

var UTIL = {
	fire: function (func, funcname, args) {
		var namespace = cutlass;
		funcname = (funcname === undefined) ? 'init' : funcname;
		if (func !== '' && namespace[func] && typeof namespace[func][funcname] === 'function') {
			namespace[func][funcname](args);
		}
	},
	loadEvents: function () {
		UTIL.fire('common');

		$.each(document.body.className.replace(/-/g, '_').split(/\s+/), function (i, classnm) {
			UTIL.fire(classnm);
		});
	}
};

export default UTIL;
