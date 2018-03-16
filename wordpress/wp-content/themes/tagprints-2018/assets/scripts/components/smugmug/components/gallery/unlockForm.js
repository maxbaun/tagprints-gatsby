import React from 'react';
import {unlockGallery} from '../../actions/galleryActions';
import {connect} from 'react-redux';
import _ from 'lodash';

class UnlockForm extends React.Component {
	constructor(props) {
		super(props);
		this.state = {
			password: ''
		};

		this.onChange = this.onChange.bind(this);
		this.onSubmit = this.onSubmit.bind(this);
	}
	render() {
		return (
			<div className="row">
				<div className="col-sm-6 col-sm-offset-3">
					<form onSubmit={this.onSubmit}>
						<input autoComplete="off" type="text" placeholder="password" name="password" value={this.state.password} onChange={this.onChange} className="form-control bordered"/>
						{this.props.invalidPassword ? <p>Invalid Password</p> : ''}
					</form>
				</div>
			</div>
		);
	}

	onChange(e) {
		this.setState({[e.target.name]: e.target.value});
	}

	onSubmit(e) {
		e.preventDefault();
		this.props.dispatch(unlockGallery(this.state.password, this.props.unlock, this.props.slug, this.props.album));
	}
}

function mapStateToProps(state) {
	return {
		invalidPassword: state.galleryPage.invalidPassword
	};
}

export default connect(mapStateToProps)(UnlockForm);
