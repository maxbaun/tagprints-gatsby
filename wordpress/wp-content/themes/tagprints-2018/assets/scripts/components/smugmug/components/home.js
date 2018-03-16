import React from 'react';
import FolderList from './folderList/folderList';
import GalleryList from './galleryList/galleryList';
import Loader from './common/loader';
import {connect} from 'react-redux';
import {loadGalleries} from '../actions/galleryActions';
import {unmountGalleryList} from '../actions/galleryList';
import {unmountFolderList} from '../actions/folderList';
import {loadFolders} from '../actions/folderActions';
import MasonryLayout from 'react-masonry-layout';
import FolderListItem from './folderList/folderListItem';
import GalleryListItem from './galleryList/galleryListItem';
import Constants from '../constants';
import {CancelToken} from 'axios';

class Home extends React.Component {
	constructor(props) {
		super(props);

		this.galleryLoad = this.galleryLoad.bind(this);

		this.folderCancel = CancelToken.source();
		this.galleryCancel = CancelToken.source();
	}
	render() {
		// const {loadGalleries, loadFolders} = this.props;
		// const renderRows = false;

		// const style = {
		// 	width: '320px',
		// 	height: '325px',
		// 	display: 'block',
		// 	backgroundColor: 'rgba(0,0,0,0.7)'
		// };

		const folders = this.props.folderList.map((folder, colIndex) =>
			<GalleryListItem type="folder" image={folder.image} title={folder.Name} url={Constants.BasePath + '/folder/' + folder.UrlName} imageUri={folder.Uris.HighlightImage.Uri} id={folder.NodeID} key={colIndex + '-folder'} />
		);

		const galleries = this.props.galleryList.map((gallery, colIndex) =>
			<GalleryListItem type="gallery" image={gallery.image} title={gallery.Title} url={Constants.BasePath + '/gallery/' + gallery.AlbumKey + '/' + gallery.NiceName} imageUri={gallery.Uris.HighlightImage.Uri} id={gallery.AlbumKey} key={colIndex + '-gallery'} />
		);

		const nodes = folders.concat(galleries);

		const sizes = [
			{columns: 1, gutter: 15},
			{mq: '768px', columns: 2, gutter: 15},
			{mq: '1024px', columns: 3, gutter: 15}
		];

		return (
			<div className="event-photos">
				<h1 className="text-center title">Event Photos</h1>
				{this.props.loading ? <Loader/> : ''}
				<MasonryLayout infiniteScroll={this.galleryLoad} id="items" sizes={sizes}>
					{nodes}
				</MasonryLayout>
			</div>
		);
	}

	galleryLoad() {
		if (this.props.loading || this.start >= this.props.total) {
			return false;
		}

		if (!this.start && !this.count) {
			this.start = 1;
			this.count = 12;
		} else {
			this.start += this.count;
		}
		this.props.loadGalleries({start: this.start, count: this.count, folder: 'user/tagprints'}, this.galleryCancel);
	}

	componentWillMount() {
		if (!this.props.galleryList.length) {
			this.galleryLoad();
		}

		if (!this.props.folderList.length) {
			this.props.loadFolders(this.folderCancel);
		}
	}

	componentWillUnmount() {
		this.galleryCancel.cancel();
		this.folderCancel.cancel();

		this.props.unmountGalleryList();
		this.props.unmountFolderList();
	}
}

function mapStateToProps(state) {
	return {
		folderList: state.folderList.folders,
		galleryList: state.galleryList.galleries,
		total: state.galleryList.total,
		loading: state.folderList.loading || state.galleryList.loading
	};
}

Home.propTypes = {
	loadGalleries: React.PropTypes.func.isRequired,
	loadFolders: React.PropTypes.func.isRequired
};

export default connect(mapStateToProps, {loadGalleries, loadFolders, unmountGalleryList, unmountFolderList})(Home);
