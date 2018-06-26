<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */
?>
<div class="c-comment" id="comment-<?php comment_ID(); ?>">
	<div class="c-comment__figure">
		<?php echo get_avatar( $_comment, '96' ); ?>
	</div>
	<div class="c-comment__body">
		<?php if ( 0 === $_comment->comment_approved ) : ?>
			<em><?php esc_html_e( 'Your comment is awaiting moderation.', 'snow-monkey' ); ?></em>
		<?php endif; ?>

		<div class="c-comment__meta">
			<?php
			$author = sprintf( '<cite>%s</cite>', get_comment_author_link() );
			$date   = get_comment_date();
			$time   = get_comment_time();
			printf(
				esc_html__( '%1$s said on %2$s at %3$s', 'snow-monkey' ),
				wp_kses_post( $author ),
				wp_kses_post( $date ),
				wp_kses_post( $time )
			);
			edit_comment_link( esc_html__( 'Edit this comment', 'snow-monkey' ), ' / ', '' );
			?>
		</div>

		<div class="c-comment__content">
			<?php comment_text(); ?>
		</div>

		<?php
		$args = array_merge( $_args, [
			'depth'     => $_depth,
			'max_depth' => $_args['max_depth'],
		] );
		?>

		<?php if ( ! empty( get_comment_reply_link( $args ) ) ) : ?>
			<div class="c-comment__reply">
				<?php comment_reply_link( $args ); ?>
			</div>
		<?php endif; ?>
	</div>
</div>
