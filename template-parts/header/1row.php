<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 19.0.0-beta1
 *
 * renamed: template-parts/1row-header.php
 */

use Framework\Helper;

$args = wp_parse_args(
	// phpcs:disable VariableAnalysis.CodeAnalysis.VariableAnalysis.UndefinedVariable
	$args,
	// phpcs:enable
	array(
		'_title_tag'      => 'div',
		'_gnav_alignment' => 'right',
	)
);

$header_content         = get_theme_mod( 'header-content' );
$header_type            = get_theme_mod( 'header-layout' ) . '-header';
$header_alignfull       = get_theme_mod( 'header-alignfull' );
$has_global_nav         = has_nav_menu( 'global-nav' );
$has_drawer_nav         = has_nav_menu( 'drawer-nav' ) || has_nav_menu( 'drawer-sub-nav' );
$has_header_sub_nav     = has_nav_menu( 'header-sub-nav' );
$data_has_global_nav    = $has_global_nav ? 'true' : 'false';
$container_class        = $header_alignfull ? 'c-fluid-container' : 'c-container';
$hamburger_btn_position = get_theme_mod( 'hamburger-btn-position' );

$row_classes = array( 'c-row', 'c-row--margin-s', 'c-row--lg-margin', 'c-row--middle', 'c-row--nowrap' );
if ( 'center' === $args['_gnav_alignment'] ) {
	$row_classes[] = 'c-row--between';
}

$site_branding_column_classes = array( 'c-row__col' );
if ( 'right' === $args['_gnav_alignment'] ) {
	$site_branding_column_classes[] = 'c-row__col--auto';
} elseif ( 'center' === $args['_gnav_alignment'] || 'left' === $args['_gnav_alignment'] ) {
	$site_branding_column_classes[] = 'c-row__col--fit';
}

$header_content_column_classes = array( 'c-row__col', 'c-row__col--fit', 'u-invisible-md-down' );
if ( 'left' === $args['_gnav_alignment'] ) {
	$header_content_column_classes[] = 'c-row__col--put-right';
}
?>

<div class="l-<?php echo esc_attr( $header_type ); ?>" data-has-global-nav="<?php echo esc_attr( $data_has_global_nav ); ?>">
	<div class="<?php echo esc_attr( $container_class ); ?>">
		<?php if ( $has_header_sub_nav ) : ?>
			<div class="u-invisible-md-down">
				<?php Helper::get_template_part( 'template-parts/nav/header-sub' ); ?>
			</div>
		<?php endif; ?>

		<div class="<?php echo esc_attr( implode( ' ', $row_classes ) ); ?>">
			<?php if ( $has_drawer_nav && 'left' === $hamburger_btn_position ) : ?>
				<div class="c-row__col c-row__col--fit u-invisible-lg-up">
					<?php
					Helper::get_template_part(
						'template-parts/header/hamburger-btn',
						null,
						array(
							'_id' => false,
						)
					);
					?>
				</div>
			<?php endif; ?>

			<?php do_action( 'snow_monkey_before_header_site_branding_column' ); ?>

			<div class="<?php echo esc_attr( implode( ' ', $site_branding_column_classes ) ); ?>">
				<div class="l-<?php echo esc_attr( $header_type ); ?>__branding">
					<?php
					Helper::get_template_part(
						'template-parts/header/site-branding',
						null,
						array(
							'_title_tag' => $args['_title_tag'],
						)
					);
					?>
				</div>
			</div>

			<?php do_action( 'snow_monkey_after_header_site_branding_column' ); ?>

			<?php if ( $has_global_nav ) : ?>
				<div class="c-row__col c-row__col--fit u-invisible-md-down">
					<?php
					// The PHP into HTML causes(maybe), erroneous lint warnings to be printed.
					// phpcs:disable WordPress.Arrays.MultipleStatementAlignment.DoubleArrowNotAligned
					Helper::get_template_part(
						'template-parts/nav/global',
						null,
						array(
							'_vertical'            => get_theme_mod( 'vertical-global-nav' ),
							'_gnav-hover-effect'   => get_theme_mod( 'gnav-hover-effect' ),
							'_gnav-current-effect' => get_theme_mod( 'gnav-current-effect' ),
						)
					);
					// phpcs:enable
					?>
				</div>
			<?php endif; ?>

			<?php if ( $header_content || 'center' === $args['_gnav_alignment'] ) : ?>
				<div class="<?php echo esc_attr( implode( ' ', $header_content_column_classes ) ); ?>">
					<div class="l-<?php echo esc_attr( $header_type ); ?>__content">
						<?php
						if ( get_theme_mod( 'header-content' ) ) {
							Helper::get_template_part( 'template-parts/header/content', 'lg' );
						}
						?>
					</div>
				</div>
			<?php endif; ?>

			<?php if ( $has_drawer_nav && 'right' === $hamburger_btn_position ) : ?>
				<div class="c-row__col c-row__col--fit u-invisible-lg-up" >
					<?php
					Helper::get_template_part(
						'template-parts/header/hamburger-btn',
						null,
						array(
							'_id' => false,
						)
					);
					?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>
