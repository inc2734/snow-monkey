<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 15.1.2
 */

use Framework\Helper;

$args = wp_parse_args(
	// phpcs:disable VariableAnalysis.CodeAnalysis.VariableAnalysis.UndefinedVariable
	$args,
	// phpcs:enable
	[
		'_display_follow_box'    => has_nav_menu( 'follow-box' ),
		'_display_like_me_box'   => get_option( 'mwt-facebook-page-name' ),
		'_display_prev_next_nav' => true,
		'_display_related_posts' => get_option( 'mwt-display-related-posts' ),
	]
);
?>

<footer class="c-entry__footer">
	<?php
	if ( $args['_display_follow_box'] ) {
		Helper::get_template_part( 'template-parts/content/follow-box' );
	}
	?>

	<?php
	if ( $args['_display_like_me_box'] ) {
		Helper::get_template_part( 'template-parts/common/like-me-box' );
	}
	?>

	<?php
	if ( $args['_display_prev_next_nav'] ) {
		Helper::get_template_part(
			'template-parts/content/prev-next-nav',
			$args['_name']
		);
	}
	?>

	<?php
	if ( $args['_display_related_posts'] ) {
		$related_posts_query = Helper::get_related_posts_query( get_the_ID() );
		if ( get_option( 'mwt-google-matched-content' ) || $related_posts_query->have_posts() ) {
			$vars = [
				'_title'       => __( 'Related posts', 'snow-monkey' ),
				'_posts_query' => $related_posts_query,
				'_code'        => get_option( 'mwt-google-matched-content' ),
			];
			Helper::get_template_part(
				'template-parts/content/related-posts',
				$args['_name'],
				$vars
			);
		}
	}
	?>
</footer>
