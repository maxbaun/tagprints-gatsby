'use strict';

import React from 'react';
import {render} from 'react-dom';
import {Router, browserHistory} from 'react-router';
import Routes from './routes';
import {Provider} from 'react-redux';
import thunk from 'redux-thunk';
import {createStore, applyMiddleware, compose} from 'redux';
import Reducers from './reducers';

const Store = createStore(
    Reducers,
    compose(
        applyMiddleware(thunk),
        window.devToolsExtension ? window.devToolsExtension() : f => f
    )
);

render(
    <Provider store={Store}>
        <Router history={browserHistory} routes={Routes}/>
    </Provider>, document.getElementById('tagprints-smugmug')
);
