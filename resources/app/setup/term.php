<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

remove_filter( 'pre_term_description', 'wp_filter_kses' );
