<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 15.0.0
 *
 * renamed: template-parts/page-header.php
 */

use Framework\Helper;

$page_header = Helper::get_page_header_class();

$args = wp_parse_args(
	// phpcs:disable VariableAnalysis.CodeAnalysis.VariableAnalysis.UndefinedVariable
	$args,
	// phpcs:enable
	[
		'_title'                 => $page_header::get_title(),
		'_image'                 => $page_header::get_image( apply_filters( 'snow_monkey_page_header_thumbnail_size', 'xlarge' ) ),
		'_align'                 => $page_header::get_align(),
		'_display_entry_meta'    => false,
		'_display_image_caption' => false,
	]
);

// Migrate from less than v11.5 to more than v11.5
if ( isset( $args['_page_header_title'] ) ) {
	$args['_title'] = $args['_page_header_title'];
}
if ( isset( $args['_page_header_image'] ) ) {
	$args['_image'] = $args['_page_header_image'];
}
if ( isset( $args['_is_output_page_header_title'] ) ) {
	$args['_title'] = $args['_is_output_page_header_title']
		? Helper::get_page_title_from_breadcrumbs()
		: false;
}
?>

<div
	class="c-page-header"
	data-align="<?php echo esc_attr( $args['_align'] ); ?>"
	data-has-content="<?php echo esc_attr( $args['_title'] ? 'true' : 'false' ); ?>"
	data-has-image="<?php echo esc_attr( $args['_image'] ? 'true' : 'false' ); ?>"
	>

	<?php if ( $args['_image'] ) : ?>
		<div class="c-page-header__bgimage">
			<?php
			echo wp_kses(
				$args['_image'],
				[
					'img' => Helper::img_allowed_attributes(),
				]
			);
			?>

			<?php if ( $args['_display_image_caption'] ) : ?>
				<?php
				$image_caption = $page_header::get_image_caption();
				?>
				<?php if ( $image_caption ) : ?>
					<div class="c-page-header__bgimage-caption">
						<div class="c-container">
							<?php echo wp_kses_post( $image_caption ); ?>
						</div>
					</div>
				<?php endif; ?>
			<?php endif; ?>
		</div>
	<?php endif; ?>

	<?php if ( $args['_title'] ) : ?>
		<div class="c-container">
			<div class="c-page-header__content">
				<h1 class="c-page-header__title">
					<?php echo wp_kses_post( $args['_title'] ); ?>
				</h1>

				<?php if ( $args['_display_entry_meta'] ) : ?>
					<div class="c-page-header__meta">
						<?php Helper::get_template_part( 'template-parts/content/entry-meta' ); ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	<?php endif; ?>
</div>
