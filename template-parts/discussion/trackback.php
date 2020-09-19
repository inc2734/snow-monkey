<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 11.3.3
 *
 * renamed: template-parts/trackback.php
 */

$args = wp_parse_args(
	// phpcs:disable VariableAnalysis.CodeAnalysis.VariableAnalysis.UndefinedVariable
	$args,
	// phpcs:enable
	[
		'_trackback_meta_message' => sprintf(
			/* translators: 1: Author, 2: Date, 3, Time */
			esc_html__( '%1$s said on %2$s at %3$s', 'snow-monkey' ),
			sprintf( '<cite>%s</cite>', get_comment_author_link() ),
			get_comment_date(),
			get_comment_time()
		),
	]
);
?>

<dl class="c-trackback" id="comment-<?php comment_ID(); ?>">
	<dt class="c-trackback__meta">
		<?php
		$before = '';
		if ( $args['_trackback_meta_message'] ) {
			echo wp_kses_post( $args['_trackback_meta_message'] );
			$before = ' / ';
		}
		edit_comment_link( 'edit', $before, '' );
		?>
	</dt>
	<dd class="c-trackback__body">
		<?php comment_text(); ?>
	</dd>
</dl>
