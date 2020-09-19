<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 11.3.3
 *
 * renamed: template-parts/pings.php
 */

use Framework\Helper;

global $wp_query;

if ( ! pings_open() && empty( $wp_query->comments_by_type['pings'] ) ) {
	return;
}

$args = wp_parse_args(
	// phpcs:disable VariableAnalysis.CodeAnalysis.VariableAnalysis.UndefinedVariable
	$args,
	// phpcs:enable
	[
		'_title'                 => __( 'Trackbacks and Pingbacks on this post', 'snow-monkey' ),
		'_no_trackbacks_message' => __( 'No comments.', 'snow-monkey' ),
	]
);
?>

<aside class="p-trackbacks c-entry-aside">
	<?php if ( $args['_title'] ) : ?>
		<h2 class="p-trackbacks__title c-entry-aside__title"><?php echo wp_kses_post( $args['_title'] ); ?></h2>
	<?php endif; ?>

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

		<?php if ( $args['_no_trackbacks_message'] ) : ?>
			<p class="p-trackbacks__notrackbacks">
				<?php echo wp_kses_post( $args['_no_trackbacks_message'] ); ?>
			</p>
		<?php endif; ?>

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
