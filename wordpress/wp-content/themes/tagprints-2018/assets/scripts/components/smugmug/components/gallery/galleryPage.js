import React from 'react';
import {searchGalleries, loadGalleryImages} from '../../actions/galleryActions';
import {unmountGallery} from '../../actions/galleryList';
import NotFoundError from '../common/notFoundError';
import {connect} from 'react-redux';
import _ from 'lodash';
import Constants from '../../constants';
import Loader from '../common/loader';
import UnlockForm from './unlockForm';
import cookie from 'react-cookie';
import MasonryLayout from 'react-masonry-layout';
import Back from '../common/back';
import {CancelToken} from 'axios';

class GalleryPage extends React.Component {
	constructor() {
		super();
		this.loadMore = this.loadMore.bind(this);
		this.cancel = CancelToken.source();
		this.start = 1;
		this.count = 12;
	}
	render() {
		if (this.props.notFound) {
			return (<NotFoundError></NotFoundError>);
		}

		const images = this.props.gallery.images.map(image =>
			<div className="gallery-image show" key={image.ImageKey} style={this.generateDivSize(image)}>
				<a data-lightbox href={image.ArchivedUri.replace('-D.', '.').replace('/D/', '/O/')} data-title={'<a class="btn btn-cta lightbox-download" target="_blank" href="' + image.ArchivedUri + '">Download</a>'}>
					<img onLoad={this.onLoad.bind(this)} data-image={image.ImageKey} src={image.ArchivedUri.replace('-D.', '-M.').replace('/D/', '/M/')} />
				</a>
			</div>
		);

		const sizes = [
			{columns: 1, gutter: 15},
			{mq: '768px', columns: 2, gutter: 15},
			{mq: '1024px', columns: 3, gutter: 15}
		];

		return (
			<div className="gallery-single">
				<h1 className="title text-center">{this.props.gallery.Title}</h1>
				{this.props.loading ? <Loader/> : null}
				<MasonryLayout infiniteScroll={this.loadMore} id="items" sizes={sizes} infiniteScrollEnd={this.props.start >= this.props.total}>
					{images}
				</MasonryLayout>
				<Back url={Constants.BasePath} text="Back To All" />
				{this.props.showUnlock ? <UnlockForm unlock={this.props.unlockUri} album={this.props.gallery.AlbumKey} slug={this.props.params.slug}/> : ''}
			</div>
		);
	}

	onLoad(e) {
		e.target.parentNode.parentNode.classList.add('show');
	}

	generateDivSize(image) {
		let style = {};

		if (image.OriginalHeight > image.OriginalWidth) {
			// TALL PHOTOS
			style = {
				width: (image.OriginalWidth > 325) ? '325px' : image.OriginalWidth,
				height: (image.OriginalWidth > 325) ? 325 * image.OriginalHeight / image.OriginalWidth : image.OriginalHeight
			};
		} else {
			// WIDE PHOTOS
			style = {
				width: (image.OriginalWidth > 325) ? '325px' : image.OriginalWidth,
				height: (image.OriginalWidth > 325) ? (325 * image.OriginalHeight / image.OriginalWidth) + 'px' : image.OriginalHeight
			};
		}

		return style;
	}

	componentWillUnmount() {
		this.props.dispatch(unmountGallery());
		// this.masonry.off('layoutComplete', this.handleLayoutComplete);
		this.cancel.cancel();
	}

	loadMore() {
		if (this.props.loading || this.start >= this.props.total) {
			return false;
		}

		if (!this.start && !this.count) {
			this.start = 1;
			this.count = 12;
		} else {
			this.start += this.count;
		}

		this.props.dispatch(loadGalleryImages({
			start: this.start,
			count: this.count,
			albumKey: this.props.gallery.AlbumKey
		}, this.cancel));
	}

	componentWillMount() {
		this.props.dispatch(loadGalleryImages({
			albumKey: this.props.params.albumKey,
			start: this.start,
			count: this.count
		}, this.cancel));

		this.props.dispatch(searchGalleries({
			albumKey: this.props.params.albumKey
		}, this.cancel));
	}
}

function mapStateToProps(state) {
	state.galleryPage.cookies.forEach(c => {
		cookie.save(c.name, c.value);
	});
	return {
		gallery: state.galleryPage.gallery,
		loading: state.galleryPage.loading,
		notFound: state.galleryPage.notFound,
		showUnlock: state.galleryPage.showUnlock,
		unlockUri: state.galleryPage.unlockUri,
		cookies: state.galleryPage.cookies,
		total: state.galleryPage.gallery.total
	};
}

export default connect(mapStateToProps)(GalleryPage);
