<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 10.2.0
 */

use Framework\Helper;
?>

<div class="c-entry__content p-entry-content">
	<div class="p-archive">
		<?php
		$_post_type      = get_post_type() ? get_post_type() : 'post';
		$_post_type      = is_home() ? 'post' : $_post_type;
		$infeed_ads      = get_option( 'mwt-google-infeed-ads' );
		$data_infeed_ads = ( $infeed_ads ) ? 'true' : 'false';
		$entries_layout  = get_theme_mod( $_post_type . '-entries-layout' );
		$force_sm_1col   = get_theme_mod( $_post_type . '-entries-layout-sm-1col' ) ? 'true' : 'false';
		?>

		<ul class="c-entries c-entries--<?php echo esc_attr( $entries_layout ); ?>" data-has-infeed-ads="<?php echo esc_attr( $data_infeed_ads ); ?>" data-force-sm-1col="<?php echo esc_attr( $force_sm_1col ); ?>">
			<?php while ( have_posts() ) : ?>
				<?php the_post(); ?>
				<li class="c-entries__item">
					<?php
					Helper::get_template_part(
						'template-parts/loop/entry-summary',
						'post',
						[
							'_entries_layout' => $entries_layout,
						]
					);
					?>
				</li>
			<?php endwhile; ?>
		</ul>
	</div>

	<?php
	if ( ! empty( $wp_query->max_num_pages ) && $wp_query->max_num_pages >= 2 ) {
		Helper::get_template_part( 'template-parts/archive/pagination' );
	}
	?>
</div>
