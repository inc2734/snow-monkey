<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */
?>
<div class="c-entry">
	<?php get_template_part( 'template-parts/posts-page-widget-area-top' ); ?>

	<div class="c-entry__content p-entry-content">
		<div class="p-archive">
			<?php
			$infeed_ads      = get_option( 'mwt-google-infeed-ads' );
			$data_infeed_ads = ( $infeed_ads ) ? 'true' : 'false';
			$archive_layout  = get_theme_mod( 'archive-layout' );
			?>

			<ul class="c-entries c-entries--<?php echo esc_attr( $archive_layout ); ?>" data-has-infeed-ads="<?php echo esc_attr( $data_infeed_ads ); ?>">
				<?php while ( have_posts() ) : ?>
					<?php the_post(); ?>
					<li class="c-entries__item">
						<?php get_template_part( 'template-parts/loop/entry-summary', get_post_type() ); ?>
					</li>
				<?php endwhile; ?>
			</ul>
		</div>
	</div>

	<?php get_template_part( 'template-parts/pagination' ); ?>
	<?php get_template_part( 'template-parts/posts-page-widget-area-bottom' ); ?>
</div>
