const defaultConfig = require( '@wordpress/scripts/config/webpack.config' );

const plugins = [ ...defaultConfig.plugins ];
plugins.shift(); //delete plugins.CleanWebpackPlugin

module.exports = {
  ...defaultConfig,
  plugins,
};
