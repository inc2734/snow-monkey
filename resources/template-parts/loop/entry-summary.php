<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Framework\Helper;

$name         = Helper::get_var( $_name, null );
$layout       = Helper::get_var( $widget_layout, get_theme_mod( get_post_type() . '-entries-layout' ) );
$terms        = Helper::get_var( $_terms, [] );
$display_meta = Helper::get_var( $_display_meta, true );

$term = $terms && is_array( $terms ) && ! is_wp_error( $terms ) ? $terms[0] : null;

$wrapper_classes = [];
if ( $term ) {
	$wrapper_classes[] = 'c-entry-summary--' . $term->taxonomy . '-' . $term->term_id;
}
if ( $name ) {
	$wrapper_classes[] = 'c-entry-summary--' . $name;
}
?>

<a href="<?php the_permalink(); ?>">
	<section class="c-entry-summary <?php echo esc_attr( join( ' ', $wrapper_classes ) ); ?>">
		<div class="c-entry-summary__figure">
			<?php the_post_thumbnail( 'xlarge' ); ?>

			<?php
			if ( $term ) {
				$vars = [
					'_terms' => [ $term ],
				];
				Helper::get_template_part( 'template-parts/loop/entry-summary/term', 'post', $vars );
			}
			?>
		</div>

		<div class="c-entry-summary__body">
			<header class="c-entry-summary__header">
				<?php
				$vars = [
					'_layout' => $layout,
				];
				Helper::get_template_part( 'template-parts/loop/entry-summary/title', null, $vars );
				?>
			</header>

			<?php
			ob_start();
			the_excerpt();
			$content = wp_strip_all_tags( ob_get_clean() );
			if ( $content ) {
				$vars = [
					'_content' => $content,
				];
				Helper::get_template_part( 'template-parts/loop/entry-summary/content', null, $vars );
			}
			?>

			<?php
			if ( $display_meta ) {
				Helper::get_template_part( 'template-parts/loop/entry-summary/meta' );
			}
			?>
		</div>
	</section>
</a>
