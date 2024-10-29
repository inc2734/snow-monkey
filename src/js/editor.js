import { addFilter } from '@wordpress/hooks';

function setDimensionsDefaultControls( settings ) {
	if ( ! settings?.supports?.spacing?.padding ) {
		return settings;
	}

	settings = {
		...settings,
		supports: {
			...settings.supports,
			spacing: {
				...settings.supports.spacing,
				__experimentalDefaultControls: {
					...settings.supports.spacing.__experimentalDefaultControls,
					margin: true,
					padding: true,
				},
			},
		},
	};

	return settings;
}

addFilter( 'blocks.registerBlockType', 'snow-monkey/set-dimensions-default-controls', setDimensionsDefaultControls );
