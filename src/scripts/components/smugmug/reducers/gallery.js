import {GALLERY_UNLOCKED, GALLERY_INVALID_UNLOCK, GALLERY_INIT, GALLERY_LOAD, GALLERY_SEARCH_RECEIVED, GALLERY_SEARCH_NOT_FOUND, GALLERY_IMAGES_RECEIVED, GALLERY_SHOW_UNLOCK} from '../constants';

export default (state = {
	gallery: {images: []},
	loading: false,
	notFound: false,
	cookies: []
}, action = {}) => {
	switch (action.type) {
		case GALLERY_LOAD: {
			return {
				...state,
				loading: true
			};
		}
		case GALLERY_IMAGES_RECEIVED: {
			console.log(action);
			return {
				...state,
				loading: false,
				gallery: {
					...state.gallery,
					images: state.gallery.images.concat(action.data.AlbumImage) || state.gallery.images,
					total: action.data.Pages.Total
				}
			};
		}
		case GALLERY_SEARCH_RECEIVED: {
			return {
				...state,
				gallery: {
					...state.gallery,
					...action.gallery
				},
				showUnlock: false,
				invalidPassword: false
			};
		}
		case GALLERY_SEARCH_NOT_FOUND: {
			return {
				...state,
				loading: false,
				notFound: true
			};
		}
		case GALLERY_INIT: {
			return {
				...state,
				loading: false,
				notFound: false,
				gallery: {images: []},
				invalidPassword: false,
				showUnlock: false
			};
		}
		case GALLERY_SHOW_UNLOCK: {
			return {
				...state,
				showUnlock: true,
				loading: false,
				unlockUri: action.uri
			};
		}
		case GALLERY_INVALID_UNLOCK: {
			return {
				...state,
				showUnlock: true,
				loading: false,
				invalidPassword: true
			};
		}
		case GALLERY_UNLOCKED: {
			return {
				...state,
				cookies: action.cookies,
				loading: false,
				invalidPassword: false
			};
		}
		default: {
			return state;
		}
	}
};
