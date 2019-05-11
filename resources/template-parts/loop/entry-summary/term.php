<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Framework\Helper;

$terms = Helper::get_var( $_terms, [] );

if ( ! $terms || ! is_array( $terms ) || is_wp_error( $terms ) ) {
	return;
}
?>

<?php foreach ( $terms as $term ) : ?>
	<span class="c-entry-summary__term"><?php echo esc_html( $term->name ); ?></span>
<?php endforeach; ?>
