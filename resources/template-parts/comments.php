<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\Mimizuku_Core\Helper;

$comments_by_type = $wp_query->comments_by_type;
if ( ! comments_open() && empty( $comments_by_type['comment'] ) ) {
	return;
}
?>

<aside class="p-comments c-entry-aside">
	<h2 class="p-comments__title c-entry-aside__title"><?php esc_html_e( 'Comments on this post', 'snow-monkey' ); ?></h2>

	<?php if ( ! empty( $comments_by_type['comment'] ) ) : ?>
		<ol class="p-comments__list">
			<?php
			wp_list_comments(
				[
					'type'     => 'comment',
					'callback' => function( $comment, $args, $depth ) {
						?>
						<li <?php comment_class( [ 'p-comments__item' ] ); ?> id="li-comment-<?php comment_ID(); ?>">
							<?php
							Helper\get_template_part(
								'template-parts/comment',
								null,
								[
									'_comment' => $comment,
									'_args'    => $args,
									'_depth'   => $depth,
								]
							);
							?>
						<?php
					},
				]
			);
			?>
		</ol>

		<?php get_template_part( 'template-parts/comments-pagination' ); ?>

	<?php else : ?>
		<p class="p-comments__nocomments">
			<?php esc_html_e( 'No comments.', 'snow-monkey' ); ?>
		</p>
	<?php endif; ?>

	<?php if ( comments_open() ) : ?>
		<div id="respond" class="p-comments__respond">
			<div class="p-comments__form">
				<?php comment_form(); ?>
			</div>
		</div>
	<?php endif; ?>
</aside>
