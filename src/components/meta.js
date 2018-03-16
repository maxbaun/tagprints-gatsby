import React from 'react';
import Helmet from 'react-helmet';

const Meta = props => {
	const title = props.title || 'Chicago GIF Photo Booth Rentals &amp; Hashtag Printers';
	const description = props.description || 'Hashtag Printers and Social Photo Booth rentals built to capture branded memories at your events. From turnkey solutions to totally custom, challenge us!';
	const keywords = props.keywords;

	return (
		<Helmet>
			<title>{title}</title>
			<meta name="description" content={description}/>
			<meta name="keywords" content={keywords}/>
		</Helmet>
	);
};

export default Meta;
