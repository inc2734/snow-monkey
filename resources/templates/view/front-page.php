<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Snow_Monkey\app\Helper;
?>
<?php Helper::get_template_part( 'template-parts/widget-area/front-page-top' ); ?>

<?php
ob_start();
the_content();
$content = ob_get_clean();
?>

<?php if ( $content ) : ?>
	<?php
	$wp_page_template = get_post_meta( get_the_ID(), '_wp_page_template', true );

	$classes = [ 'c-section', 'p-section-front-page-content' ];
	if ( ! get_theme_mod( 'home-page-content-padding' ) ) {
		$classes[] = 'p-section-front-page-content--no-vpadding';
	}

	$require_container = ! $wp_page_template
										|| 'default' === $wp_page_template
										|| false !== strpos( $wp_page_template, 'one-column-full.php' );
	?>

	<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
		<?php if ( $require_container ) : ?>
			<div class="c-container">
		<?php endif; ?>

		<div <?php post_class(); ?>>
			<div class="c-entry__body">
				<div class="c-entry__content p-entry-content">
					<?php the_content(); ?>
				</div>
			</div>
		</div>

		<?php if ( $require_container ) : ?>
			</div>
		<?php endif; ?>
	</div>
<?php endif; ?>

<?php Helper::get_template_part( 'template-parts/widget-area/front-page-bottom' ); ?>
