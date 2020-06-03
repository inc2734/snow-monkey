<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 10.7.1
 */

use Framework\Helper;

$_post_type = get_post_type() ? get_post_type() : 'post';

$template_args = [
	'entries_layout' => Helper::get_var( $_entries_layout, get_theme_mod( $_post_type . '-entries-layout' ) ),
	'force_sm_1col'  => Helper::get_var( $_force_sm_1col, get_theme_mod( $_post_type . '-entries-layout-sm-1col' ) ),
];

$force_sm_1col = $template_args['force_sm_1col'] ? 'true' : 'false';
?>

<div class="c-entry__content p-entry-content">
	<div class="p-archive">
		<ul class="c-entries c-entries--<?php echo esc_attr( $template_args['entries_layout'] ); ?>" data-force-sm-1col="<?php echo esc_attr( $force_sm_1col ); ?>">
			<?php while ( have_posts() ) : ?>
				<?php the_post(); ?>
				<li class="c-entries__item">
					<?php
					Helper::get_template_part(
						'template-parts/loop/entry-summary',
						$_post_type,
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
</div>
