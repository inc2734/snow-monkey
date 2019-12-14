<?php
/**
 * Name: Two rows
 *
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version <version>
 */

use Framework\Helper;

$classes = Helper::get_header_classes();
?>

<header class="<?php echo esc_attr( join( ' ', $classes ) ); ?>" role="banner">
	<?php
	if ( get_theme_mod( 'infobar-content' ) && in_array( get_theme_mod( 'header-position' ), [ 'overlay', 'sticky-overlay' ] ) ) {
		Helper::get_template_part( 'template-parts/common/infobar' );
	}
	?>

	<div class="l-header__content">
		<?php Helper::get_template_part( 'template-parts/header/2row' ); ?>
	</div>

	<?php if ( Helper::has_drop_nav() ) : ?>
		<div class="l-header__drop-nav" aria-hidden="true">
			<div class="c-container">
				<?php Helper::get_template_part( 'template-parts/nav/global' ); ?>
			</div>
		</div>
	<?php endif; ?>
</header>
