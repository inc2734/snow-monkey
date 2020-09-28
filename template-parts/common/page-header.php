<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 11.5.0
 *
 * renamed: template-parts/page-header.php
 */

use Framework\Helper;

$args = wp_parse_args(
	// phpcs:disable VariableAnalysis.CodeAnalysis.VariableAnalysis.UndefinedVariable
	$args,
	// phpcs:enable
	[
		'_is_output_page_header_title'       => Helper::is_output_page_header_title(),
		'_page_header_title'                 => Helper::get_page_title_from_breadcrumbs(),
		'_page_header_image'                 => Helper::get_page_header_image(),
		'_display_entry_meta'                => false,
		'_display_page_header_image_caption' => false,
	]
);
?>

<div
	class="c-page-header"
	data-has-content="<?php echo esc_attr( $args['_is_output_page_header_title'] ? 'true' : 'false' ); ?>"
	data-has-image="<?php echo esc_attr( $args['_page_header_image'] ? 'true' : 'false' ); ?>"
	>

	<?php if ( $args['_page_header_image'] ) : ?>
		<div class="c-page-header__bgimage">
			<?php
			echo wp_kses(
				$args['_page_header_image'],
				[
					'img' => Helper::img_allowed_attributes(),
				]
			);

			if ( $args['_display_page_header_image_caption'] ) {
				$page_header_image_caption = Helper::get_page_header_image_caption();
				$page_header_image_caption = apply_filters( 'snow_monkey_page_header_image_caption', $page_header_image_caption );
				if ( $page_header_image_caption ) {
					?>
					<div class="c-page-header__bgimage-caption">
						<div class="c-container">
							<?php echo wp_kses_post( $page_header_image_caption ); ?>
						</div>
					</div>
					<?php
				}
			}
			?>
		</div>
	<?php endif; ?>

	<?php if ( $args['_is_output_page_header_title'] ) : ?>
		<div class="c-container">
			<div class="c-page-header__content">
				<h1 class="c-page-header__title">
					<?php echo wp_kses_post( apply_filters( 'snow_monkey_page_header_title', $args['_page_header_title'] ) ); ?>
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
