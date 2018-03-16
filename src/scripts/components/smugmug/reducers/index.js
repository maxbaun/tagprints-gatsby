import {combineReducers} from 'redux';
import galleryList from './galleryList';
import gallery from './gallery';
import folderList from './folderList';

export default combineReducers({
	galleryList,
	galleryPage: gallery,
	folderList
});
