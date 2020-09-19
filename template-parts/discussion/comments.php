<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 11.3.3
 *
 * renamed: template-parts/comments.php
 */

use Framework\Helper;

global $wp_query;

if ( ! comments_open() && empty( $wp_query->comments_by_type['comment'] ) ) {
	return;
}

$args = wp_parse_args(
	// phpcs:disable VariableAnalysis.CodeAnalysis.VariableAnalysis.UndefinedVariable
	$args,
	// phpcs:enable
	[
		'_title'               => __( 'Comments on this post', 'snow-monkey' ),
		'_no_comments_message' => __( 'No comments.', 'snow-monkey' ),
	]
);
?>

<aside class="p-comments c-entry-aside">
	<?php if ( $args['_title'] ) : ?>
		<h2 class="p-comments__title c-entry-aside__title"><?php echo wp_kses_post( $args['_title'] ); ?></h2>
	<?php endif; ?>

	<?php if ( ! empty( $wp_query->comments_by_type['comment'] ) ) : ?>

		<ol class="p-comments__list">
			<?php
			wp_list_comments(
				[
					'type'     => 'comment',
					'callback' => function( $comment, $callback_args, $depth ) {
						?>
						<li <?php comment_class( [ 'p-comments__item' ] ); ?> id="li-comment-<?php comment_ID(); ?>">
							<?php
							Helper::get_template_part(
								'template-parts/discussion/comment',
								null,
								[
									'_comment'   => $comment,
									'_depth'     => $depth,
									'_max_depth' => $callback_args['max_depth'],
								]
							);
							?>
						<?php
					},
				]
			);
		?>
		</ol>

		<?php
		if ( 2 <= get_comment_pages_count() && get_option( 'page_comments' ) ) {
			Helper::get_template_part( 'template-parts/discussion/pagination' );
		}
		?>

	<?php else : ?>

		<?php if ( $args['_no_comments_message'] ) : ?>
			<p class="p-comments__nocomments">
				<?php echo wp_kses_post( $args['_no_comments_message'] ); ?>
			</p>
		<?php endif; ?>

	<?php endif; ?>

	<?php if ( comments_open() ) : ?>

		<div id="respond" class="p-comments__respond">
			<div class="p-comments__form">
				<?php Helper::get_template_part( 'template-parts/discussion/comment-form' ); ?>
			</div>
		</div>

	<?php endif; ?>
</aside>
