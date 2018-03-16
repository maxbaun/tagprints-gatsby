import React from 'react';
import {Link} from 'react-router';
import Constants from '../../constants';

class NotFoundError extends React.Component {
	render() {
		return (
            <div className="404-error text-center">
				<h1 className="title">Gallery Not Found</h1>
                <Link to={Constants.BasePath} className="btn btn-cta">Back To Galleries</Link>
			</div>
		);
	}
}

export default NotFoundError;
