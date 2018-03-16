import {buildUrl} from './utils';
import Constants from '../constants';
import axios from 'axios';
import {folderListLoad, folderListReceived, folderListThumbnailReceived, unmountFolderList} from './folderList';

export function loadFolders(cancel) {
	return dispatch => {
		dispatch(folderListLoad());
		let data = {
			path: '/api/v2/folder/user/tagprints!folders'
		};
		let url = buildUrl(data);
		return axios.get(
			Constants.AjaxUrl,
			{
				cancelToken: cancel.token,
				params: {
					action: 'smugmug',
					url
				},
				timeout: 20000
			}
		).then(doc => {
			dispatch(folderListReceived(doc.data.data.Folder));
		}, () => {
			console.log('cancelled loading folder');
			dispatch(unmountFolderList());
		});
	};
}

export function loadFolderCover(path, id, cancel) {
	return dispatch => {
		dispatch(folderListLoad());
		let url = buildUrl({path});
		return axios.get(
			Constants.AjaxUrl,
			{
				cancelToken: cancel.token,
				params: {
					action: 'smugmug',
					url
				},
				timeout: 20000
			}
		).then(doc => {
			if (!doc.data.data.Image) {
				doc.data.data.Image = {
					ArchivedUri: '/wp-content/themes/tagprints-2015/assets/images/placeholder.png'
				};
			}
			dispatch(folderListThumbnailReceived(doc.data.data.Image, id));
		}, () => {
			dispatch(unmountFolderList());
		});
	};
}
