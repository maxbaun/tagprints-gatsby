'use strict';

const DefaultSpeed = 1000;

(function ($) {
	$.ImageFade = function (element, options) {
		var defaults = {
			foo: 'bar',
			onFoo: function () {}
		};

		var plugin = this;

		plugin.settings = {};

		let $element = $(element);

		var setChildren = function () {
			plugin.children = $element.children();
		};

		var setFirst = function () {
			$(plugin.children[0]).addClass('active');
			plugin.settings.currentIndex = 0;
		};

		var getNext = function () {
			if (plugin.settings.currentIndex > 0 && plugin.settings.currentIndex >= plugin.children.length - 1) {
				return 0;
			}
			return plugin.settings.currentIndex + 1;
		};

		var changeIcon = function () {
			$(plugin.children[plugin.settings.currentIndex]).removeClass('active');
			plugin.settings.currentIndex = getNext();
			$(plugin.children[plugin.settings.currentIndex]).addClass('active');
		};

		var startCycle = function () {
			setInterval(changeIcon, plugin.settings.speed || DefaultSpeed);
		};

		plugin.init = function () {
			plugin.settings = $.extend({}, defaults, options);
			plugin.settings.speed = parseInt($element.data('speed'), 10) || DefaultSpeed;
			setChildren();
			setFirst();
			startCycle();
		};

		// plugin.publicMethod = function () {
		// 	// code goes here
		// }
		plugin.init();
	};

	$.fn.ImageFade = function (options) {
		return this.each(function () {
			if (typeof $(this).data('ImageFade') === 'undefined') {
				var plugin = new $.ImageFade(this, options);
				$(this).data('ImageFade', plugin);
			}
		});
	};
})(jQuery);
