<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 6.0.0
 *
 * renamed: template-parts/pings.php
 */

use Framework\Helper;

if ( ! pings_open() && empty( $wp_query->comments_by_type['pings'] ) ) {
	return;
}
?>

<aside class="p-trackbacks c-entry-aside">
	<h2 class="p-trackbacks__title c-entry-aside__title"><?php esc_html_e( 'Trackbacks and Pingbacks on this post', 'snow-monkey' ); ?></h2>

	<?php if ( ! empty( $wp_query->comments_by_type['pings'] ) ) : ?>

		<ol class="p-trackbacks__list">
			<?php
			wp_list_comments(
				[
					'type'     => 'pings',
					'callback' => function() {
						?>
						<li <?php comment_class( [ 'c-trackbacks__item' ] ); ?> id="li-comment-<?php comment_ID(); ?>">
							<?php Helper::get_template_part( 'template-parts/discussion/trackback' ); ?>
						<?php
					},
				]
			);
			?>
		</ol>

	<?php else : ?>

		<p class="p-trackbacks__notrackbacks">
			<?php esc_html_e( 'No trackbacks.', 'snow-monkey' ); ?>
		</p>

	<?php endif; ?>

	<?php if ( pings_open() ) : ?>

		<div class="p-trackbacks__trackback-url">
			<dl>
				<dt><?php esc_html_e( 'TrackBack URL', 'snow-monkey' ); ?></dt>
				<dd><input class="c-form-control" type="text" size="50" value="<?php trackback_url( true ); ?>" readonly="readonly" /></dd>
			</dl>
		</div>

	<?php endif; ?>
</aside>
