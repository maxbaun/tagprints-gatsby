const $ = require('jquery');

const headerHeight = $('header').height();
const footerHeight = $('footer').height();
const windowHeight = $(window).height();
const wrap = $('[data-module="our-work-loader"]');
const loader = $(wrap).find('[data-loader]');
const app = $(wrap).find('[data-app]');

if ($('#ourWorkWrap').length === 0) {
	showLoader();

	$(wrap).on('our-work-loaded', hideLoader);
} else {
	hideLoader();
}

function showLoader() {
	$(wrap).height(windowHeight - headerHeight - footerHeight);
	$(loader).addClass('active');
}

function hideLoader() {
	$(wrap).css('height', null);
	$(wrap).css('overflow', null);
	$(wrap).removeClass('active');

	setTimeout(() => {
		$(app).addClass('active');
		$(loader).remove();
	}, 150);
}
