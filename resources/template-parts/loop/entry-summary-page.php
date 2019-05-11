<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Framework\Helper;

$layout = Helper::get_var( $widget_layout, 'rich-media' );
?>

<a href="<?php the_permalink(); ?>">
	<section class="c-entry-summary">
		<div class="c-entry-summary__figure">
			<?php the_post_thumbnail( 'xlarge' ); ?>
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
		</div>
	</section>
</a>
