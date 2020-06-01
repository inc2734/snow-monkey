<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 10.7.0
 */

use Framework\Helper;

$template_args = [
	'title_tag'      => Helper::get_var( $_title_tag, 'h2' ),
	'item'           => Helper::get_var( $_item, false ),
	'entries_layout' => Helper::get_var( $_entries_layout, get_theme_mod( 'post-entries-layout' ) ),
	'excerpt_length' => Helper::get_var( $_excerpt_length, null ),
];

if ( ! $template_args['item'] || ! is_a( $template_args['item'], 'SimplePie_Item' ) ) {
	return;
}
?>

<a href="<?php echo esc_url( $template_args['item']->get_permalink() ); ?>" target="_blank" rel="noopener">
	<section class="c-entry-summary c-entry-summary--post">
		<?php
		Helper::get_template_part(
			'template-parts/loop/entry-summary/figure/figure',
			'rss',
			[
				'_item' => $template_args['item'],
			]
		);
		?>

		<div class="c-entry-summary__body">
			<header class="c-entry-summary__header">
				<?php
				Helper::get_template_part(
					'template-parts/loop/entry-summary/title/title',
					'rss',
					[
						'_title_tag' => $template_args['title_tag'],
						'_item'      => $template_args['item'],
					]
				);
				?>
			</header>

			<?php
			Helper::get_template_part(
				'template-parts/loop/entry-summary/content/content',
				'rss',
				[
					'_item'           => $template_args['item'],
					'_entries_layout' => $template_args['entries_layout'],
					'_excerpt_length' => $template_args['excerpt_length'],
				]
			);
			?>

			<?php
			Helper::get_template_part(
				'template-parts/loop/entry-summary/meta/meta',
				'rss',
				[
					'_item' => $template_args['item'],
				]
			);
			?>
		</div>
	</section>
</a>
