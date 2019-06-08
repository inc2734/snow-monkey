<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 7.0.0
 *
 * renamed: template-parts/trackback.php
 */
?>

<dl class="c-trackback" id="comment-<?php comment_ID(); ?>">
	<dt class="c-trackback__meta">
		<?php
		$author = sprintf( '<cite>%s</cite>', get_comment_author_link() );
		$date   = get_comment_date();
		$time   = get_comment_time();
		printf(
			/* translators: 1: Author, 2: Date, 3, Time */
			esc_html__( '%1$s said on %2$s at %3$s', 'snow-monkey' ),
			wp_kses_post( $author ),
			wp_kses_post( $date ),
			wp_kses_post( $time )
		);
		edit_comment_link( 'edit', '  ', '' );
		?>
	</dt>
	<dd class="c-trackback__body">
		<?php comment_text(); ?>
	</dd>
</dl>
