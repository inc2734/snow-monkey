const defaultConfig = require( '@wordpress/scripts/config/webpack.config' );
const path = require( 'path' );

const plugins = [ ...defaultConfig?.plugins ];

plugins.splice(1, 1); //delete plugins.CleanWebpackPlugin
plugins.splice(2, 1); //delete plugins.CopyWebpackPlugin

module.exports = {
	...defaultConfig,
	plugins,
};
