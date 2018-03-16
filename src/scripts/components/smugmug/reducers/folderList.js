import {FOLDER_LIST_LOAD, FOLDER_LIST_RECEIVED, FOLDER_LIST_THUMBNAIL_RECEIVED, FOLDER_LIST_INIT} from '../constants';

export default (state = {
	loading: false,
	folders: []
}, action = {}) => {
	switch (action.type) {
		case FOLDER_LIST_LOAD: {
			return {
				...state,
				loading: true
			};
		}
		case FOLDER_LIST_RECEIVED: {
			return {
				...state,
				folders: state.folders.concat(action.folderList)
			};
		}
		case FOLDER_LIST_THUMBNAIL_RECEIVED: {
			return {
				...state,
				loading: false,
				folders: state.folders.map(folder => {
					if (action.id === folder.NodeID) {
						folder.image = action.gallery;
					}
					return folder;
				})
			};
		}
		case FOLDER_LIST_INIT: {
			return {
				...state,
				loading: false,
				folders: []
			};
		}
		default: {
			return state;
		}
	}
};
