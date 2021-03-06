<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 13.2.3
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
	$classes = [ 'c-section', 'p-section-front-page-content' ];
	if ( ! get_theme_mod( 'home-page-content-padding' ) ) {
		$classes[] = 'p-section-front-page-content--no-vpadding';
	}

	$wp_page_template         = get_post_meta( get_the_ID(), '_wp_page_template', true );
	$use_home_page_container  = get_theme_mod( 'home-page-container' );
	$is_default_page_template = 'default' === $wp_page_template;
	$is_one_column_full       = false !== strpos( $wp_page_template, 'one-column-full.php' );

	$require_container = ( ! $wp_page_template || $is_default_page_template || $is_one_column_full ) && $use_home_page_container;
	?>

	<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
		<?php if ( $require_container ) : ?>

			<div class="c-container">
				<div <?php post_class(); ?>>
					<div class="c-entry__body">
						<?php Helper::get_template_part( 'template-parts/content/entry/content/content', 'front-page' ); ?>
					</div>
				</div>
			</div>

		<?php else : ?>

			<div <?php post_class(); ?>>
				<div class="c-entry__body">
					<?php Helper::get_template_part( 'template-parts/content/entry/content/content', 'front-page' ); ?>
				</div>
			</div>

		<?php endif; ?>
	</div>
<?php endif; ?>

<?php
if ( Helper::is_active_sidebar( 'front-page-bottom-widget-area' ) ) {
	Helper::get_template_part( 'template-parts/widget-area/front-page-bottom' );
}
