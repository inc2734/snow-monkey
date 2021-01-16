<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 12.2.3
 */

use Framework\Helper;

$args = wp_parse_args(
	// phpcs:disable VariableAnalysis.CodeAnalysis.VariableAnalysis.UndefinedVariable
	$args,
	// phpcs:enable
	[
		'_display_adsense'                     => false,
		'_display_article_bottom_widget_area'  => false,
		'_display_article_top_widget_area'     => false,
		'_display_bottom_share_buttons'        => false,
		'_display_contents_bottom_widget_area' => false,
		'_display_comments'                    => true,
		'_display_entry_footer'                => false,
		'_display_entry_header'                => false,
		'_display_eyecatch'                    => false,
		'_display_profile_box'                 => false,
		'_display_tags'                        => false,
		'_display_top_share_buttons'           => false,
	]
);
?>

<article <?php post_class(); ?>>
	<?php
	if ( $args['_display_entry_header'] ) {
		Helper::get_template_part(
			'template-parts/content/entry/header/header',
			$args['_name']
		);
	}
	?>

	<div class="c-entry__body">
		<?php
		if ( $args['_display_top_share_buttons'] ) {
			Helper::get_template_part( 'template-parts/content/share-buttons' );
		}
		?>

		<?php
		if ( $args['_display_adsense'] ) {
			Helper::get_template_part(
				'template-parts/common/google-adsense',
				null,
				[
					'_position' => 'content-top',
				]
			);
		}
		?>

		<?php
		if ( $args['_display_eyecatch'] ) {
			Helper::get_template_part( 'template-parts/content/eyecatch' );
		}
		?>

		<?php
		if ( $args['_display_article_top_widget_area'] ) {
			Helper::get_template_part( 'template-parts/widget-area/article-top' );
		}
		?>

		<?php
		Helper::get_template_part(
			'template-parts/content/entry/content/content',
			$args['_name']
		);
		?>

		<?php
		if ( $args['_display_article_bottom_widget_area'] ) {
			Helper::get_template_part( 'template-parts/widget-area/article-bottom' );
		}
		?>

		<?php
		if ( $args['_display_bottom_share_buttons'] ) {
			Helper::get_template_part( 'template-parts/content/share-buttons' );
		}
		?>

		<?php
		if ( $args['_display_adsense'] ) {
			Helper::get_template_part(
				'template-parts/common/google-adsense',
				null,
				[
					'_position' => 'content-bottom',
				]
			);
		}
		?>

		<?php
		if ( $args['_display_tags'] ) {
			Helper::get_template_part(
				'template-parts/content/entry-tags',
				get_post_type(),
				[
					'_terms' => get_the_terms( get_the_ID(), 'post_tag' ),
				]
			);
		}
		?>

		<?php
		if ( $args['_display_profile_box'] ) {
			Helper::get_template_part(
				'template-parts/common/profile-box',
				null,
				[
					'_title' => __( 'Bio', 'snow-monkey' ),
				]
			);
		}
		?>
	</div>

	<?php
	if ( $args['_display_entry_footer'] ) {
		Helper::get_template_part(
			'template-parts/content/entry/footer/footer',
			$args['_name']
		);
	}
	?>
</article>

<?php
if ( $args['_display_contents_bottom_widget_area'] ) {
	Helper::get_template_part( 'template-parts/widget-area/contents-bottom' );
}
?>

<?php
if ( $args['_display_comments'] ) {
	comments_template( '', true );
}
