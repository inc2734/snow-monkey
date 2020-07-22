<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 11.0.0
 *
 * renamed: template-parts/entry-summary.php
 */

use Framework\Helper;

$template_args = [
	'title_tag'      => Helper::get_var( $args['_title_tag'], 'h2' ),
	'thumbnail_size' => Helper::get_var( $args['_thumbnail_size'], 'medium_large' ),
	'entries_layout' => Helper::get_var( $args['_entries_layout'], get_theme_mod( get_post_type() . '-entries-layout' ) ),
	'excerpt_length' => Helper::get_var( $args['_excerpt_length'], null ),
];
?>

<a href="<?php the_permalink(); ?>">
	<section class="c-entry-summary c-entry-summary--<?php echo esc_attr( get_post_type() ); ?>">
		<?php
		Helper::get_template_part(
			'template-parts/loop/entry-summary/figure/figure',
			get_post_type(),
			[
				'_thumbnail_size' => $template_args['thumbnail_size'],
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
						'_title_tag' => $template_args['title_tag'],
					]
				);
				?>
			</header>

			<?php
			Helper::get_template_part(
				'template-parts/loop/entry-summary/content/content',
				get_post_type(),
				[
					'_entries_layout' => $template_args['entries_layout'],
					'_excerpt_length' => $template_args['excerpt_length'],
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
