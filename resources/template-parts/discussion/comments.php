<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version <unversion>
 *
 * renamed: template-parts/comments.php
 */

use Framework\Helper;

if ( ! comments_open() && empty( $wp_query->comments_by_type['comment'] ) ) {
	return;
}
?>

<aside class="p-comments c-entry-aside">
	<h2 class="p-comments__title c-entry-aside__title"><?php esc_html_e( 'Comments on this post', 'snow-monkey' ); ?></h2>

	<?php if ( ! empty( $wp_query->comments_by_type['comment'] ) ) : ?>

		<ol class="p-comments__list">
			<?php
			wp_list_comments(
				[
					'type'     => 'comment',
					'callback' => function( $comment, $args, $depth ) {
						?>
						<li <?php comment_class( [ 'p-comments__item' ] ); ?> id="li-comment-<?php comment_ID(); ?>">
							<?php
							Helper::get_template_part(
								'template-parts/discussion/comment',
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

		<?php
		if ( 2 <= get_comment_pages_count() && get_option( 'page_comments' ) ) {
			Helper::get_template_part( 'template-parts/discussion/pagination' );
		}
		?>

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
