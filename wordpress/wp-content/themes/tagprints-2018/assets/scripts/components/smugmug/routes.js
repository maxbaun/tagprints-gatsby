import React from 'react';
import {Route, IndexRoute} from 'react-router';
import App from './components/app';
import Constants from './constants';

import GalleryListPage from './components/galleryList/galleryListPage';
import GalleryPage from './components/gallery/galleryPage';
import Home from './components/home';

export default (
    <Route path={Constants.BasePath} component={App}>
        <IndexRoute component={Home}/>
        <Route path="folder/:id" component={GalleryListPage} />
        <Route path="gallery/:albumKey/:slug" component={GalleryPage} />
    </Route>
);
