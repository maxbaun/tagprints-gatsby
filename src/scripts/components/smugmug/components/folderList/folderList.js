import React from 'react';
import {connect} from 'react-redux';
import _ from 'lodash';
// import InfiniteScroll from 'react-infinite-scroller';
import FolderListItem from './folderListItem';
import Masonry from 'react-masonry-component';

class FolderList extends React.Component {
	render() {
		const folders = this.props.folderList.map((folder, colIndex) =>
				<FolderListItem folder={folder} key={colIndex}/>
			);

		if (this.props.rows) {
			return (
				<Masonry elementType={'div'} className="row">
					{folders}
				</Masonry>
			);
		}

		return (
			<span>
			{folders}
			</span>
		);
	}

	componentWillMount() {
		if (!this.props.folderList.length) {
			this.props.loadFolders();
		}
	}
}

function mapStateToProps(state) {
	return {
		folderList: state.folderList.folders,
		loading: state.folderList.loading
	};
}

FolderList.propTypes = {
	loadFolders: React.PropTypes.func.isRequired
};

export default connect(mapStateToProps)(FolderList);
