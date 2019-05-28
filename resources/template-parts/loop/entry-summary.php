<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Framework\Helper;

$entries_layout = Helper::get_var( $_entries_layout, get_theme_mod( get_post_type() . '-entries-layout' ) );
?>

<a href="<?php the_permalink(); ?>">
	<section class="c-entry-summary c-entry-summary--<?php echo get_post_type(); ?>">
		<?php Helper::get_template_part( 'template-parts/loop/entry-summary/figure/figure', get_post_type() ); ?>

		<div class="c-entry-summary__body">
			<header class="c-entry-summary__header">
				<?php Helper::get_template_part( 'template-parts/loop/entry-summary/title/title', get_post_type() ); ?>
			</header>

			<?php
			Helper::get_template_part(
				'template-parts/loop/entry-summary/content/content',
				get_post_type(),
				[
					'_entries_layout' => $entries_layout,
				]
			);
			?>

			<?php
			if ( ! get_post_type_object( get_post_type() )->hierarchical ) {
				Helper::get_template_part( 'template-parts/loop/entry-summary/meta/meta', get_post_type() );
			}
			?>
		</div>
	</section>
</a>
