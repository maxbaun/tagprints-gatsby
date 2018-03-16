import axios from 'axios';
import Constants from '../constants';
import {unmountGallery, unmountGalleryList, galleryImagesReceived, galleryListReceived, galleryListThumbnailReceived, galleryListLoad, galleryLoad, searchGalleriesReceieved, searchGalleriesNotFound, showUnlockModal, invalidUnlockGallery, galleryUnlocked} from './galleryList';
import {buildUrl} from './utils';

export function unlockGallery(password, unlockUri, slug, albumKey) {
	return dispatch => {
		let url = buildUrl({
			path: unlockUri
		});

		let successUrl = buildUrl({
			path: '/api/v2/album/' + albumKey + '!images'
		});

		dispatch(galleryLoad());

		return axios.get(
			Constants.AjaxUrl,
			{
				params: {
					action: 'smugmug_unlock',
					password: password,
					url,
					successUrl
				},
				timeout: 20000
			}
		).then(doc => {
			if (doc.data.success) {
				dispatch(galleryUnlocked(doc.data.data.cookies));
				return dispatch(searchGalleries(slug));
			}

			return dispatch(invalidUnlockGallery());
		});
	};
}

export function searchGalleries(data, cancel) {
	return dispatch => {
		let url = buildUrl({
			path: '/api/v2/album/' + data.albumKey
		});

		dispatch(galleryLoad());
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
			if (!doc.data.data || !doc.data.data.Album) {
				return dispatch(searchGalleriesNotFound());
			}

			dispatch(searchGalleriesReceieved(doc.data.data.Album));

			if (doc.data.data.Album.Uris.UnlockAlbum) {
				return dispatch(showUnlockModal(doc.data.data.Album.Uris.Node.Uri + '!unlock'));
			}
		}, () => {
			dispatch(unmountGalleryList());
		});
	};
}

export function loadGalleryImages(data, cancel) {
	return dispatch => {
		let url = buildUrl({
			path: '/api/v2/album/' + data.albumKey + '!images',
			start: data.start || 1,
			count: data.count || 12
		});

		dispatch(galleryLoad());
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
			return dispatch(galleryImagesReceived(doc.data.data));
		}, () => {
			dispatch(unmountGallery());
		});
	};
}

export function loadGalleries(galleryData, cancel) {
	return dispatch => {
		dispatch(galleryListLoad());
		let data = {
			path: '/api/v2/folder/' + galleryData.folder + '!albums',
			start: galleryData.start || 1,
			count: galleryData.count || 12
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
			dispatch(galleryListReceived(doc.data.data));
		}, err => {
			dispatch(unmountGalleryList());
		});
	};
}

export function loadGalleryCover(path, id, cancel) {
	return dispatch => {
		dispatch(galleryListLoad());
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
			if (!doc.data.data.Image || !doc.data.data.Image.ArchivedUri) {
				doc.data.data.Image = {
					ArchivedUri: '/wp-content/themes/tagprints-2015/assets/images/placeholder.png'
				};
			}
			dispatch(galleryListThumbnailReceived(doc.data.data.Image, id));
		}, () => {
			dispatch(unmountGalleryList());
		});
	};
}
