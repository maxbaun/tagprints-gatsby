import React from 'react';
import {connect} from 'react-redux';
import _ from 'lodash';
// import InfiniteScroll from 'react-infinite-scroller';
import GalleryListItem from './galleryListItem';
import {loadGalleries} from '../../actions/galleryActions';
import Masonry from 'react-masonry-component';

class GalleryList extends React.Component {
	constructor(props) {
		super(props);
		this.start = 1;
		this.count = 9;

		// this.handleScroll = this.handleScroll.bind(this);
	}

	render() {
		const galleries = this.props.galleryList.map((gallery, colIndex) =>
			<GalleryListItem gallery={gallery} key={colIndex} style={{
				width: '236px',
				height: `${colIndex % 2 === 0 ? 4 * 50 : 50}px`,
				display: 'block',
				background: 'rgba(0,0,0,0.7)'
			}} />
		);

		if (this.props.rows) {
			return (
				<Masonry elementType={'div'} className="row">
					{galleries}
				</Masonry>
			);
		}

		// return (
		// 	<div className="featured-case-studies gallery-list" ref="content">
		// 		<h1 className="text-center title">Gallery</h1>
		// 		<InfiniteScroll pageStart={this.currentPage} loadMore={this.loadMore.bind(this)} hasMore={this.props.hasMore && !this.props.loading}>
		// 			{this.props.loading ? <Loader/> : null}
		// 			{galleries}
		// 		</InfiniteScroll>
		// 	</div>
		// );
		return (
			<span>
				{galleries}
			</span>
		);
	}

	loadMore() {
		this.start += this.count;
		this.props.loadGalleries({start: this.start, count: this.count, folder: this.props.folder});
	}

	componentWillMount() {
		if (!this.props.galleryList.length) {
			this.props.dispatch(loadGalleries({page: this.start, count: this.count, folder: this.props.folder}));
		}
		// window.addEventListener('scroll', this.handleScroll);
	}

	componentWillUnmount() {
		// window.removeEventListener('scroll', this.handleScroll);
	}

	// handleScroll(e) {
	// 	let scrollTop = e.srcElement.body.scrollTop + window.innerHeight + 100;
	// 	let height = e.srcElement.body.offsetHeight;
	// 	if (scrollTop >= height && this.props.hasMore && this.start < this.props.total && !this.props.loading) {
	// 		this.loadMore();
	// 		console.log('loading more');
	// 	}
	// }
}

function mapStateToProps(state) {
	return {
		galleryList: state.galleryList.galleries,
		hasMore: state.galleryList.hasMore,
		total: state.galleryList.total,
		loading: state.galleryList.loading
	};
}

GalleryList.propTypes = {
	folder: React.PropTypes.string.isRequired
};

export default connect(mapStateToProps)(GalleryList);
