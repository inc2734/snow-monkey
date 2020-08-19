<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 11.0.6
 */

use Framework\Helper;
?>

<footer class="c-entry__footer">
	<?php
	if ( get_option( 'mwt-facebook-page-name' ) ) {
		Helper::get_template_part( 'template-parts/common/like-me-box' );
	}
	?>

	<?php Helper::get_template_part( 'template-parts/content/prev-next-nav' ); ?>

	<?php
	if ( get_option( 'mwt-display-related-posts' ) ) {
		$related_posts_query = Helper::get_related_posts_query( get_the_ID() );
		if ( get_option( 'mwt-google-matched-content' ) || $related_posts_query->have_posts() ) {
			$vars = [
				'_title' => __( 'Related posts', 'snow-monkey' ),
			];
			Helper::get_template_part( 'template-parts/content/related-posts', null, $vars );
		}
	}
	?>
</footer>
