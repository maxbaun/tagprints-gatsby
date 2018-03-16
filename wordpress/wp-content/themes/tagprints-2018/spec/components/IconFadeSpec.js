describe('Icon Fade Tests', () => {
	let rewire = require('rewire');
	let iconFade = require('../../assets/scripts/components/icon-fade');
	var jsdom = require('jsdom');
	var $ = null;
	let html = null;
	beforeEach(done => {
		html = `
		<div class="icon-group" data-speed="1000">
		<span class="svg-icon"></span>
		<span class="svg-icon"></span>
		<span class="svg-icon"></span>
		</div>
		`;
		jsdom.env({
			html: '<html><body></body></html>',
			scripts: ['./spec/helpers/jquery.js', './dist/scripts/main.js'],
			done: function (err, window) {
				if (err) {
					console.log(err);
				}
				$ = window.jQuery;
				// IconFade = rewire('../../assets/scripts/components/icon-fade');
				done();
			}
		});
	});
	it('Should initialize the element', () => {
		let elem = iconFade($(html));
		console.log(elem);
		// let res = IconFade.__get__('initializeComponent')(elem);
		// expect(res).toEqual({elem, speed: 1000});
	});
	xit('Should set the first element to active', () => {
		let data = {
			elem: $(html),
			speed: 1000,
			children: $(html).find('span')
		};
		let res = IconFade.__get__('setFirst')(data);
		let child = $(res.children[0]);
		expect(child.hasClass('active')).toBeTruthy();
	});
});
