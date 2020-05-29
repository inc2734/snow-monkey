<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Style;

$selectors = [ '.smb-media-text__body' ];
Style::extend( 'entry-content', $selectors );
Style::extend( 'theme-entry-content', $selectors );
