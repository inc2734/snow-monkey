<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

$header_content = get_theme_mod( 'header-content' );

$header_layout  = get_theme_mod( 'header-layout' );
$header_type    = $header_layout . '-header';
?>
<header class="l-header l-header--<?php echo esc_attr( $header_layout ); ?>" role="banner" data-l-header-type="sticky">
	<div class="l-<?php echo esc_attr( $header_type ); ?>">
		<div class="c-container">
			<div class="l-<?php echo esc_attr( $header_type ); ?>__row">
				<div class="c-row c-row--margin c-row--middle c-row--nowrap">
					<div class="c-row__col c-row__col--auto">
						<?php get_template_part( 'template-parts/site-branding' ); ?>
					</div>

					<?php if ( $header_content || has_nav_menu( 'drawer-nav' ) ) : ?>
						<div class="c-row__col c-row__col--fit">
							<div class="c-row c-row--margin c-row--middle c-row--nowrap">
								<?php if ( $header_content ) : ?>
									<div class="c-row__col c-row__col--fit u-hidden u-visible-lg-up">
										<?php echo wp_kses_post( $header_content ); ?>
									</div>
								<?php endif; ?>

								<?php if ( has_nav_menu( 'drawer-nav' ) ) : ?>
									<div class="c-row__col c-row__col--fit">
										<?php get_template_part( 'template-parts/hamburger-btn' ); ?>
									</div>
								<?php endif; ?>
							</div>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</header>
