<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 11.3.3
 *
 * renamed: template-parts/comment.php
 */

$args = wp_parse_args(
	// phpcs:disable VariableAnalysis.CodeAnalysis.VariableAnalysis.UndefinedVariable
	$args,
	// phpcs:enable
	[
		'_comment'                  => false,
		'_depth'                    => 0,
		'_max_depth'                => 0,
		'_comment_approved_message' => __( 'Your comment is awaiting moderation.', 'snow-monkey' ),
		'_comment_meta_message'     => sprintf(
			/* translators: 1: Author, 2: Date, 3: Time */
			esc_html__( '%1$s said on %2$s at %3$s', 'snow-monkey' ),
			sprintf( '<cite>%s</cite>', get_comment_author_link() ),
			get_comment_date(),
			get_comment_time()
		),
	]
);

$_comment = get_comment( $args['_comment'] );
if ( ! $_comment ) {
	return;
}

$avatar = get_avatar( $_comment, '96' );
?>

<div class="c-comment" id="comment-<?php comment_ID(); ?>">
	<?php if ( $avatar ) : ?>
		<div class="c-comment__figure">
			<?php echo wp_kses_post( $avatar ); ?>
		</div>
	<?php endif; ?>

	<div class="c-comment__body">
		<?php if ( 0 === $_comment->comment_approved && $args['_comment_approved_message'] ) : ?>
			<em><?php echo wp_kses_post( $args['_comment_approved_message'] ); ?></em>
		<?php endif; ?>

		<div class="c-comment__meta">
			<?php
			$before = '';
			if ( $args['_comment_meta_message'] ) {
				echo wp_kses_post( $args['_comment_meta_message'] );
				$before = ' / ';
			}
			edit_comment_link( esc_html__( 'Edit this comment', 'snow-monkey' ), $before, '' );
			?>
		</div>

		<div class="c-comment__content">
			<?php comment_text(); ?>
		</div>

		<?php
		$comment_reply_link_args = [
			'depth'     => $args['_depth'],
			'max_depth' => $args['_max_depth'],
		];
		$comment_reply_link      = get_comment_reply_link( $comment_reply_link_args );
		?>
		<?php if ( ! empty( $comment_reply_link ) ) : ?>
			<div class="c-comment__reply">
				<?php comment_reply_link( $comment_reply_link_args ); ?>
			</div>
		<?php endif; ?>
	</div>
</div>
