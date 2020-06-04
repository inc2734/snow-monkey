<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 10.8.0
 */

use Framework\Helper;

$template_args = [
	'entries_layout' => Helper::get_var( $_entries_layout, get_theme_mod( 'post-entries-layout' ) ),
	'force_sm_1col'  => Helper::get_var( $_force_sm_1col, get_theme_mod( 'post-entries-layout-sm-1col' ) ),
];

$force_sm_1col   = $template_args['force_sm_1col'] ? 'true' : 'false';
$data_infeed_ads = get_option( 'mwt-google-infeed-ads' ) ? 'true' : 'false';
?>

<?php do_action( 'snow_monkey_before_archive_entry_content' ); ?>

<div class="c-entry__content p-entry-content">
	<?php do_action( 'snow_monkey_prepend_archive_entry_content' ); ?>

	<div class="p-archive">
		<ul class="c-entries c-entries--<?php echo esc_attr( $template_args['entries_layout'] ); ?>" data-has-infeed-ads="<?php echo esc_attr( $data_infeed_ads ); ?>" data-force-sm-1col="<?php echo esc_attr( $force_sm_1col ); ?>">
			<?php while ( have_posts() ) : ?>
				<?php the_post(); ?>
				<li class="c-entries__item">
					<?php
					Helper::get_template_part(
						'template-parts/loop/entry-summary',
						'post',
						[
							'_entries_layout' => $template_args['entries_layout'],
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

	<?php do_action( 'snow_monkey_append_archive_entry_content' ); ?>
</div>

<?php do_action( 'snow_monkey_after_archive_entry_content' ); ?>
