const webpack = require('webpack');
const slash = require('slash');
const Promise = require('bluebird');
const path = require('path');

exports.modifyWebpackConfig = function (config) {
	if (!config.plugins) {
		config.plugins = [];
	}

	config.plugins.push(
		new webpack.ProvidePlugin({
			jQuery: 'jquery',
			$: 'jquery',
			jquery: 'jquery'
		})
	);

	return config;
};

exports.createPages = ({graphql, boundActionCreators}) => {
	const {createPage} = boundActionCreators;
	return new Promise((resolve, reject) => {
		// The “graphql” function allows us to run arbitrary
		// queries against the local Wordpress graphql schema. Think of
		// it like the site has a built-in database constructed
		// from the fetched data that you can run queries against.

		// ==== PAGES (WORDPRESS NATIVE) ====
		graphql(
			`
			{
				allWordpressPage {
					edges {
						node {
							id
							slug
							status
							template
						}
					}
				}
			}
			`
		).then(result => {
			if (result.errors) {
				console.log(result.errors);
				reject(result.errors);
			}

			// Create Page pages.
			// We want to create a detailed page for each
			// page node. We'll just use the Wordpress Slug for the slug.
			// The Page ID is prefixed with 'PAGE_'
			result.data.allWordpressPage.edges.forEach(edge => {
				// Gatsby uses Redux to manage its internal state.
				// Plugins and sites can use functions like "createPage"
				// to interact with Gatsby.
				createPage({
					// Each page is required to have a `path` as well
					// as a template component. The `context` is
					// optional but is often necessary so the template
					// can query data specific to each page.
					path: `/${edge.node.slug}`,
					component: getPageTemplate(edge.node.template),
					context: {
						id: edge.node.id
					}
				});
			});
			resolve();
		});
	});
};

function getPageTemplate(template) {
	if (template === 'template-array13.php') {
		return path.resolve(`./src/templates/array13.js`);
	}

	return path.resolve(`./src/templates/page.js`);
}
