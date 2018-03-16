import {
	FOLDER_LIST_LOAD,
	FOLDER_LIST_RECEIVED,
	FOLDER_LIST_THUMBNAIL_RECEIVED,
	FOLDER_LIST_INIT
} from '../constants';

export function folderListLoad() {
	return {
		type: FOLDER_LIST_LOAD
	};
}

export function folderListReceived(folderList) {
	return {
		type: FOLDER_LIST_RECEIVED,
		folderList
	};
}

export function folderListThumbnailReceived(gallery, id) {
	return {
		type: FOLDER_LIST_THUMBNAIL_RECEIVED,
		gallery,
		id
	};
}

export function unmountFolderList() {
	return {
		type: FOLDER_LIST_INIT
	};
}
