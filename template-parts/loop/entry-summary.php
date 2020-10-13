<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 11.6.0
 *
 * renamed: template-parts/entry-summary.php
 */

use Framework\Helper;

$args = wp_parse_args(
	// phpcs:disable VariableAnalysis.CodeAnalysis.VariableAnalysis.UndefinedVariable
	$args,
	// phpcs:enable
	[
		'_context'        => null,
		'_title_tag'      => 'h2',
		'_thumbnail_size' => 'medium_large',
		'_entries_layout' => get_theme_mod( get_post_type() . '-entries-layout' ),
		'_excerpt_length' => null,
	]
);
?>

<a href="<?php the_permalink(); ?>">
	<section class="c-entry-summary c-entry-summary--<?php echo esc_attr( get_post_type() ); ?>">
		<?php
		Helper::get_template_part(
			'template-parts/loop/entry-summary/figure/figure',
			get_post_type(),
			[
				'_context'        => $args['_context'],
				'_thumbnail_size' => $args['_thumbnail_size'],
			]
		);
		?>

		<div class="c-entry-summary__body">
			<header class="c-entry-summary__header">
				<?php
				Helper::get_template_part(
					'template-parts/loop/entry-summary/title/title',
					get_post_type(),
					[
						'_context'   => $args['_context'],
						'_title_tag' => $args['_title_tag'],
					]
				);
				?>
			</header>

			<?php
			Helper::get_template_part(
				'template-parts/loop/entry-summary/content/content',
				get_post_type(),
				[
					'_context'        => $args['_context'],
					'_entries_layout' => $args['_entries_layout'],
					'_excerpt_length' => $args['_excerpt_length'],
				]
			);
			?>

			<?php
			$_post_type_object = get_post_type_object( get_post_type() );
			if ( $_post_type_object && ! $_post_type_object->hierarchical ) {
				Helper::get_template_part(
					'template-parts/loop/entry-summary/meta/meta',
					get_post_type(),
					[
						'_context' => $args['_context'],
					]
				);
			}
			?>
		</div>
	</section>
</a>
