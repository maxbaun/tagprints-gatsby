import React from 'react';
import Link from 'gatsby-link';

import Nav from './nav';
import Logo from './logo';

export default class Footer extends React.Component {
	render() {
		return (
			<footer>
				<div className="footer-menu navbar navbar-main">
					<div className="container">
						<nav role="navigation">
							<Nav menu={this.props.menu}/>
							<ul className="nav navbar-nav social-icons">
								<li>
									<a href="https://www.facebook.com/Tagprints/" target="_blank" rel="noopener noreferrer"><span className="fa fa-facebook"/></a>
								</li>
								<li>
									<a href="https://www.twitter.com/Tagprints/" target="_blank" rel="noopener noreferrer"><span className="fa fa-twitter"/></a>
								</li>
							</ul>
						</nav>
					</div>
				</div>
				<div className="footer-copy">
					<p>© TagPrints Digital | Digital Marketing and Social Media Agency in Chicago 2015</p>
					<Link to="/privacy-policy">Privacy Policy</Link>
				</div>
			</footer>
		);
	}
}
