<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Framework\Helper;

$terms  = Helper::get_var( $_terms, get_the_terms( get_the_ID(), 'category' ) );
$layout = Helper::get_var( $widget_layout, get_theme_mod( get_post_type() . '-entries-layout' ) );
?>

<a href="<?php the_permalink(); ?>">
	<section class="c-entry-summary">
		<div class="c-entry-summary__figure">
			<?php the_post_thumbnail( 'xlarge' ); ?>

			<?php
			if ( $terms && is_array( $terms ) && ! is_wp_error( $terms ) ) {
				$vars = [
					'_terms' => [ $terms[0] ],
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
				Helper::get_template_part( 'template-parts/loop/entry-summary/title', 'post', $vars );
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
				Helper::get_template_part( 'template-parts/loop/entry-summary/content', 'post', $vars );
			}
			?>

			<?php Helper::get_template_part( 'template-parts/loop/entry-summary/meta', 'post' ); ?>
		</div>
	</section>
</a>
