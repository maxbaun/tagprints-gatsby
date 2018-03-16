import {GALLERY_LIST_RECEIVED, GALLERY_LIST_THUMBNAIL_RECEIVED, GALLERY_LIST_LOAD, GALLERY_LIST_INIT} from '../constants';

export default (state = {
	hasMore: false,
	loading: false,
	galleries: [],
	total: 300
}, action = {}) => {
	switch (action.type) {
		case GALLERY_LIST_LOAD: {
			return {
				...state,
				loading: true
			};
		}
		case GALLERY_LIST_RECEIVED: {
			return {
				...state,
				galleries: state.galleries.concat(action.galleryList.Album),
				hasMore: Boolean(action.galleryList.Pages.NextPage),
				total: parseInt(action.galleryList.Pages.LastPage.split('start=')[1].split('&')[0], 10),
				loading: false
			};
		}
		case GALLERY_LIST_THUMBNAIL_RECEIVED: {
			return {
				...state,
				loading: false,
				galleries: state.galleries.map(gallery => {
					if (action.id === gallery.AlbumKey) {
						gallery.image = action.gallery;
					}
					return gallery;
				})
			};
		}
		case GALLERY_LIST_INIT: {
			return {
				...state,
				galleries: [],
				loading: false
			};
		}
		default: {
			return state;
		}
	}
};
