<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Framework\Helper;

$eyecatch_position = get_theme_mod( get_post_type() . '-eyecatch' );
$share_buttons_display_position = get_option( 'mwt-share-buttons-display-position' );
$share_buttons = get_option( 'mwt-share-buttons-buttons' );
$google_adsense = get_option( 'mwt-google-adsense' );
?>

<article <?php post_class(); ?>>
	<?php
	if ( 'title-on-page-header' !== $eyecatch_position ) {
		Helper::get_template_part( 'template-parts/content/entry/header/header', 'post' );
	}
	?>

	<div class="c-entry__body">
		<?php
		if ( in_array( $share_buttons_display_position, [ 'top', 'both' ] ) && $share_buttons ) {
			Helper::get_template_part( 'template-parts/content/share-buttons' );
		}

		if ( $google_adsense ) {
			$vars = [
				'_position' => 'content-top',
			];
			Helper::get_template_part( 'template-parts/common/google-adsense', null, $vars );
		}

		if ( 'content-top' === $eyecatch_position && has_post_thumbnail() ) {
			Helper::get_template_part( 'template-parts/content/eyecatch' );
		}

		if ( Helper::is_active_sidebar( 'article-top-widget-area' ) ) {
			Helper::get_template_part( 'template-parts/widget-area/article-top' );
		}

		Helper::get_template_part( 'template-parts/content/entry/content/content', 'post' );

		if ( Helper::is_active_sidebar( 'article-bottom-widget-area' ) ) {
			Helper::get_template_part( 'template-parts/widget-area/article-bottom' );
		}

		if ( in_array( $share_buttons_display_position, [ 'bottom', 'both' ] ) && $share_buttons ) {
			Helper::get_template_part( 'template-parts/content/share-buttons' );
		}

		if ( $google_adsense ) {
			$vars = [
				'_position' => 'content-bottom',
			];
			Helper::get_template_part( 'template-parts/common/google-adsense', null, $vars );
		}

		if ( get_the_terms( get_the_ID(), 'post_tag' ) ) {
			Helper::get_template_part( 'template-parts/content/entry-tags' );
		}

		if ( get_option( 'mwt-display-profile-box' ) ) {
			Helper::get_template_part( 'template-parts/common/profile-box' );
		}
		?>
	</div>

	<?php Helper::get_template_part( 'template-parts/content/entry/footer/footer', 'post' ); ?>
</article>

<?php
if ( Helper::is_active_sidebar( 'contents-bottom-widget-area' ) ) {
	Helper::get_template_part( 'template-parts/widget-area/contents-bottom' );
}

if ( comments_open() || pings_open() || get_comments_number() ) {
	comments_template( '', true );
}
