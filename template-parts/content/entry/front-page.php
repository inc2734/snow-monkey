<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 16.1.4
 */

use Framework\Helper;
?>

<?php
if ( Helper::is_active_sidebar( 'front-page-top-widget-area' ) ) {
	Helper::get_template_part( 'template-parts/widget-area/front-page-top' );
}
?>

<?php
ob_start();
$has_do_shortcode = has_filter( 'the_content', 'do_shortcode' );
if ( $has_do_shortcode ) {
	remove_filter( 'the_content', 'do_shortcode', $has_do_shortcode );
	the_content();
	add_filter( 'the_content', 'do_shortcode', $has_do_shortcode );
} else {
	the_content();
}
$content = ob_get_clean();
?>

<?php if ( $content ) : ?>
	<?php
	add_filter(
		'wp_omit_loading_attr_threshold',
		function() {
			$content_media_count = wp_increase_content_media_count();
			return $content_media_count + 1;
		}
	);
	wp_omit_loading_attr_threshold( true );

	$classes = [ 'c-section', 'p-section-front-page-content' ];
	if ( ! get_theme_mod( 'home-page-content-padding' ) ) {
		$classes[] = 'p-section-front-page-content--no-vpadding';
	}
	?>

	<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
		<div <?php post_class(); ?>>
			<div class="c-entry__body">
				<?php Helper::get_template_part( 'template-parts/content/entry/content/content', 'front-page' ); ?>
			</div>
		</div>
	</div>
<?php endif; ?>

<?php
if ( Helper::is_active_sidebar( 'front-page-bottom-widget-area' ) ) {
	Helper::get_template_part( 'template-parts/widget-area/front-page-bottom' );
}
