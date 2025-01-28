const defaultConfig = require( '@wordpress/scripts/config/webpack.config' );

const plugins = [ ...defaultConfig.plugins ];
plugins.splice(1, 1); //delete plugins.CleanWebpackPlugin
// plugins.shift(); //delete plugins.CopyWebpackPlugin

module.exports = {
  ...defaultConfig,
  plugins,
};
