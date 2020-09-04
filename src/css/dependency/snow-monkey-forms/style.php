<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Style;

Style::extend(
	'entry-content',
	[
		'.smf-complete-content',
		'.smf-system-error-content',
		'.smf-item__controls',
	]
);
