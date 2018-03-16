import React from 'react';
import graphql from 'graphql';
import {fromJS} from 'immutable';
import Link from 'gatsby-link';


export default class Nav extends React.Component {
	render() {
		const {menu} = this.props;

		if (!menu || !menu.get('items')) {
			return null;
		}

		return (
			<ul id="menu-primary-navigation" className="nav navbar-nav main-navigation">
				{menu.get('items').map(item => {
					let children = item.get('children');
					let atts = {};
					let linkClasses = [];
					let liClasses = [item.get('classes').split(' ')];

					if (children) {
						atts = {
							...atts,
							'data-toggle': 'dropdown-toggle',
							'aria-haspopup': true
						};

						liClasses.push('dropdown');
						linkClasses.push('dropdown-toggle');
					}
					return (
						<li key={item.get('url')} className={liClasses.join(' ')}>
							<Link
								to={link(item.get('url'))}
								className={linkClasses.join(' ')} {...atts}
							>
								{item.get('title')}
								{children ? <span className="caret"/> : null}
							</Link>
							{children ?
								<ul role="menu" className="dropdown-menu">
									{children.map(child => {
										return (
											<li key={child.get('url')} className={child.get('classes')}>
												<Link
													to={link(child.get('url'))}
												>
													{child.get('title')}
												</Link>
											</li>
										);
									})}
								</ul> : null
							}
						</li>
					);
				})}
			</ul>
		);
	}
}

function link(url) {
	return url.replace('http://159.65.240.158', '');
}

export const query = graphql`
fragment Nav on wordpress__wp_api_menus_menus_items {
  id: wordpress_id,
  items {
	title,
	url,
	classes,
	children: wordpress_children {
	  title,
	  url,
	  classes
	}
  }
}
`;
