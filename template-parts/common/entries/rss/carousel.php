<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 14.2.0
 */

use Framework\Helper;

$args = wp_parse_args(
	// phpcs:disable VariableAnalysis.CodeAnalysis.VariableAnalysis.UndefinedVariable
	$args,
	// phpcs:enable
	[
		'_entries_layout' => 'rich-media',
		'_excerpt_length' => null,
		'_item_title_tag' => 'h3',
		'_items'          => [],
		'_arrows'         => false,
		'_dots'           => true,
		'_interval'       => 0,
	]
);

if ( ! $args['_items'] ) {
	return;
}
?>

<div class="c-entries-carousel" data-interval="<?php echo esc_attr( $args['_interval'] * 1000 ); ?>">
	<div class="spider">
		<div class="spider__canvas">
			<?php $i = 0; ?>
			<?php foreach ( $args['_items'] as $item ) : ?>
				<div class="spider__slide" data-id="<?php echo esc_attr( $i ); ?>">
					<div class="c-entries-carousel__item">
						<?php
						Helper::get_template_part(
							'template-parts/loop/rss',
							null,
							[
								'_context'        => $args['_context'],
								'_entries_layout' => $args['_entries_layout'],
								'_excerpt_length' => $args['_excerpt_length'],
								'_item'           => $item,
								'_title_tag'      => $args['_item_title_tag'],
							]
						);
						?>
					</div>
				</div>
				<?php $i ++; ?>
			<?php endforeach; ?>
		</div>

		<?php if ( $args['_arrows'] ) : ?>
			<button class="spider__arrow" data-direction="prev">Prev</button>
			<button class="spider__arrow" data-direction="next">Next</button>
		<?php endif; ?>
	</div>

	<?php if ( $args['_dots'] ) : ?>
		<div class="spider__dots" data-thumbnails="false">
			<?php for ( $j = 0; $j < $i; $j ++ ) : ?>
				<button class="spider__dot" data-id="<?php echo esc_attr( $j ); ?>"><?php echo esc_html( $j ); ?></button>
			<?php endfor; ?>
		</div>
	<?php endif; ?>
</div>
