import React from 'react';
import PropTypes from 'prop-types';
import graphql from 'graphql';
import {fromJS} from 'immutable';
import Intercom from 'react-intercom';

import '../css/main.scss';
import UTIL from '../scripts/main.js';

import Header from '../components/header';
import Footer from '../components/footer';

export default class Layout extends React.Component {
	static propTypes = {
		data: PropTypes.object.isRequired,
		children: PropTypes.func.isRequired
	};

	componentDidMount() {
		this.changeTheme();
	}

	componentWillReceiveProps(nextProps) {
		if (nextProps.location.pathname !== this.props.location.pathname) {
			this.changeTheme(nextProps.location, true);
		}
	}

	changeTheme(location = this.props.location, animate = false) {
		const pathname = location.pathname.split('/')[1];

		const body = document.querySelector('body');
		const theme = this.getTheme(pathname);

		if (animate) {
			body.classList.add('page-transition');
		}

		body.setAttribute('data-theme', theme);

		if (animate) {
			setTimeout(() => {
				body.classList.remove('page-transition');
			}, 300);
		}
	}

	getTheme(pathname) {
		let theme = 'default';

		switch (pathname) {
			case 'array13':
				theme = 'array13';
				break;
			default:
				theme = 'default';
				break;
		}

		return theme;
	}

	render() {
		const menu = this.props.data ? fromJS(this.props.data.wordpressWpApiMenusMenusItems) : fromJS({});

		return (
			<div>
				<Intercom appID="j6yjy1ql"/>
				<Header menu={menu}/>
				{this.props.children()}
				<Footer menu={menu}/>
			</div>
		);
	}
}

export const menuQuery = graphql`
query mainNavQuery {
	wordpressWpApiMenusMenusItems (wordpress_id: {eq: 2}) {
		...Nav
	}
}`;
