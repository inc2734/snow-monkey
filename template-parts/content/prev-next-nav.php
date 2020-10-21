<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 11.7.0
 *
 * renamed: template-parts/prev-next-nav.php
 */

use Framework\Helper;

$args = wp_parse_args(
	// phpcs:disable VariableAnalysis.CodeAnalysis.VariableAnalysis.UndefinedVariable
	$args,
	// phpcs:enable
	[
		'_in_same_term'   => false,
		'_excluded_terms' => [],
		'_taxonomy'       => 'category',
		'_next_label'     => __( 'Old post', 'snow-monkey' ),
		'_prev_label'     => __( 'New post', 'snow-monkey' ),
	]
);
?>

<div class="c-prev-next-nav">
	<?php foreach ( [ 'next', 'prev' ] as $key ) : ?>
		<div class="c-prev-next-nav__item c-prev-next-nav__item--<?php echo esc_attr( $key ); ?>">
			<?php
			if ( 'next' === $key ) {
				$_post = get_previous_post( $args['_in_same_term'], $args['_excluded_terms'], $args['_taxonomy'] );
			} elseif ( 'prev' === $key ) {
				$_post = get_next_post( $args['_in_same_term'], $args['_excluded_terms'], $args['_taxonomy'] );
			}
			?>

			<?php if ( ! empty( $_post->ID ) ) : ?>
				<?php
				$background_image_size = wp_is_mobile() ? 'large' : 'medium';

				ob_start();
				?>
				<div class="c-prev-next-nav__item-figure">
					<?php echo get_the_post_thumbnail( $_post->ID, $background_image_size ); ?>
				</div>
				<div class="c-prev-next-nav__item-label">
					<?php if ( 'next' === $key ) : ?>
						<i class="fas fa-angle-left" aria-hidden="true"></i>
						<?php echo wp_kses_post( $args['_next_label'] ); ?>
					<?php else : ?>
						<?php echo wp_kses_post( $args['_prev_label'] ); ?>
						<i class="fas fa-angle-right" aria-hidden="true"></i>
					<?php endif; ?>
				</div>
				<div class="c-prev-next-nav__item-title">
					%title
				</div>
				<?php
				$format = ob_get_clean();

				if ( ! function_exists( 'snow_monkey_prev_next_nav_title' ) ) {
					/**
					 * Trim the post title.
					 *
					 * @param string $nav_title The post title.
					 * @return string
					 */
					function snow_monkey_prev_next_nav_title( $nav_title ) {
						// phpcs:disable WordPress.WP.I18n.MissingArgDomain
						$num_words            = 60;
						$excerpt_length_ratio = 55 / _x( '55', 'excerpt_length' );
						// phpcs:enable
						return wp_trim_words( $nav_title, $num_words * $excerpt_length_ratio );
					}
				}
				add_filter( 'the_title', 'snow_monkey_prev_next_nav_title' );

				if ( 'next' === $key ) {
					previous_post_link(
						'%link',
						$format,
						$args['_in_same_term'],
						$args['_excluded_terms'],
						$args['_taxonomy']
					);
				} elseif ( 'prev' === $key ) {
					next_post_link(
						'%link',
						$format,
						$args['_in_same_term'],
						$args['_excluded_terms'],
						$args['_taxonomy']
					);
				}

				remove_filter( 'the_title', 'snow_monkey_prev_next_nav_title' );
				?>
			<?php endif; ?>
		</div>
	<?php endforeach; ?>
</div>
<?php
