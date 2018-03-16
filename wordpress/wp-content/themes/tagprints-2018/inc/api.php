<?php

add_filter('rest_endpoints', function ($endpoints) {

    // unset($endpoints['/wp/v2/media']);
    // unset($endpoints['/acf/v3/media']);

    return $endpoints;
});
