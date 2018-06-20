<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

if ( ! get_theme_mod( 'infobar-content' ) ) {
	return;
}

$content = get_theme_mod( 'infobar-content' );
$url     = get_theme_mod( 'infobar-url' );
?>
<div class="p-infobar">
	<?php if ( $url ) : ?>

		<a class="p-infobar__inner" href="<?php echo esc_url( $url ); ?>">
			<div class="p-infobar__container">
				<div class="p-infobar__content">
					<?php echo esc_html( $content ); ?>
				</div>
			</div>
		</a>

	<?php else : ?>

		<span class="p-infobar__inner">
			<div class="p-infobar__container">
				<div class="p-infobar__content">
					<?php echo esc_html( $content ); ?>
				</div>
			</div>
		</span>

	<?php endif; ?>
</div>
