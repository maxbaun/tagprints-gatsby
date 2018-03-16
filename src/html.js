import React from 'react';
import PropTypes from 'prop-types';

let stylesStr;

if (process.env.NODE_ENV === `production`) {
	try {
		stylesStr = require(`!raw-loader!../public/main.css`);
	} catch (e) {
		console.log(e);
	}
}

export default class Html extends React.Component {
	static propTypes = {
		headComponents: PropTypes.node.isRequired,
		body: PropTypes.node.isRequired,
		postBodyComponents: PropTypes.node.isRequired
	};

	render() {
		let css;
		if (process.env.NODE_ENV === `production`) {
			css = (
				<style
					id="gatsby-inlined-css"
					dangerouslySetInnerHTML={{__html: stylesStr}} // eslint-disable-line
				/>
			);
		}

		return (
			<html op="news" lang="en">
				<head>
					{this.props.headComponents}
					<meta name="referrer" content="origin"/>
					<meta charSet="utf-8"/>
					<meta
						name="description"
						content="Gatsby site powered by wordpress"
					/>
					<meta httpEquiv="X-UA-Compatible" content="IE=edge"/>
					<meta
						name="viewport"
						content="width=device-width, initial-scale=1.0"
					/>
					<title>Gatsby Wordpress</title>
					{css}
				</head>
				<body data-theme="default">
					<div
						id="___gatsby"
						dangerouslySetInnerHTML={{__html: this.props.body}} //eslint-disable-line
					/>
					{this.props.postBodyComponents}
					<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAZyFJjtN1lLLz3UoVF_mDelyTQOSZ0-rY"/>
					<script src="https://code.jquery.com/jquery-1.9.1.js"/>
					<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"/>
					<script src="/scripts/matchMedia.js"/>
					<script src="/scripts/jquery.json.js"/>
					<script src="/scripts/gravityforms.js"/>
					<script src="/scripts/placeholders.js"/>
					<script src="/scripts/gfplaceholderaddon.js"/>
				</body>
			</html>
		);
	}
}
