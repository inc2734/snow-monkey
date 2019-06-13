<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 7.0.0
 */

use Framework\Helper;

$template_args = [
	'entries_layout' => Helper::get_var( $_entries_layout, get_theme_mod( get_post_type() . '-entries-layout' ) ),
	'excerpt_length' => Helper::get_var( $_excerpt_length, null ),
];
?>

<a href="<?php the_permalink(); ?>">
	<section class="c-entry-summary c-entry-summary--post">
		<?php Helper::get_template_part( 'template-parts/loop/entry-summary/figure/figure', 'post' ); ?>

		<div class="c-entry-summary__body">
			<header class="c-entry-summary__header">
				<?php Helper::get_template_part( 'template-parts/loop/entry-summary/title/title', 'post' ); ?>
			</header>

			<?php
			Helper::get_template_part(
				'template-parts/loop/entry-summary/content/content',
				'post',
				[
					'_entries_layout' => $template_args['entries_layout'],
					'_excerpt_length' => $template_args['excerpt_length'],
				]
			);
			?>

			<?php Helper::get_template_part( 'template-parts/loop/entry-summary/meta/meta', 'post' ); ?>
		</div>
	</section>
</a>
