<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 25.3.2
 */

use Framework\Helper;

$args = wp_parse_args(
	// phpcs:disable VariableAnalysis.CodeAnalysis.VariableAnalysis.UndefinedVariable
	$args,
	// phpcs:enable
	array(
		'_entries_id'     => null,
		'_entries_layout' => 'rich-media',
		'_entries_gap'    => null,
		'_excerpt_length' => null,
		'_item_title_tag' => 'h3',
		'_items'          => array(),
		'_arrows'         => false,
		'_dots'           => true,
		'_interval'       => 0,
		'_autoplayButton' => false,
	)
);

if ( ! $args['_items'] ) {
	return;
}

$classes   = array();
$classes[] = 'c-entries-carousel';
if ( $args['_entries_gap'] ) {
	$classes[] = 'c-entries-carousel--gap-' . $args['_entries_gap'];
}
?>

<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>" data-interval="<?php echo esc_attr( $args['_interval'] * 1000 ); ?>">
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
							array(
								'_context'        => $args['_context'],
								'_entries_id'     => $args['_entries_id'],
								'_entries_layout' => $args['_entries_layout'],
								'_excerpt_length' => $args['_excerpt_length'],
								'_item'           => $item,
								'_title_tag'      => $args['_item_title_tag'],
							)
						);
						?>
					</div>
				</div>
				<?php ++$i; ?>
			<?php endforeach; ?>
		</div>

		<?php if ( $args['_arrows'] ) : ?>
			<button class="spider__arrow" data-direction="prev">Prev</button>
			<button class="spider__arrow" data-direction="next">Next</button>
		<?php endif; ?>
	</div>

	<?php if ( ( 0 < $args['_interval'] && $args['_autoplayButton'] ) || $args['_dots'] ) : ?>
		<div class="spider__dots" data-thumbnails="false">
			<?php if ( $args['_autoplayButton'] ) : ?>
				<button class="spider__stop">
					<svg
						width="12"
						height="16"
						viewBox="0 0 12 16"
						fill="none"
						xmlns="http://www.w3.org/2000/svg"
						title="<?php esc_html_e( 'Pause autoplay', 'snow-monkey' ); ?>"
					>
						<rect
							width="5"
							height="16"
							fill="currentColor"
						></rect>
						<rect
							x="7"
							width="5"
							height="16"
							fill="currentColor"
						></rect>
					</svg>
				</button>
				<button class="spider__start">
					<svg
						width="12"
						height="16"
						viewBox="0 0 12 16"
						fill="none"
						xmlns="http://www.w3.org/2000/svg"
						title="<?php esc_html_e( 'Start autoplay', 'snow-monkey' ); ?>"
					>
						<path
							d="M12 8L-2.29967e-06 16L-2.29967e-06 0L12 8Z"
							fill="currentColor"
						></path>
					</svg>
				</button>
			<?php endif; ?>

			<?php if ( $args['_dots'] ) : ?>
				<?php for ( $j = 0; $j < $i; $j++ ) : ?>
					<button class="spider__dot" data-id="<?php echo esc_attr( $j ); ?>"><?php echo esc_html( $j ); ?></button>
				<?php endfor; ?>
			<?php endif; ?>
		</div>
	<?php endif; ?>
</div>
