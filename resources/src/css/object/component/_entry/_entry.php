<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

$selector = ( ! is_admin() ) ? '.c-entry__content' : '';
snow_monkey_entry_content_styles( $selector );
