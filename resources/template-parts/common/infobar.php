<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version <unversion>
 *
 * renamed: template-parts/infobar.php
 */

use Framework\Helper;

$template_args = [
	'content' => Helper::get_var( $_content, get_theme_mod( 'infobar-content' ) ),
	'url'     => Helper::get_var( $_url, get_theme_mod( 'infobar-url' ) ),
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
					<?php echo esc_html( $template_args['content'] ); ?>
				</div>
			</div>
		</a>

	<?php else : ?>

		<span class="p-infobar__inner">
			<div class="c-container">
				<div class="p-infobar__content">
					<?php echo esc_html( $template_args['content'] ); ?>
				</div>
			</div>
		</span>

	<?php endif; ?>
</div>
