<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 11.5.0
 */

use Framework\Helper;

if ( class_exists( '\Inc2734\WP_GitHub_Theme_Updater\Bootstrap' ) ) {
	return;
}

/**
 * Copyright
 */
add_filter(
	'snow_monkey_copyright',
	function() {
		$theme_link = sprintf(
			'<a href="https://snow-monkey.2inc.org" target="_blank" rel="noreferrer">%s</a>',
			__( 'Snow Monkey', 'snow-monkey' )
		);

		$developer_link = sprintf(
			'<a href="https://2inc.org" target="_blank" rel="noreferrer">%s</a>',
			__( 'Monkey Wrench', 'snow-monkey' )
		);

		$wordpress_link = sprintf(
			'<a href="https://wordpress.org/" target="_blank" rel="noreferrer">%s</a>',
			__( 'WordPress', 'snow-monkey' )
		);

		$theme_by = sprintf(
			/* translators: %1$s: Theme link, %2$s: Developer link */
			__( '%1$s theme (Trial version) by %2$s', 'snow-monkey' ),
			$theme_link,
			$developer_link
		);

		$powered_by = sprintf(
			/* translators: %s: WordPress link */
			__( 'Powered by %s', 'snow-monkey' ),
			$wordpress_link
		);

		return $theme_by . ' ' . $powered_by;
	},
	99999
);

/**
 * Admin notice
 */
add_action(
	'admin_notices',
	function() {
		$screen = get_current_screen();
		if ( ! $screen || 'post' === $screen->id ) {
			return;
		}

		?>
		<div class="notice notice-warning">
			<p>
				<?php
				echo wp_kses_post(
					sprintf(
						// translators: %1$s: <a> for Snow Monkey website, %2$s: </a> for Snow Monkey website, %3$s: <a> for Snow Monkey product page, %4$s: </a> for Snow Monkey product page,
						__(
							'You are currently using the %1$sSnow Monkey%2$s theme (trial version). The trial version will not be updated (no features will be added, no bug fixes or security improvements will be made). With the full version, you will receive updates, using support forum, access to limited articles, and other services. You can sign up %3$shere%4$s.',
							'snow-monkey'
						),
						'<a href="https://snow-monkey.2inc.org" target="_blank" rel="noreferrer">',
						'</a>',
						'<a href="https://snow-monkey.2inc.org/product/snow-monkey/" target="_blank" rel="noreferrer">',
						'</a>'
					)
				);
				?>
			</p>
		</div>
		<?php
	}
);
