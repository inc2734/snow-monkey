<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 6.0.0
 *
 * renamed: template-parts/prev-next-nav.php
 */

use Framework\Helper;

$in_same_term   = Helper::get_var( $_in_same_term, false );
$excluded_terms = Helper::get_var( $_excluded_terms, [] );
$taxonomy       = Helper::get_var( $_taxonomy, 'category' );
?>

<div class="c-prev-next-nav">
	<?php foreach ( [ 'next', 'prev' ] as $key ) : ?>
		<div class="c-prev-next-nav__item c-prev-next-nav__item--<?php echo esc_attr( $key ); ?>">
			<?php
			if ( 'next' === $key ) {
				$_post = get_previous_post( $in_same_term, $excluded_terms, $taxonomy );
			} elseif ( 'prev' === $key ) {
				$_post = get_next_post( $in_same_term, $excluded_terms, $taxonomy );
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
						<?php esc_html_e( 'Old post', 'snow-monkey' ); ?>
					<?php else : ?>
						<?php esc_html_e( 'New post', 'snow-monkey' ); ?>
						<i class="fas fa-angle-right" aria-hidden="true"></i>
					<?php endif; ?>
				</div>
				<div class="c-prev-next-nav__item-title">
					%title
				</div>
				<?php
				$format = ob_get_clean();

				if ( ! function_exists( 'snow_monkey_prev_next_nav_title' ) ) {
					function snow_monkey_prev_next_nav_title( $nav_title ) {
						return wp_trim_words( $nav_title, class_exists( 'multibyte_patch' ) ? 30 : 60 );
					}
				}
				add_filter( 'the_title', 'snow_monkey_prev_next_nav_title' );

				if ( 'next' === $key ) {
					previous_post_link(
						'%link',
						$format
					);
				} elseif ( 'prev' === $key ) {
					next_post_link(
						'%link',
						$format
					);
				}

				remove_filter( 'the_title', 'snow_monkey_prev_next_nav_title' );
				?>
			<?php endif; ?>
		</div>
	<?php endforeach; ?>
</div>
<?php
