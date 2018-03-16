import React from 'react';
import {Link} from 'react-router';
class Back extends React.Component {
	render() {
		return (
			<div id="fixed-buttons" className="text-center fixed-bottom">
				<Link id="btn-all-case-studies" className="btn btn-cta active" to={this.props.url}>{this.props.text}</Link>
			</div>
		);
	}
}

Back.propTypes = {
	url: React.PropTypes.string.isRequired,
	text: React.PropTypes.string.isRequired
};

export default Back;
