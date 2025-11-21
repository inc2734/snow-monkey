const defaultConfig = require( '@wordpress/scripts/config/webpack.config' );

const plugins =
defaultConfig?.plugins?.filter(
	( plugin ) => plugin.constructor?.name !== 'CopyPlugin'
) ?? [];

module.exports = {
	...defaultConfig,
	output: {
		...defaultConfig?.output,
		clean: false,
	},
	plugins,
};
