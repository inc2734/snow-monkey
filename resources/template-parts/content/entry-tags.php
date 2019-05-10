<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Framework\Helper;

$terms = Helper::get_var( $_terms, get_the_terms( get_the_ID(), 'post_tag' ) );

if ( ! $terms || ! is_array( $terms ) ) {
	return;
}
?>

<div class="c-entry-tags">
	<?php foreach ( $terms as $term ) : ?>
		<a class="tag-cloud-link" href="<?php echo esc_url( get_term_link( $term ) ); ?>"><?php echo esc_html( $term->name ); ?></a>
	<?php endforeach; ?>
</div>
