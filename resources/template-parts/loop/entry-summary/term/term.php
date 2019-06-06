<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 6.2.0
 */

use Framework\Helper;

$terms = Helper::get_var( $_terms, [] );

if ( ! $terms ) {
	return;
}
?>

<?php foreach ( $terms as $term ) : ?>
	<span class="c-entry-summary__term c-entry-summary__term--<?php echo esc_attr( $term->taxonomy . '-' . $term->term_id ); ?>">
		<?php echo esc_html( $term->name ); ?>
	</span>
<?php endforeach; ?>
