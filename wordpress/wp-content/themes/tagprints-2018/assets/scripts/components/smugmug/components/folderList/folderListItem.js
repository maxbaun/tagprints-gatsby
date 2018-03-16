import React from 'react';
import {Link} from 'react-router';
import {connect} from 'react-redux';
import Constants from '../../constants';
import {loadFolderCover} from '../../actions/folderActions';
import Masonry from 'react-masonry-component';


class FolderListItem extends React.Component {
	render() {
		const image = (this.props.folder.image && this.props.folder.image.ArchivedUri) ? this.props.folder.image.ArchivedUri.replace('-D.', '-S.').replace('/D/', '/S/') : '';
		const previewStyle = {
			backgroundImage: 'url(' + image + ')',
			backgroundSize: (this.props.folder.image && this.props.folder.image.ArchivedUri) ? 'cover' : '100%'
		};

		return (
			<div className="case-study gallery-list-item" style={this.props.style}>
				<div className="preview" style={previewStyle}>
					<div className="overlay">
						<div className="vertical-center text-center">
							<div className="vertical-center-inner">
								<Link className="btn btn-cta-white" to={Constants.BasePath + '/folder/' + this.props.folder.UrlName}>Read More</Link>
							</div>
						</div>
					</div>
				</div>
				<div className="content">
					<Link to={Constants.BasePath + '/folder/' + this.props.folder.UrlName}>
						<p className="title">{this.props.folder.Name}</p>
					</Link>
				</div>
			</div>
		);
	}

	componentWillMount() {
		this.props.dispatch(loadFolderCover(this.props.folder.Uris.HighlightImage.Uri, this.props.folder.NodeID));
	}
}

FolderListItem.propTypes = {
	folder: React.PropTypes.object.isRequired
};

function mapStateToProps(state) {
	return state;
}

export default connect(mapStateToProps)(FolderListItem);
