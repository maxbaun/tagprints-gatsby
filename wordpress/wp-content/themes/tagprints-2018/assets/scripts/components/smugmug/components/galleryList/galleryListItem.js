import React from 'react';
import {Link} from 'react-router';
import {connect} from 'react-redux';
import Constants from '../../constants';
import {loadGalleryCover} from '../../actions/galleryActions';
import {loadFolderCover} from '../../actions/folderActions';
import {CancelToken} from 'axios';

class GalleryListItem extends React.Component {
	constructor() {
		super();
		this.cancel = CancelToken.source();
	}
	render() {
		let image = '';
		if (this.props.image && this.props.image.ArchivedUri) {
			image = this.props.image.ArchivedUri.replace('-D.', '-S.').replace('/D/', '/S/');
		}
		const previewStyle = {
			backgroundImage: 'url(' + image + ')'
		};
		return (
			<div className="gallery-list-item" style={this.props.style}>
				<div className="preview" style={previewStyle}>
					{(() => {
						if (image !== '') {
							return <div className="image"><img src={image} onLoad={this.onLoad.bind(this)}/></div>;
						}
					})()}
					<div className="overlay">
						<div className="vertical-center text-center">
							<div className="vertical-center-inner">
								<Link className="btn btn-cta-white" to={this.props.url}>View More</Link>
							</div>
						</div>
					</div>
				</div>
				<div className="content">
					<Link to={this.props.url}>
						<p className="title">{this.props.title}</p>
					</Link>
				</div>
			</div>
		);
	}

	onLoad(e) {
		e.target.parentNode.parentNode.parentNode.classList.add('show');
	}

	componentWillMount() {
		if (!this.props.image && this.props.type === 'gallery') {
			this.props.dispatch(loadGalleryCover(this.props.imageUri, this.props.id, this.cancel));
		}

		if (!this.props.image && this.props.type === 'folder') {
			this.props.dispatch(loadFolderCover(this.props.imageUri, this.props.id, this.cancel));
		}
	}

	componentWillUnmount() {
		this.cancel.cancel();
	}
}

GalleryListItem.propTypes = {
	title: React.PropTypes.string.isRequired,
	imageUri: React.PropTypes.string.isRequired,
	url: React.PropTypes.string.isRequired,
	id: React.PropTypes.string.isRequired,
	type: React.PropTypes.string.isRequired
};

export default connect()(GalleryListItem);
