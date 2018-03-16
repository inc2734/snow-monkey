<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */
?>
<div class="c-entry">
	<div class="c-entry__content">
		<?php get_template_part( 'template-parts/archive-top-widget-area' ); ?>

		<?php
		$infeed_ads      = get_option( 'mwt-google-infeed-ads' );
		$data_infeed_ads = ( $infeed_ads ) ? 'true' : 'false';
		$archive_layout  = get_theme_mod( 'archive-layout' );
		?>

		<ul class="c-entries c-entries--<?php echo esc_attr( $archive_layout ); ?>" data-has-infeed-ads="<?php echo esc_attr( $data_infeed_ads ); ?>">
			<?php while ( have_posts() ) : ?>
				<?php the_post(); ?>
				<li class="c-entries__item">
					<?php get_template_part( 'template-parts/entry-summary' ); ?>
				</li>
			<?php endwhile; ?>
		</ul>

		<?php get_template_part( 'template-parts/pagination' ); ?>
	</div>
</div>
