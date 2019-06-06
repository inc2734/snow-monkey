<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 6.0.0
 */

use Framework\Helper;

$header_content = get_theme_mod( 'header-content' );
$header_type    = get_theme_mod( 'header-layout' ) . '-header';
$has_drawer_nav = has_nav_menu( 'drawer-nav' );
?>

<div class="l-<?php echo esc_attr( $header_type ); ?>">
	<div class="c-container">
		<div class="l-<?php echo esc_attr( $header_type ); ?>__row">
			<div class="c-row c-row--margin c-row--middle c-row--nowrap">
				<div class="c-row__col c-row__col--auto">
					<?php Helper::get_template_part( 'template-parts/header/site-branding' ); ?>
				</div>

				<?php if ( $header_content || $has_drawer_nav ) : ?>
					<div class="c-row__col c-row__col--fit">
						<div class="c-row c-row--margin c-row--middle c-row--nowrap">
							<?php if ( $header_content ) : ?>
								<div class="c-row__col c-row__col--fit u-hidden u-visible-lg-up">
									<?php
									if ( get_theme_mod( 'header-content' ) ) {
										Helper::get_template_part( 'template-parts/header/content', 'lg' );
									}
									?>
								</div>
							<?php endif; ?>

							<?php if ( $has_drawer_nav ) : ?>
								<div class="c-row__col c-row__col--fit">
									<?php Helper::get_template_part( 'template-parts/header/hamburger-btn' ); ?>
								</div>
							<?php endif; ?>
						</div>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>
