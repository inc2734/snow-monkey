<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

$header_image = '';

if ( is_singular() ) {
	if ( has_post_thumbnail() ) {
		$thumbnail_id = get_post_thumbnail_id();
	}
} elseif ( is_home() || ( is_archive() && ! is_post_type_archive() ) ) {
	if ( 'page' === get_option( 'show_on_front' ) ) {
		$thumbnail_id = get_post_thumbnail_id( get_option( 'page_for_posts' ) );
	}

	if ( is_category() ) {
		$term = get_queried_object();
		$header_image = get_theme_mod( 'category-' . $term->term_id . '-header-image' );
	}
}

if ( empty( $header_image ) ) {
	if ( ! empty( $thumbnail_id ) ) {
		$header_image = wp_get_attachment_image_url( $thumbnail_id, 'large' );
	}
}

if ( empty( $header_image ) && ! snow_monkey_is_output_page_header_title() ) {
	return;
}
?>

<div
	class="c-page-header js-bg-parallax"
	style="background-image: url(<?php echo esc_url( $header_image ); ?>);"
	data-has-content="<?php echo esc_attr( snow_monkey_is_output_page_header_title() ? 'true' : 'false' ); ?>"
	data-has-image="<?php echo esc_attr( empty( $header_image ) ? 'false' : 'true' ); ?>"
	>

	<?php if ( snow_monkey_is_output_page_header_title() ) : ?>
		<div class="c-container">
			<div class="c-page-header__content">
				<h1 class="c-page-header__title"><?php the_title(); ?></h1>

				<?php if ( is_singular( 'post' ) ) : ?>
					<div class="c-page-header__meta">
						<?php get_template_part( 'template-parts/entry-meta' ); ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	<?php endif; ?>
</div>
