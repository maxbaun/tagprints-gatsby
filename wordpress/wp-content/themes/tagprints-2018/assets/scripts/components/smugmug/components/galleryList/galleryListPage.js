import React from 'react';
import GalleryList from './galleryList';
import {connect} from 'react-redux';
import {loadGalleries} from '../../actions/galleryActions';
import Loader from '../common/loader';
import {Link} from 'react-router';
import Constants from '../../constants';
import {unmountGalleryList} from '../../actions/galleryList';
import MasonryLayout from 'react-masonry-layout';
import GalleryListItem from './galleryListItem';
import Back from '../common/back';
import {CancelToken} from 'axios';

class GalleryListPage extends React.Component {
	constructor(props) {
		super(props);

		this.galleryLoad = this.galleryLoad.bind(this);

		this.cancel = CancelToken.source();
	}
	render() {
		const title = this.props.params.id.replace(/-/g, ' ');
		const btnStyle = {
			marginBottom: '15px',
			marginTop: '-15px'
		};
		const galleries = this.props.galleryList.map((gallery, colIndex) =>
			<GalleryListItem type="gallery" image={gallery.image} title={gallery.Title} url={Constants.BasePath + '/gallery/' + gallery.AlbumKey + '/' + gallery.NiceName} imageUri={gallery.Uris.HighlightImage.Uri} id={gallery.AlbumKey} key={colIndex + '-gallery'} />
		);

		const sizes = [
			{columns: 1, gutter: 15},
			{mq: '768px', columns: 2, gutter: 15},
			{mq: '1024px', columns: 3, gutter: 15}
		];

		return (
			<div className="gallery-list">
				{this.props.loading ? <Loader/> : null}
				<div className="text-center">
					<h1 className="title">{title}</h1>
				</div>
				<MasonryLayout infiniteScroll={this.galleryLoad} id="items" sizes={sizes}>
					{galleries}
				</MasonryLayout>
				<Back url={Constants.BasePath} text="Back To All" />
			</div>
		);
	}

	galleryLoad() {
		if (this.props.loading || this.start >= this.props.total) {
			return false;
		}

		if (!this.start && !this.count) {
			this.start = 1;
			this.count = 9;
		} else {
			this.start += this.count;
		}
		this.props.loadGalleries({start: this.start, count: this.count, folder: 'user/tagprints/' + this.props.params.id}, this.cancel);
	}

	componentWillUnmount() {
		this.props.unmountGalleryList();
		this.cancel.cancel();
	}

	componentWillMount() {
		this.galleryLoad();
	}
}

GalleryListPage.propTypes = {
	loadGalleries: React.PropTypes.func.isRequired
};

function mapStateToProps(state) {
	return {
		loading: state.galleryList.loading,
		galleryList: state.galleryList.galleries,
		total: state.galleryList.total
	};
}

export default connect(mapStateToProps, {loadGalleries, unmountGalleryList})(GalleryListPage);
