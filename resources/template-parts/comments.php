<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */
?>

<aside class="p-comments c-entry-aside">
	<h2 class="p-comments__title c-entry-aside__title"><span><?php esc_html_e( 'Comments on this post', 'snow-monkey' ); ?></span></h2>

	<?php $comments_by_type = $wp_query->comments_by_type; ?>
	<?php if ( ! empty( $comments_by_type['comment'] ) ) : ?>
		<ol class="p-comments__list">
			<?php
			wp_list_comments( [
				'type'     => 'comment',
				'callback' => function( $comment, $args, $depth ) {
					?>
					<li <?php comment_class( [ 'p-comments__item' ] ); ?> id="li-comment-<?php comment_ID(); ?>">
						<?php
						wpvc_get_template_part( 'template-parts/comment', [
							'_comment' => $comment,
							'_args'    => $args,
							'_depth'   => $depth,
						] );
						?>
					<?php
				},
			] );
			?>
		</ol>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<div class="c-pagination">
				<?php the_comments_pagination(); ?>
			</div>
		<?php endif; ?>

		<?php if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
			<p class="p-comments__nocomments">
				<?php esc_html_e( 'Comments are closed.', 'snow-monkey' ); ?>
			</p>
		<?php endif; ?>
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
