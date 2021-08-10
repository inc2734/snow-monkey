<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 15.2.0
 */

use Framework\Helper;

$args = wp_parse_args(
	// phpcs:disable VariableAnalysis.CodeAnalysis.VariableAnalysis.UndefinedVariable
	$args,
	// phpcs:enable
	[
		'_display_article_bottom_widget_area'  => false,
		'_display_article_top_widget_area'     => false,
		'_display_bottom_share_buttons'        => false,
		'_display_contents_bottom_widget_area' => false,
		'_display_entry_footer'                => false,
		'_display_profile_box'                 => false,
		'_display_top_share_buttons'           => false,
	]
);

if ( $args['_display_entry_footer'] ) {
	$args = wp_parse_args(
		$args,
		[
			'_display_follow_box'    => has_nav_menu( 'follow-box' ),
			'_display_like_me_box'   => get_option( 'mwt-facebook-page-name' ),
			'_display_prev_next_nav' => false,
			'_display_related_posts' => get_option( 'mwt-display-related-posts' ),
		]
	);
}
?>

<article <?php post_class(); ?>>
	<?php
	/**
	 * woocommerce_before_main_content hook.
	 *
	 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
	 * @hooked woocommerce_breadcrumb - 20
	 */
	do_action( 'woocommerce_before_main_content' );
	?>

	<div class="c-entry__body">
		<?php
		if ( $args['_display_top_share_buttons'] ) {
			Helper::get_template_part( 'template-parts/content/share-buttons' );
		}
		?>

		<?php
		if ( $args['_display_article_top_widget_area'] ) {
			Helper::get_template_part( 'template-parts/widget-area/article-top' );
		}
		?>

		<?php Helper::get_template_part( 'template-parts/content/entry/content/woocommerce-single-product' ); ?>

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
	/**
	 * woocommerce_after_main_content hook.
	 *
	 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
	 */
	do_action( 'woocommerce_after_main_content' );
	?>

	<?php
	if ( $args['_display_entry_footer'] ) {
		Helper::get_template_part(
			'template-parts/content/entry/footer/footer',
			'woocommerce-single-product',
			[
				'_display_follow_box'    => $args['_display_follow_box'],
				'_display_like_me_box'   => $args['_display_like_me_box'],
				'_display_prev_next_nav' => $args['_display_prev_next_nav'],
				'_display_related_posts' => $args['_display_related_posts'],
			]
		);
	}
	?>
</article>

<?php
if ( $args['_display_contents_bottom_widget_area'] ) {
	Helper::get_template_part( 'template-parts/widget-area/contents-bottom' );
}
?>
