<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 11.3.3
 */

use Framework\Helper;

$args = wp_parse_args(
	// phpcs:disable VariableAnalysis.CodeAnalysis.VariableAnalysis.UndefinedVariable
	$args,
	// phpcs:enable
	[
		'_title_tag'      => 'h2',
		'_thumbnail_size' => 'medium_large',
		'_entries_layout' => get_theme_mod( get_post_type() . '-entries-layout' ),
		'_excerpt_length' => null,
	]
);
?>

<a href="<?php the_permalink(); ?>">
	<section class="c-entry-summary c-entry-summary--post">
		<?php
		Helper::get_template_part(
			'template-parts/loop/entry-summary/figure/figure',
			'post',
			[
				'_thumbnail_size' => $args['_thumbnail_size'],
			]
		);
		?>

		<div class="c-entry-summary__body">
			<header class="c-entry-summary__header">
				<?php
				Helper::get_template_part(
					'template-parts/loop/entry-summary/title/title',
					'post',
					[
						'_title_tag' => $args['_title_tag'],
					]
				);
				?>
			</header>

			<?php
			Helper::get_template_part(
				'template-parts/loop/entry-summary/content/content',
				'post',
				[
					'_entries_layout' => $args['_entries_layout'],
					'_excerpt_length' => $args['_excerpt_length'],
				]
			);
			?>

			<?php Helper::get_template_part( 'template-parts/loop/entry-summary/meta/meta', 'post' ); ?>
		</div>
	</section>
</a>
