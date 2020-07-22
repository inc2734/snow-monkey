<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 11.0.0
 *
 * renamed: template-parts/entry-tags.php
 */

use Framework\Helper;

$template_args = [
	'terms' => Helper::get_var( $args['_terms'], get_the_terms( get_the_ID(), 'post_tag' ) ),
];

if ( ! $template_args['terms'] || ! is_array( $template_args['terms'] ) ) {
	return;
}
?>

<div class="c-entry-tags">
	<?php foreach ( $template_args['terms'] as $_term ) : ?>
		<a class="tag-cloud-link" href="<?php echo esc_url( get_term_link( $_term ) ); ?>">
			<?php echo esc_html( $_term->name ); ?>
		</a>
	<?php endforeach; ?>
</div>
