<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Framework\Helper;

$terms = get_the_terms( get_the_ID(), 'category' );
$term  = $terms && is_array( $terms ) && ! is_wp_error( $terms ) ? $terms[0] : null;
?>

<div class="c-entry-summary__figure">
	<?php the_post_thumbnail( 'xlarge' ); ?>

	<?php if ( $term ) : ?>
		<span class="c-entry-summary__term c-entry-summary__term--<?php echo esc_attr( $term->taxonomy . '-' . $term->term_id ); ?>">
			<?php echo esc_html( $term->name ); ?>
		</span>
	<?php endif; ?>
</div>
