import {
	GALLERY_LIST_RECEIVED,
	GALLERY_LIST_THUMBNAIL_RECEIVED,
	GALLERY_LIST_LOAD,
	GALLERY_LOAD,
	GALLERY_SEARCH_RECEIVED,
	GALLERY_SEARCH_NOT_FOUND,
	GALLERY_IMAGES_RECEIVED,
	GALLERY_INIT,
	GALLERY_SHOW_UNLOCK,
	GALLERY_INVALID_UNLOCK,
	GALLERY_UNLOCKED,
	GALLERY_LIST_INIT
} from '../constants';

export function galleryListReceived(galleryList) {
	return {
		type: GALLERY_LIST_RECEIVED,
		galleryList
	};
}

export function galleryListThumbnailReceived(gallery, id) {
	return {
		type: GALLERY_LIST_THUMBNAIL_RECEIVED,
		gallery,
		id
	};
}

export function galleryListLoad() {
	return {
		type: GALLERY_LIST_LOAD
	};
}

export function galleryLoad() {
	return {
		type: GALLERY_LOAD
	};
}

export function galleryImagesReceived(data) {
	return {
		type: GALLERY_IMAGES_RECEIVED,
		data
	};
}

export function searchGalleriesReceieved(gallery) {
	return {
		type: GALLERY_SEARCH_RECEIVED,
		gallery
	};
}

export function searchGalleriesNotFound() {
	return {
		type: GALLERY_SEARCH_NOT_FOUND
	};
}

export function unmountGallery() {
	return {
		type: GALLERY_INIT
	};
}

export function unmountGalleryList() {
	return {
		type: GALLERY_LIST_INIT
	};
}

export function showUnlockModal(uri) {
	return {
		type: GALLERY_SHOW_UNLOCK,
		uri
	};
}

export function invalidUnlockGallery() {
	return {
		type: GALLERY_INVALID_UNLOCK
	};
}

export function galleryUnlocked(cookies) {
	return {
		type: GALLERY_UNLOCKED,
		cookies
	};
}
