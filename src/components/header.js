import React from 'react';
import Link from 'gatsby-link';

import Nav from './nav';
import Logo from './logo';

export default class Header extends React.Component {
	render() {
		return (
			<header>
				<div className="banner navbar navbar-social">
					<div className="container">
						{this.renderSocial()}
					</div>
				</div>
				<div className="banner navbar navbar-main">
					<div className="container">
						<div className="navbar-header">
							<button type="button" className="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
								<span className="icon-bar"/>
								<span className="icon-bar"/>
								<span className="icon-bar"/>
							</button>
							<Link to="/" className="navbar-brand">
								<div className="tagprints-logo-svg" data-theme="default">
									<Logo/>
								</div>
							</Link>
						</div>
						<nav className="collapse navbar-collapse" role="navigation">
							<div className="navbar-right">
								<Nav menu={this.props.menu}/>
								<ul className="nav navbar-nav navbar-cta">
									<li>
										<Link className="btn btn-cta-transparent" to="/free-quote">Free Quote</Link>
									</li>
								</ul>
								{this.renderSocial()}
							</div>
						</nav>
					</div>
				</div>
			</header>
		);
	}

	renderSocial() {
		return (
			<ul className="nav navbar-nav navbar-right social-icons">
				<li>
					<a href="https://www.facebook.com/Tagprints/" target="_blank" rel="noopener noreferrer"><span className="fa fa-facebook"/></a>
				</li>
				<li>
					<a href="https://www.twitter.com/Tagprints/" target="_blank" rel="noopener noreferrer"><span className="fa fa-twitter"/></a>
				</li>
				<li className="separator"/>
				<li>
					<a href="tel:6309487779"><span className="fa fa-phone"/></a>
				</li>
				<li className="number">
					<a href="tel:6309487779">630-948-7779</a>
				</li>
			</ul>
		);
	}
}
