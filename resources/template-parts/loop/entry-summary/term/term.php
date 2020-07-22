<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 11.0.0
 */

use Framework\Helper;

$template_args = [
	'terms' => Helper::get_var( $args['_terms'], [] ),
];

if ( ! $template_args['terms'] ) {
	return;
}
?>

<?php foreach ( $template_args['terms'] as $_term ) : ?>
	<span class="c-entry-summary__term c-entry-summary__term--<?php echo esc_attr( $_term->taxonomy . '-' . $_term->term_id ); ?>">
		<?php echo esc_html( $_term->name ); ?>
	</span>
<?php endforeach; ?>
