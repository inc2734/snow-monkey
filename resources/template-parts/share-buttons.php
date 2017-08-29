<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

if ( ! get_option( 'inc2734-theme-option-share-buttons-buttons' ) ) {
	return;
}

$share_buttons_display_position = get_option( 'inc2734-theme-option-share-buttons-display-position' );

if ( $_position !== $share_buttons_display_position && 'both' !== $share_buttons_display_position ) {
	return;
}
?>

<div class="wp-share-buttons wp-share-buttons--<?php echo esc_attr( get_option( 'inc2734-theme-option-share-buttons-type' ) ); ?>">
	<ul class="wp-share-buttons__list">
		<?php $buttons = explode( ',', get_option( 'inc2734-theme-option-share-buttons-buttons' ) ); ?>
		<?php foreach ( $buttons as $button ) : ?>
			<li class="wp-share-buttons__item">
				<?php
				echo do_shortcode(
					sprintf(
						'[wp_share_buttons_%1$s type="%2$s" post_id="%3$d"]',
						esc_attr( $button ),
						esc_attr( get_option( 'inc2734-theme-option-share-buttons-type' ) ),
						get_the_ID()
					)
				);
				?>
			</li>
		<?php endforeach; ?>
	</ul>
</div>
