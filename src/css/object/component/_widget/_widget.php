<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Style;

Style::extend(
	'widget-title',
	[
		'.c-widget__title',
		// @todo Because ::after is used in the block editor.
		// '.wp-block-widget-area__inner-blocks > .block-editor-block-list__layout > [data-type="core/heading"]',
	]
);


