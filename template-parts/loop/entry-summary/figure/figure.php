<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 20.1.0
 */

use Framework\Helper;

$args = wp_parse_args(
	// phpcs:disable VariableAnalysis.CodeAnalysis.VariableAnalysis.UndefinedVariable
	$args,
	// phpcs:enable
	array(
		'_entries_id'     => null,
		'_src'            => false,
		'_thumbnail_size' => 'medium_large',
		'_terms'          => array(),
	)
);
?>

<div class="c-entry-summary__figure">
	<?php if ( $args['_src'] ) : ?>
		<img src="<?php echo esc_url( $args['_src'] ); ?>" alt="" />
	<?php else : ?>
		<?php
		if ( 'attachment' === get_post_type() ) {
			echo wp_get_attachment_image( get_the_ID(), 'full' );
		} else {
			the_post_thumbnail( $args['_thumbnail_size'] );
		}
		?>
	<?php endif; ?>

	<?php
	if ( $args['_terms'] ) {
		Helper::get_template_part(
			'template-parts/loop/entry-summary/term/term',
			$args['_name'],
			array(
				'_context'    => $args['_context'],
				'_entries_id' => $args['_entries_id'],
				'_terms'      => $args['_terms'],
			)
		);
	}
	?>
</div>
