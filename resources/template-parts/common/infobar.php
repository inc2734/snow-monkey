<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 11.0.0
 *
 * renamed: template-parts/infobar.php
 */

use Framework\Helper;

$template_args = [
	'content' => Helper::get_var( $args['_content'], get_theme_mod( 'infobar-content' ) ),
	'url'     => Helper::get_var( $args['_url'], get_theme_mod( 'infobar-url' ) ),
];

if ( ! $template_args['content'] ) {
	return;
}
?>
<div class="p-infobar">
	<?php if ( $template_args['url'] ) : ?>

		<a class="p-infobar__inner" href="<?php echo esc_url( $template_args['url'] ); ?>">
			<div class="c-container">
				<div class="p-infobar__content">
					<?php
					$kses_allowed_html = wp_kses_allowed_html( 'user_description' );
					if ( isset( $kses_allowed_html['a'] ) ) {
						unset( $kses_allowed_html['a'] );
					}

					echo wp_kses(
						$template_args['content'],
						$kses_allowed_html
					);
					?>
				</div>
			</div>
		</a>

	<?php else : ?>

		<span class="p-infobar__inner">
			<div class="c-container">
				<div class="p-infobar__content">
					<?php
					$kses_allowed_html = wp_kses_allowed_html( 'user_description' );

					echo wp_kses(
						$template_args['content'],
						$kses_allowed_html
					);
					?>
				</div>
			</div>
		</span>

	<?php endif; ?>
</div>
